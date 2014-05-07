<?php

require_once('Tinkerforge/IPConnection.php');
require_once('Tinkerforge/BrickletHumidity.php');

use Tinkerforge\IPConnection;
use Tinkerforge\BrickletHumidity;

const HOST = 'localhost';
const PORT = 4223;
const UID = '7bA'; // Change to your UID

// Callback function for humidity callback (parameter has unit %RH/10)
function cb_humidity($rh)
{
    echo "Relative Humidity: " . $rh / 10.0 . " %RH\n";
}

$ipcon = new IPConnection(); // Create IP connection
$h = new BrickletHumidity(UID, $ipcon); // Create device object

$ipcon->connect(HOST, PORT); // Connect to brickd
// Don't use device before ipcon is connected

// Set Period for rh callback to 1s (1000ms)
// Note: The callback is only called every second if the 
//       humidity has changed since the last call!
$h->setHumidityCallbackPeriod(1000);

// Register illuminance callback to function cb_illuminance
$h->registerCallback(BrickletHumidity::CALLBACK_HUMIDITY, 'cb_humidity');

echo "Press ctrl+c to exit\n";
$ipcon->dispatchCallbacks(-1); // Dispatch callbacks forever

?>
