<?php
$port = '/dev/cu.usbmodem14101';
$baud = 9600;

exec("stty -f $port $baud", $out, $status);
if ($status !== 0) {
    echo "❌ Failed to configure port.\n";
    exit;
}

$fp = @fopen($port, 'w+');
if (!$fp) {
    echo "❌ Failed to open port.\n";
    exit;
}

$phone = '+639266800704';
$message = 'Hello from f9ki3!';
$payload = sprintf("{phone:\"%s\", message:\"%s\"}\r\n", $phone, $message);

fwrite($fp, $payload);
fflush($fp);
echo "✅ Sent to Arduino: $payload\n";

$response = '';
$start = microtime(true);
$timeout = 5;

stream_set_blocking($fp, true);
while ((microtime(true) - $start) < $timeout) {
    $line = fgets($fp);
    if ($line !== false) {
        $response .= $line;
    }
}
fclose($fp);

if ($response) {
    echo "📟 Arduino response:\n$response";
} else {
    echo "⚠️ No response received.\n";
}
?>
