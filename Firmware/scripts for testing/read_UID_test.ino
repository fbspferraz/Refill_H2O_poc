#include <WiFi.h>	 // Library WiFi ESP32
#include <MFRC522.h> // Library of the RFID module
#include <SPI.h>	 // Library of the SPI bus

#define SS_PIN 21
#define RST_PIN 22
#define SIZE_BUFFER 18
#define MAX_SIZE_BLOCK 16

String tag = "";

MFRC522::MIFARE_Key key;		  // used in authentication
MFRC522::StatusCode status;		  // authentication return status code
MFRC522 mfrc522(SS_PIN, RST_PIN); // defined pins to module RC522

void setup()
{
	Serial.begin(115200);
	SPI.begin();		// Init SPI bus
	mfrc522.PCD_Init(); // Init MFRC522
}

void loop()
{
	Serial.println("Insira cartao->");

	if (!mfrc522.PICC_IsNewCardPresent()) //waiting the card approach
	{
		return;
	}	
	if (!mfrc522.PICC_ReadCardSerial()) // Select a card
	{
		return;
	}

	readingCard();
	Serial.print("Id do cartao:   ");
	Serial.print(tag);
	tag = "";
	delay(5000);
}

void readingCard()
{
	for (byte i = 0; i < mfrc522.uid.size; i++)
	{
		tag.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
		tag.concat(String(mfrc522.uid.uidByte[i], HEX));
	}
	tag.toUpperCase();
	tag.trim();
	tag.replace(" ", "");
}
