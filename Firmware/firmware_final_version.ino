//Projeto 1+2
//Eduardo Avelar 23041
//Francisco Xavier

#include <WiFi.h>	 // Library WiFi ESP32
#include <MFRC522.h> // Library of the RFID module
#include <SPI.h>	 // Library of the SPI bus
#include <HTTPClient.h>
#include <String.h>
#include <base64.h>

/*
card with postit 	-> 6B93BF22
card		        -> 113861BD
tag with postit    	-> A7FE94C8
tag		            -> 246FEC6E
*/

#define SS_PIN 21
#define RST_PIN 22
#define SIZE_BUFFER 18
#define MAX_SIZE_BLOCK 16
#define LED 2
#define BTN 5

String ids = "";
String tag = "";
String tag2 = "";
String response = "";
String to_send = "";
int value = 0;
int j = 0;
int state = 0;
int pos = 0;

const char *ssid = "LordranM";							   // name of your WiFi network
const char *password = "roubarefeio";					   // password of the WiFi network
const char *serverName = "http://62.28.241.83:7896/iot/d"; // your Domain name with URL path or IP address with path
IPAddress host(192, 168, 17, 100);						   // define the SAS replica server IP
WiFiClient client;										   // wiFi Client Object

MFRC522::MIFARE_Key key;		  // used in authentication
MFRC522::StatusCode status;		  // authentication return status code
MFRC522 mfrc522(SS_PIN, RST_PIN); // defined pins to module RC522

//SETUP
void setup()
{

	pinMode(LED, OUTPUT); // define the onboard led as output
	pinMode(BTN, INPUT);  // define the button as input
	Serial.begin(115200); // define serial bus

	wifi_connect(); // connects to the wifi

	SPI.begin(); // init SPI bus

	mfrc522.PCD_Init(); // init MFRC522 rfid reader
	Serial.println("Insira a sua garrafa na plataforma. Caso não tenha clique no botão...");
	Serial.println();
}

