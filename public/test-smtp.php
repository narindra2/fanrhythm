<?php
$host = 'ssl://mail.afrifan.com';
$port = 465;
$timeout = 30;

$context = stream_context_create();

$socket = @stream_socket_client("$host:$port", $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT, $context);

if (!$socket) {
    echo "Failed to connect to SMTP server. Reason: ($errno) $errstr\n";
} else {
    echo 'Successfully connected to SMTP server.';
    fclose($socket);
}
?>
