#include <Wire.h>
#include <WiFi.h>
#include <ThingSpeak.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <Adafruit_BMP280.h>
#include "DHT.h"

// --- OLED SPI ---
#define OLED_MOSI 23
#define OLED_CLK 18
#define OLED_DC 17
#define OLED_CS 5
#define OLED_RESET 16

#define SCREEN_WIDTH 128
#define SCREEN_HEIGHT 64

// --- Sensor Pins ---
#define DHTPIN 14
#define DHTTYPE DHT11
#define MQ135_PIN 34
#define RAIN_PIN 26
#define CHARGE_PIN 32  // 3.1V Solar Panel (Max safe on ESP32 ADC)

const char* ssid = "hunter";
const char* password = "0724229199";

// --- ThingSpeak ---
unsigned long channelID = 3012215;
const char* writeAPIKey = "L0QR2LFQUU4OIT0M";
WiFiClient client;

Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, OLED_MOSI, OLED_CLK, OLED_DC, OLED_RESET, OLED_CS);
Adafruit_BMP280 bmp;
DHT dht(DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(115200);

  // OLED
  if (!display.begin(SSD1306_SWITCHCAPVCC)) {
    Serial.println(F("SSD1306 failed"));
    while (true)
      ;
  }
  display.clearDisplay();
  display.display();

  // BMP280
  if (!bmp.begin(0x76)) {
    Serial.println(F("BMP280 not found!"));
    while (true)
      ;
  }
  bmp.setSampling(Adafruit_BMP280::MODE_NORMAL,
                  Adafruit_BMP280::SAMPLING_X2,
                  Adafruit_BMP280::SAMPLING_X16,
                  Adafruit_BMP280::FILTER_X16,
                  Adafruit_BMP280::STANDBY_MS_500);

  dht.begin();
  pinMode(RAIN_PIN, INPUT);
  pinMode(CHARGE_PIN, INPUT);

  // Wi-Fi
  WiFi.begin(ssid, password);
  Serial.print("Connecting to WiFi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nConnected!");

  ThingSpeak.begin(client);
}

void loop() {
  float temp = bmp.readTemperature();
  float pressure = bmp.readPressure() / 100.0F;
  float altitude = bmp.readAltitude(1013.25);
  float humidity = dht.readHumidity();
  int airQuality = analogRead(MQ135_PIN);
  bool isRaining = digitalRead(RAIN_PIN) == LOW;

  // Convert ADC reading to actual voltage for solar panel (0–3.3V)
  int chargeRaw = analogRead(CHARGE_PIN);
  float solarVoltage = chargeRaw * (3.3 / 4095.0);  // Accurate voltage reading

  // --- Serial Monitor Output ---
  Serial.println("=== Weather Station Data ===");
  Serial.printf("Temp: %.1f °C\n", temp);
  Serial.printf("Humidity: %.1f %%\n", humidity);
  Serial.printf("Air Quality: %d\n", airQuality);
  Serial.printf("Pressure: %.0f hPa\n", pressure);
  Serial.printf("Altitude: %.1f m\n", altitude);
  Serial.printf("Rain Detected: %s\n", isRaining ? "YES" : "NO");
  Serial.printf("Solar Voltage: %.2f V\n", solarVoltage);
  Serial.println("===========================\n");

  // --- OLED Display ---
  display.clearDisplay();
  display.setTextSize(2);
  display.setTextColor(SSD1306_WHITE);
  display.setCursor(0, 0);
  display.print("T:");
  display.print(temp, 1);
  display.print((char)247);
  display.println("C");

  display.setTextSize(1);
  display.setCursor(0, 20);
  display.print("Hum: ");
  display.print(humidity, 0);
  display.println("%");

  display.setCursor(0, 30);
  display.print("AirQ: ");
  display.print(airQuality);

  display.setCursor(0, 40);
  display.print("Pres: ");
  display.print(pressure, 0);
  display.println(" hPa");

  display.setCursor(0, 50);
  display.print("Alt:");
  display.print(altitude, 0);
  display.print("m");

  display.setCursor(90, 50);
  display.print(solarVoltage);
  display.display();

  // --- Upload to ThingSpeak ---
  ThingSpeak.setField(1, temp);
  ThingSpeak.setField(2, humidity);
  ThingSpeak.setField(3, airQuality);
  ThingSpeak.setField(4, isRaining ? 1 : 0);
  ThingSpeak.setField(5, altitude);
  ThingSpeak.setField(6, pressure);
  ThingSpeak.setField(7, solarVoltage);  // New: solar voltage as Field 7

  int result = ThingSpeak.writeFields(channelID, writeAPIKey);
  if (result == 200) {
    Serial.println("Data sent to ThingSpeak!");
  } else {
    Serial.println("ThingSpeak error: " + String(result));
  }

  delay(15000);  // ThingSpeak rate limit
}