//LOOP
void loop()
{

	int valorBTN = digitalRead(BTN);

	if (valorBTN == HIGH)
	{
		Serial.println("Coloque o cartao no segundo leitor dentro dos proximos 5 segundos");
		digitalWrite(LED, HIGH);
		delay(5000);
		digitalWrite(LED, LOW);

		if (!mfrc522.PICC_IsNewCardPresent()) // waiting the card approach
		{
			return;
		}

		if (!mfrc522.PICC_ReadCardSerial()) // select a card
		{
			return;
		}

		tag2 = "";
		read_schoolcard();
		validation_schoolcard();
		delay(2000);
		data_receptor();

		if (response == "+1") // receives +1 if the user is associated
		{
			Serial.println("Utilizador associado!");
			response = "";
			credit_schoolcard();
			delay(2000);
			data_receptor();

			Serial.print("Valor recebido da api do credito 1 : ");
			Serial.println(response);

			if (response == "+1") // receives +1 if the user has credit
			{
				data_block_agent();
				delay(2000);
				data_receptor();
				insert_iotagent();

				Serial.println("Agua paga, a encher");
				digitalWrite(LED, HIGH);
				delay(5000);
				digitalWrite(LED, LOW);
				Serial.println("Agua cheia, Remova a garrafa!");
				Serial.println();
				Serial.println("Insira a sua garrafa na plataforma. Caso não tenha clique no botão...");
				Serial.println();
				delay(3000);
			}
			else
			{
				Serial.println("Credito insuficiente!");
				Serial.println();
				Serial.println("Insira a sua garrafa na plataforma. Caso não tenha clique no botão...");
				Serial.println();
			}
		}
		else
		{
			Serial.println("User não associado.");
			Serial.println();
			Serial.println("Insira a sua garrafa na plataforma. Caso não tenha clique no botão...");
			Serial.println();
			delay(3000);
		}
	}

	state = 1;
	if (state == 1)
	{

		if (!mfrc522.PICC_IsNewCardPresent())
		{
			return;
		}

		if (!mfrc522.PICC_ReadCardSerial())
		{
			return;
		}
		state = 2;
	}

	if (state == 2)
	{
		tag = "";
		read_bottle();

		if (tag.length() > 0) // verifies if there is a tag
		{
			validation_bottle();
			delay(2000);
			data_receptor();

			if (response == "+1")
			{
				Serial.println("Utilizador associado!");
				response = "";
				credit_bottle();
				delay(2000);
				data_receptor();

				if (response == "+1")
				{
					data_block_agent();
					delay(2000);
					data_receptor();
					insert_iotagent();

					Serial.println("Agua paga, a encher");
					digitalWrite(LED, HIGH);
					delay(5000);
					digitalWrite(LED, LOW);
					Serial.println("Agua cheia, Remova a garrafa!");
					Serial.println();
					Serial.println("Insira a sua garrafa na plataforma. Caso não tenha clique no botão...");
					Serial.println();
					delay(3000);
				}
				else
				{
					Serial.println("Credito insuficiente!");
					Serial.println();
					Serial.println("Insira a sua garrafa na plataforma. Caso não tenha clique no botão...");
					Serial.println();
				}
			}
			else
			{
				Serial.println("Garrafa nao associada!");
				Serial.println();
				Serial.println("Passe cartao no segundo leitor nos proximos 5 segundos");
				digitalWrite(LED, HIGH);
				delay(5000);
				digitalWrite(LED, LOW);

				state = 4;
				if (state == 4)
				{
					if (!mfrc522.PICC_IsNewCardPresent())
					{
						return;
					}
					if (!mfrc522.PICC_ReadCardSerial())
					{
						return;
					};
					state = 5;
				}

				if (state == 5)
				{
					tag2 = "";
					read_schoolcard();
					insert_data();

					Serial.println("Utilizador associado á garrafa com sucesso... ");

					response = "";
					credit_schoolcard();
					delay(2000);
					data_receptor();

					if (response == "+1")
					{
						Serial.println("Agua paga, a encher");
						digitalWrite(LED, HIGH);
						delay(5000);
						digitalWrite(LED, LOW);
						Serial.println("Agua cheia, Remova a garrafa!");
					}

					data_block_agent();
					delay(2000);
					data_receptor();
					insert_iotagent();

					Serial.println();
					Serial.println("Insira a sua garrafa na plataforma. Caso não tenha clique no botão...");
					Serial.println();
				}
			}
		}
	}

	ids = "";
	//instructs the PICC when in the ACTIVE state to go to a "STOP" state
	mfrc522.PICC_HaltA();
	// "stop" the encryption of the PCD, otherwise new communications can not be initiated
	mfrc522.PCD_StopCrypto1();
}

//Below this point there are the functions used

/* FUNCTION DESCRIPTION~
-> this function is the function that receives the packtes with the response
   from the SAS replica server API and cut out the uncessary header 
*/
void data_receptor()
{
	ids = "";

	while (client.available())
	{
		char c = client.read();
		ids += c;
		if (c == '+' && value == 0)
		{
			pos = ids.indexOf(c);
			value = 1;
		}
	}

	value = 0;

	response = ids.substring(pos);
}

/* FUNCTION DESCRIPTION~
-> this function is the function that gets the string with the data to sent 
   to the IoT agent  
*/
void data_block_agent()
{
	if (client.connect(host, 80))
	{
		client.print("GET /data_block_agent.php?ID_user=");
		client.print(tag2);
		client.print("&ID_bottle=");
		client.print(tag);
		client.print(" ");
		client.print("HTTP/1.1");
		client.println();
		client.println("Host: 192.168.1.72");
		client.println("Connection: close");
		client.println();
		tag = "";
	}
	else
	{
		Serial.println("connection failed");
	}
}

/* FUNCTION DESCRIPTION~
-> this function is the function that reads the UID's from 
   the bottles
*/
void read_bottle()
{
	//Reading from the card
	for (byte i = 0; i < mfrc522.uid.size; i++)
	{
		tag.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
		tag.concat(String(mfrc522.uid.uidByte[i], HEX));
	}
	tag.toUpperCase();
	tag.trim();
	tag.replace(" ", "");
	//Serial.println(tag);
}

