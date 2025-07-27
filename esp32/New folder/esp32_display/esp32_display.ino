#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>

// OLED display SPI pin definitions (use ESP32 GPIO numbers)
#define OLED_MOSI   23  // GPIO23
#define OLED_CLK    18  // GPIO18
#define OLED_DC     17  // GPIO17
#define OLED_CS     5   // GPIO5
#define OLED_RESET  16  // GPIO16 (or -1 if not connected)

#define SCREEN_WIDTH 128
#define SCREEN_HEIGHT 64

Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT,
  OLED_MOSI, OLED_CLK, OLED_DC, OLED_RESET, OLED_CS);

void setup() {
  Serial.begin(115200);

  // Initialize the display
  if (!display.begin(SSD1306_SWITCHCAPVCC)) {
    Serial.println(F("SSD1306 allocation failed"));
    for (;;); // Don't proceed, loop forever
  }

  display.clearDisplay();

  // Display text
  display.setTextSize(2);
  display.setTextColor(SSD1306_WHITE);
  display.setCursor(0, 0);
  display.println("ESP32 OLED");

  display.setTextSize(1);
  display.setCursor(0, 20);
  display.println("128x64 SPI Demo");

  // Draw a rectangle
  display.drawRect(0, 40, 60, 20, SSD1306_WHITE);

  // Draw a filled circle
  display.fillCircle(100, 50, 10, SSD1306_WHITE);

  // Draw a line
  display.drawLine(0, 63, 127, 63, SSD1306_WHITE);

  display.display();
}

void loop() {
  // Nothing here for now
}
