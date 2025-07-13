<?php
$phone = "+639266800704";
$message = "Hello! This is a test SMS from PHP.";
$data = "{phone:\"$phone\", message:\"$message\"}\n";
$port = "/dev/cu.usbmodem14101";

// Set baud rate and terminal settings
exec("stty -f $port 9600 cs8 -cstopb -parenb");

// Open serial port
$fp = fopen($port, "w+");  // Use "w+" to allow both write and read
if (!$fp) {
    echo "❌ Failed to open serial port: $port\n";
    exit(1);
}

echo "🔌 Serial port $port opened.\n";

// Send the data
fwrite($fp, $data);
fflush($fp); // Ensure it's sent
echo "📤 Sending: $data";

// Wait to read Arduino feedback (optional)
stream_set_timeout($fp, 2);
$response = fread($fp, 128);
echo "\n📥 Response: " . trim($response);

// Close the port
fclose($fp);
echo "\n✅ Port closed.\n";
?>