/* FUNCTION DESCRIPTION~
-> this function is the function that reads the UID's from 
   the schoolcards
*/
void read_schoolcard()
{
	//Reading from the card
	for (byte i = 0; i < mfrc522.uid.size; i++)
	{
		tag2.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
		tag2.concat(String(mfrc522.uid.uidByte[i], HEX));
	}
	tag2.toUpperCase();
	tag2.trim();
	tag2.replace(" ", "");
	//Serial.println(tag2);
}

/* FUNCTION DESCRIPTION~
-> this function is the function that insert the new assocition into the ~
   SAS replica server database
*/
void insert_data()
{
	if (client.connect(host, 80))
	{
		client.print("GET /insert.php?ID_user=");
		client.print(tag2);
		client.print("&ID_bottle=");
		client.print(tag);
		client.print(" ");
		client.print("HTTP/1.1");
		client.println();
		client.println("Host: 192.168.1.72");
		client.println("Connection: close");
		client.println();
		tag = "";
	}
	else
	{
		Serial.println("connection failed");
	}
}

/* FUNCTION DESCRIPTION~
-> this function is the function that validates if a schoolcard
   is associated
*/
void validation_schoolcard()
{
	if (client.connect(host, 80))
	{
		client.print("GET /validation_schoolcard.php?ID_user=");
		client.print(tag2);
		client.print(" ");
		client.print("HTTP/1.1");
		client.println();
		client.println("Host: 192.168.1.72");
		client.println("Connection: close");
		client.println();
	}
	else
	{
		Serial.println("connection failed");
	}
}

/* FUNCTION DESCRIPTION~
-> this function is the function that validates if a bottle
   is associated
*/
void validation_bottle()
{
	if (client.connect(host, 80))
	{
		client.print("GET /validation_bottle.php?ID_bottle=");
		client.print(tag);
		client.print(" ");
		client.print("HTTP/1.1");
		client.println();
		client.println("Host: 192.168.1.72");
		client.println("Connection: close");
		client.println();
	}
	else
	{
		Serial.println("connection failed");
	}
}

/* FUNCTION DESCRIPTION~
-> this function is the function that validates if the 
   owner of the bottle has credit 
*/
void credit_bottle()
{
	if (client.connect(host, 80))
	{
		client.print("GET /credit_bottle.php?ID_bottle=");
		client.print(tag);
		client.print(" ");
		client.print("HTTP/1.1");
		client.println();
		client.println("Host: 192.168.1.72");
		client.println("Connection: close");
		client.println();
	}
	else
	{
		Serial.println("connection failed");
	}
}

/* FUNCTION DESCRIPTION~
-> this function is the function that validates if the 
   owner of the card has credit
*/
void credit_schoolcard()
{
	if (client.connect(host, 80))
	{
		client.print("GET /credit_schoolcard.php?ID_user=");
		client.print(tag2);
		client.print(" ");
		client.print("HTTP/1.1");
		client.println();
		client.println("Host: 192.168.1.72");
		client.println("Connection: close");
		client.println();
	}
	else
	{
		Serial.println("connection failed");
	}
}

/* FUNCTION DESCRIPTION~
-> this function is the function that connects 
   to the configure network
*/
void wifi_connect()
{
	Serial.print("Connecting to ");
	Serial.println(ssid);
	WiFi.begin(ssid, password); // Connects to WiFi Network

	while (WiFi.status() != WL_CONNECTED)
	{
		delay(500); // Waits for WiFi connection
		Serial.print(".");
	}

	Serial.println("");
	Serial.println("ESP connected to WiFi with IP address: ");
	Serial.println(WiFi.localIP());
}

/* FUNCTION DESCRIPTION~
-> this function is the function that POST's the string received
   from the data_block_agent to the IoT agent
*/
void insert_iotagent()
{
	if (WiFi.status() == WL_CONNECTED)
	{
		response.replace("+", "");
		String to_send = base64::encode(response);

		HTTPClient http;
		http.begin(serverName);						  // Your Domain name with URL path or IP address with path
		http.addHeader("Content-Type", "text/plain"); //HTTP request with a content type: text/plain
		int httpResponseCode = http.POST(to_send);

		Serial.print("HTTP Response code: ");
		Serial.println(httpResponseCode);

		http.end(); // Free resources
	}
	else
	{
		Serial.println("WiFi Disconnected");
	}
}