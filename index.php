#include <WiFi.h>
#include <WebServer.h>

// WiFi credentials
const char* ssid = "mistery_home";
const char* password = "aiysfuresaill12";

// Create a web server on port 80
WebServer server(80);

// Example data to show
String sensorData = "Hello from ESP32!";

void handleRoot() {
  String html = "<!DOCTYPE html><html><head><title>ESP32</title></head><body>";
  html += "<h1>ESP32 Web Server</h1>";
  html += "<p>Data: " + sensorData + "</p>";
  html += "</body></html>";
  server.send(200, "text/html", html);
}

void setup() {
  Serial.begin(115200);
  delay(1000);

  WiFi.begin(ssid, password);
  Serial.println("Connecting to WiFi...");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("\nConnected to WiFi!");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());

  server.on("/", handleRoot); // Root URL
  server.begin();
  Serial.println("HTTP server started");
}

void loop() {
  server.handleClient(); // Handle client requests
}
