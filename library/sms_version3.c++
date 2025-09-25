 #include <SoftwareSerial.h>
SoftwareSerial sim(10, 9); // TX to SIM800L RX, RX to SIM800L TX

String input = "";

void setup() {
  Serial.begin(9600);    // For receiving from PHP via USB
  sim.begin(9600);       // SIM800L
  delay(1000);

  Serial.println("✅ Arduino Ready");

  // Initialize SIM800L
  sim.println("AT");
  delay(1000);
  sim.println("AT+CMGF=1"); // Set SMS text mode
  delay(1000);
}

void loop() {
  // Listen to Serial (from PHP)
  while (Serial.available()) {
    char c = Serial.read();
    input += c;

    if (c == '\n') {
      Serial.print("Received: ");
      Serial.println(input);

      if (input.startsWith("{") && input.endsWith("}\n")) {
        parseAndSendSMS(input);
      } else {
        Serial.println("⚠️ Invalid format.");
      }
      input = "";
    }
  }

  // Optional: show SIM800L responses
  while (sim.available()) {
    Serial.write(sim.read());
  }
}

void parseAndSendSMS(String raw) {
  int phoneStart = raw.indexOf("phone:\"") + 7;
  int phoneEnd = raw.indexOf("\"", phoneStart);
  int messageStart = raw.indexOf("message:\"") + 9;
  int messageEnd = raw.lastIndexOf("\"");

  if (phoneStart > 0 && phoneEnd > phoneStart && messageStart > 0 && messageEnd > messageStart) {
    String phone = raw.substring(phoneStart, phoneEnd);
    String message = raw.substring(messageStart, messageEnd);

    Serial.println("📞 Sending to: " + phone);
    Serial.println("✉️ Message: " + message);

    sim.println("AT+CMGS=\"" + phone + "\"");
    delay(1000);
    sim.print(message);
    sim.write(26); // CTRL+Z
    delay(5000);

    Serial.println("✅ SMS sent!");
  } else {
    Serial.println("❌ Failed to parse.");
  }
}
