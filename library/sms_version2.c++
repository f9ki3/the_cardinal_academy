#include <SoftwareSerial.h>
SoftwareSerial sim(10, 9); // SIM300L TX → Arduino pin 10, RX ← pin 9

String input = "";
String phoneNumber = "";
String messageText = "";

void setup() {
  Serial.begin(9600);
  sim.begin(9600);
  delay(1000);
  
  Serial.println("Arduino Ready. Waiting for SMS data...");

  // Initialize SIM300L
  sim.println("AT");
  delay(1000);
  sim.println("AT+CMGF=1"); // SMS text mode
  delay(1000);
}

void loop() {
  // Read data from Serial (from PHP)
  while (Serial.available()) {
    char c = Serial.read();
    input += c;

    // End of message detected (newline)
    if (c == '\n') {
      input.trim(); // Remove whitespace and newline

      // Check if it follows the pattern: {phone:"...", message:"..."}
      if (input.startsWith("{") && input.endsWith("}")) {
        parseAndSendSMS(input);
      } else {
        Serial.println("⚠️ Invalid input format.");
      }

      input = "";
    }
  }

  // Echo SIM300L responses (optional)
  while (sim.available()) {
    Serial.write(sim.read());
  }
}

void parseAndSendSMS(String raw) {
  // Example input: {phone:"+639123456789", message:"Hello world"}
  int phoneStart = raw.indexOf("phone:\"") + 7;
  int phoneEnd = raw.indexOf("\"", phoneStart);
  int messageStart = raw.indexOf("message:\"") + 9;
  int messageEnd = raw.lastIndexOf("\"");

  if (phoneStart > 6 && phoneEnd > phoneStart && messageStart > 8 && messageEnd > messageStart) {
    phoneNumber = raw.substring(phoneStart, phoneEnd);
    messageText = raw.substring(messageStart, messageEnd);

    Serial.println("📞 Sending to: " + phoneNumber);
    Serial.println("✉️ Message: " + messageText);

    sendSMS(phoneNumber, messageText);
  } else {
    Serial.println("❌ Failed to parse input.");
  }
}

void sendSMS(String number, String message) {
  sim.println("AT+CMGS=\"" + number + "\"");
  delay(1000);
  sim.print(message);
  delay(500);
  sim.write(26); // Send Ctrl+Z to send SMS
  delay(5000);

  Serial.println("✅ SMS sent!");
}
