#include <base64.h>
#include <WiFi.h>
#include <HTTPClient.h>

unsigned long lastTime = 0;
unsigned long timerDelay = 5000;						   // Set timer to 5 seconds (5000)
const char *ssid = "LordranM";							   // name of your WiFi network
const char *password = "roubarefeio";					   // password of the WiFi network
const char *serverName = "http://62.28.241.83:7896/iot/d"; // your Domain name with URL path or IP address with path
int contador_post = 0;

void setup()
{
	Serial.begin(115200);

	WiFi.begin(ssid, password);
	Serial.println("Connecting");
	while (WiFi.status() != WL_CONNECTED)
	{
		delay(500);
		Serial.print(".");
	}
	Serial.println("");
	Serial.print("Connected to WiFi network with IP Address: ");
	Serial.println(WiFi.localIP());
}

void loop()
{
	if ((millis() - lastTime) > timerDelay) //Send an HTTP POST request every 5sec
	{
		if (WiFi.status() == WL_CONNECTED) //Check WiFi connection status
		{
			HTTPClient http;
			http.begin(serverName); // Domain name with URL path or IP address with path

			String id = "R001";
			String array_users[5] = {"23041", "20997", "1000", "22032", "20923"};
			int index = random(0, 5);
			String id_user = array_users[index];

			String id_uo = "";
			String id_c = "";
			String id_t = "";

			if (id_user == "23041")
			{
				id_uo = "1";
				id_c = "1";
				id_t = "1";
			}

			if (id_user == "20997")
			{
				id_uo = "2";
				id_c = "2";
				id_t = "2";
			}

			if (id_user == "1000")
			{
				id_uo = "1";
				id_c = "0";
				id_t = "0";
			}

			if (id_user == "22032")
			{
				id_uo = "1";
				id_c = "1";
				id_t = "3";
			}

			if (id_user == "20923")
			{
				id_uo = "3";
				id_c = "3";
				id_t = "3";
			}

			String final = "ID=" + id + "&" + "ID_user=" + id_user + "&" + "ID_uo=" + id_uo + "&" + "ID_c=" + id_c + "&" + "ID_t=" + id_t;

			Serial.println("string a mandar ");
			Serial.println(final);

			String to_send = base64::encode(final); // encondes the string to send to base64

			http.addHeader("Content-Type", "text/plain"); // HTTP request with a content type: text/plain
			int httpResponseCode = http.POST(to_send);
			Serial.print("HTTP Response code: ");
			Serial.println(httpResponseCode);

			contador_post++; // conter to see the number of posts per session
			Serial.print("Total Posts: ");
			Serial.println(contador_post);

			http.end(); // free resources
		}
		else
		{
			Serial.println("WiFi Disconnected");
		}
		lastTime = millis();
	}
}
