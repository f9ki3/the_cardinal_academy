#include <SoftwareSerial.h>
SoftwareSerial sim(10, 9); // RX, TX

void setup() {
  Serial.begin(9600);
  sim.begin(9600);
  delay(5000);

  Serial.println("🔍 Checking signal and carrier...");

  sim.println("AT+CSQ");
  delay(1000);
  dumpSIMResponse();

  sim.println("AT+CREG?");
  delay(1000);
  dumpSIMResponse();

  sim.println("AT+COPS?");
  delay(1000);
  dumpSIMResponse();
}

void loop() {
  // nothing
}

void dumpSIMResponse() {
  while (sim.available()) {
    Serial.write(sim.read());
  }
}
