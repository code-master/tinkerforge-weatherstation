<?php

require_once('Tinkerforge/IPConnection.php');
require_once('Tinkerforge/BrickletLinearPoti.php');

use Tinkerforge\IPConnection;
use Tinkerforge\BrickletLinearPoti;

const HOST = 'localhost';
const PORT = 4223;
const UID = '7jb'; // Change to your UID

$ipcon = new IPConnection(); // Create IP connection
$poti = new BrickletLinearPoti(UID, $ipcon); // Create device object

$ipcon->connect(HOST, PORT); // Connect to brickd
// Don't use device before ipcon is connected

// Get current position of poti (return value has range 0-100)
$position = $poti->getPosition();

echo "Position: $position\n";

echo "Press key to exit\n";
fgetc(fopen('php://stdin', 'r'));
$ipcon->disconnect();

?>
