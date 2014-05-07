<?php

require_once('Tinkerforge/IPConnection.php');
require_once('Tinkerforge/BrickletAnalogIn.php');

use Tinkerforge\IPConnection;
use Tinkerforge\BrickletAnalogIn;

const HOST = 'localhost';
const PORT = 4223;
const UID = '7oj'; // Change to your UID

$ipcon = new IPConnection(); // Create IP connection
$ai = new BrickletAnalogIn(UID, $ipcon); // Create device object

$ipcon->connect(HOST, PORT); // Connect to brickd
// Don't use device before ipcon is connected

// Get current voltage (unit is mV)
$voltage = $ai->getVoltage() / 1000.0;

echo "Voltage: $voltage V\n";

echo "Press key to exit\n";
fgetc(fopen('php://stdin', 'r'));
$ipcon->disconnect();

?>
