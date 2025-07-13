#include <SoftwareSerial.h>
SoftwareSerial sim(10, 9); // SIM300L TX → Arduino pin 10, RX ← pin 9

String input = "";
bool inputComplete = false;

void setup() {
  Serial.begin(9600);
  sim.begin(9600);
  delay(1000);
  Serial.println("Type 'send' and press Enter to send SMS to +639266800704");

  // Initialize SIM300L
  sim.println("AT");
  delay(1000);
  sim.println("AT+CMGF=1"); // Set to SMS text mode
  delay(1000);
}

void loop() {
  if (inputComplete) {
    input.trim();
    if (input.equalsIgnoreCase("send")) {
      sendSMS();
    } else {
      Serial.println("Unknown command. Type 'send' to send SMS.");
    }
    input = "";
    inputComplete = false;
  }

  // Echo SIM300L response
  while (sim.available()) {
    Serial.write(sim.read());
  }
}

void serialEvent() {
  while (Serial.available()) {
    char inChar = (char)Serial.read();
    input += inChar;
    if (inChar == '\n') {
      inputComplete = true;
    }
  }
}

void sendSMS() {
  Serial.println("Sending SMS to +639266800704...");

  sim.println("AT+CMGS=\"+639266800704\"");
  delay(1000);
  sim.print("Hello from Arduino + SIM300L! This is a test message.");
  delay(500);
  sim.write(26); // Ctrl+Z to send
  delay(5000);

  Serial.println("✅ SMS sent!");
}
