# Smart Weather Monitoring System

A web-based IoT weather monitoring system that collects, displays, and stores environmental data using ESP32 and various sensors.

## Features

- Real-time weather data monitoring
- Historical data viewing and export
- Responsive web interface
- Multiple sensor support:
  - Temperature & Humidity (DHT sensor)
  - Atmospheric Pressure (BMP sensor)
  - Air Quality
  - Rain Detection
  - Solar Power System monitoring

## Project Structure

```
├── DB File/                  # Database operations
│   ├── ajex.php             # AJAX data handling
│   ├── download_csv.php     # CSV export functionality
│   └── fetch_data.php       # Pagination and data fetching
├── Web-UI/                  # Frontend interface
│   ├── api/
│   │   └── store_data.php   # API endpoint for sensor data
│   ├── pg/                  # Page components
│   │   ├── footer.php
│   │   └── nav.php
│   ├── src/                 # Assets and styles
│   ├── config.php          # Database configuration
│   ├── history.php         # Historical data view
│   └── index.php           # Main dashboard
└── esp32/                   # ESP32 firmware
```

## Getting Started

### Prerequisites
- Git installed on your machine
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Arduino IDE (for ESP32 programming)

### Clone the Repository
```bash
git clone https://github.com/kbimsara/weatherStation.git
cd weatherStation
```

## Setup

1. Database Configuration
   - Create a MySQL database named `weatherstatuin`
   - Update database credentials in `Web-UI/config.php`:
   ```php
   $serverName = "localhost";
   $userName = "root";
   $password = "";
   $databaseName = "weatherstatuin";
   ```

2. Web Server Setup
   - Deploy the contents of `Web-UI/` to your web server
   - Ensure PHP and MySQL are installed and configured

3. ESP32 Setup
   - Upload the firmware from `esp32/` folder to your ESP32 device
   - Configure WiFi credentials and server endpoint

## Usage

1. Main Dashboard
   - View real-time sensor readings
   - Monitor system status
   - Check sensor graphs

2. Historical Data
   - Access historical data through the "History" page
   - Filter data by:
     - Day (24h)
     - Week (7D)
     - Month (4W)
     - Year (12M)
     - All time
   - Export data as CSV

## Technologies Used

- Frontend:
  - HTML/CSS/JavaScript
  - Bootstrap 4.6
  - Chart.js
  - jQuery
- Backend:
  - PHP
  - MySQL
- Hardware:
  - ESP32 microcontroller
  - ESP32 microcontroller
  - Various environmental sensors

