#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <Adafruit_BMP280.h>  // BMP280 library

// OLED display SPI pin definitions
#define OLED_MOSI   23
#define OLED_CLK    18
#define OLED_DC     17
#define OLED_CS     5
#define OLED_RESET  16

#define SCREEN_WIDTH 128
#define SCREEN_HEIGHT 64

Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT,
  OLED_MOSI, OLED_CLK, OLED_DC, OLED_RESET, OLED_CS);

// BMP280 sensor (I2C mode by default: SDA=21, SCL=22)
Adafruit_BMP280 bmp;

void setup() {
  Serial.begin(115200);

  // OLED setup
  if (!display.begin(SSD1306_SWITCHCAPVCC)) {
    Serial.println(F("SSD1306 allocation failed"));
    while (true);
  }

  display.clearDisplay();
  display.display();

  // BMP280 setup
  if (!bmp.begin(0x76)) {
    Serial.println(F("BMP280 not found at 0x76!"));
    while (true);
  }
  bmp.setSampling(Adafruit_BMP280::MODE_NORMAL,
                  Adafruit_BMP280::SAMPLING_X2,   // temperature
                  Adafruit_BMP280::SAMPLING_X16,  // pressure
                  Adafruit_BMP280::FILTER_X16,
                  Adafruit_BMP280::STANDBY_MS_500);
}

void loop() {
  // Simulated / dummy values for other sensors
  float temp = bmp.readTemperature();;               // You can use bmp.readTemperature() instead
  float humidity = 63.4;           // Replace with real DHT11 data
  int airQuality = 1850;           // Replace with analogRead(MQ135_PIN)
  float pressure = bmp.readPressure() / 100.0F; // hPa
  float altitude = bmp.readAltitude(1013.25);   // Use sea level pressure as reference
  bool isRaining = true;           // Replace with digitalRead(RAIN_SENSOR_PIN)

  // --- Serial Output ---
  Serial.println("=== Weather Station Data ===");
  Serial.print("Temperature: ");
  Serial.print(temp);
  Serial.println(" °C");

  Serial.print("Humidity: ");
  Serial.print(humidity);
  Serial.println(" %");

  Serial.print("Air Quality: ");
  Serial.println(airQuality);

  Serial.print("Pressure: ");
  Serial.print(pressure);
  Serial.println(" hPa");

  Serial.print("Altitude: ");
  Serial.print(altitude);
  Serial.println(" m");

  Serial.print("Rain Detected: ");
  Serial.println(isRaining ? "YES" : "NO");

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
  display.println(" %");

  display.setCursor(0, 30);
  display.print("AirQ: "); 
  display.print(airQuality);

  display.setCursor(0, 40);
  display.print("Pres: "); 
  display.print(pressure, 0); 
  display.println(" hPa");

  display.setCursor(0, 50);
  display.print("Alt: ");
  display.print(altitude, 0);
  display.print("m");

  display.display();
  delay(3000);
}
