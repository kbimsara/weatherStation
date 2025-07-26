#include <WiFi.h>
#include "DHT.h"
#include "ThingSpeak.h"

#define DHTPIN 4          // GPIO4
#define DHTTYPE DHT11
#define MQ135_PIN 34      // Analog pin
#define RAIN_SENSOR_PIN 35 // Digital pin

const char* ssid = "YOUR_WIFI_SSID";
const char* password = "YOUR_WIFI_PASSWORD";

WiFiClient client;

// ThingSpeak Settings
unsigned long channelID = 3012215;
//write API key
const char* writeAPIKey = "L0QR2LFQUU4OIT0M";

DHT dht(DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(115200);
  dht.begin();

  pinMode(RAIN_SENSOR_PIN, INPUT);

  WiFi.begin(ssid, password);
  Serial.print("Connecting to WiFi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nConnected to WiFi");

  ThingSpeak.begin(client);
}

void loop() {
  float temp = dht.readTemperature();
  float hum = dht.readHumidity();
  int air_quality = analogRead(MQ135_PIN);
  int rain_detected = digitalRead(RAIN_SENSOR_PIN);

  Serial.println("Temp: " + String(temp) + " °C");
  Serial.println("Humidity: " + String(hum) + " %");
  Serial.println("Air Quality (MQ135): " + String(air_quality));
  Serial.println("Rain Detected: " + String(rain_detected == LOW ? "YES" : "NO"));
  Serial.println("-----");

  // Send to ThingSpeak
  ThingSpeak.setField(1, temp);
  ThingSpeak.setField(2, hum);
  ThingSpeak.setField(3, air_quality);
  ThingSpeak.setField(4, rain_detected == LOW ? 1 : 0); // LOW = Rain detected

  int x = ThingSpeak.writeFields(channelID, writeAPIKey);

  if (x == 200) {
    Serial.println("Data sent to ThingSpeak.");
  } else {
    Serial.println("Failed to send data. HTTP error code " + String(x));
  }

  delay(15000); // ThingSpeak limit: 15 seconds
}
