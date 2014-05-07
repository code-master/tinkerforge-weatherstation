<?php

require_once('Tinkerforge/IPConnection.php');
require_once('Tinkerforge/BrickletLinearPoti.php');

use Tinkerforge\IPConnection;
use Tinkerforge\BrickletLinearPoti;

const HOST = 'localhost';
const PORT = 4223;
const UID = '7jb'; // Change to your UID

// Callback function for position callback (parameter has range 0-100)
function cb_position($position)
{
    echo "Position: $position\n";
}

$ipcon = new IPConnection(); // Create IP connection
$poti = new BrickletLinearPoti(UID, $ipcon); // Create device object

$ipcon->connect(HOST, PORT); // Connect to brickd
// Don't use device before ipcon is connected

// Set Period for position callback to 0.05s (50ms)
// Note: The position position is only called every 50ms if the
//       position has changed since the last call!
$poti->setPositionCallbackPeriod(50);

// Register position callback to function cb_position
$poti->registerCallback(BrickletLinearPoti::CALLBACK_POSITION, 'cb_position');

echo "Press ctrl+c to exit\n";
$ipcon->dispatchCallbacks(-1); // Dispatch callbacks forever

?>
