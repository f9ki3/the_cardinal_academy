const { SerialPort } = require("serialport");

const urlParams = new URLSearchParams(window.location.search);
const phone = urlParams.get("phone");
const message = urlParams.get("sms_message");

// Configuration
const data = `{phone:"${phone}", message:"${message}"}\n`;

// Serial port path (adjust to your actual device)
const portPath = "/dev/cu.usbmodem14301";

// Create and open serial port
const port = new SerialPort({
  path: portPath,
  baudRate: 9600,
});

// When the port is ready, write data
port.on("open", () => {
  console.log(`🔌 Serial port ${portPath} opened.`);
  console.log("📤 Sending:", data);
  port.write(data, (err) => {
    if (err) {
      return console.error("❌ Error writing to port:", err.message);
    }
    console.log("✅ Data sent successfully.");
  });
});

// Optional: handle any data received from Arduino
port.on("data", (data) => {
  console.log("📥 Received from Arduino:", data.toString());
});

// Handle errors
port.on("error", (err) => {
  console.error("❌ Serial Port Error:", err.message);
});
