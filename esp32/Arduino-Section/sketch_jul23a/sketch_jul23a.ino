#include <WiFi.h>
#include "DHT.h"
#include "ThingSpeak.h"
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <Adafruit_BMP280.h>

#define DHTPIN 4
#define DHTTYPE DHT11
#define MQ135_PIN 34
#define RAIN_SENSOR_PIN 35

const char* ssid = "Wokwi-GUEST";
const char* password = "";

WiFiClient client;

// ThingSpeak settings
unsigned long channelID = 3012215;
const char* writeAPIKey = "L0QR2LFQUU4OIT0M";

DHT dht(DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(115200);
  dht.begin();
  delay(5000);
  pinMode(RAIN_SENSOR_PIN, INPUT);

  Serial.println("Connecting to WiFi");
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nConnected to WiFi");

  ThingSpeak.begin(client);
}

void loop() {
  delay(2000);
  float temp = dht.readTemperature();
  float hum = dht.readHumidity();
  int air_quality = analogRead(MQ135_PIN);
  int rain_detected = digitalRead(RAIN_SENSOR_PIN); // LOW = rain

  Serial.println("===== Sensor Readings =====");
  if (isnan(temp) || isnan(hum)) {
    delay(2000);
    Serial.println("Failed to read from DHT sensor!");
  } else {
    Serial.println("Temp: " + String(temp) + " °C");
    Serial.println("Humidity: " + String(hum) + " %");
  }
  Serial.println("Air Quality: " + String(air_quality));
  Serial.println("Rain Detected: " + String(rain_detected == LOW ? "YES" : "NO"));

  // Only send valid DHT data to ThingSpeak
  if (!isnan(temp) && !isnan(hum)) {
    ThingSpeak.setField(1, temp);
    ThingSpeak.setField(2, hum);
  }
  ThingSpeak.setField(3, air_quality);
  ThingSpeak.setField(4, rain_detected == LOW ? 1 : 0);  // 1 = rain detected

  int result = ThingSpeak.writeFields(channelID, writeAPIKey);

  if (result == 200) {
    Serial.println("Data sent to ThingSpeak successfully!");
  } else {
    Serial.println("Failed to send data. HTTP error code: " + String(result));
  }

  Serial.println("===========================\n");
  delay(15000); // ThingSpeak update limit
}