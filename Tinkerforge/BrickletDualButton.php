<?php

/* ***********************************************************
 * This file was automatically generated on 2014-04-08.      *
 *                                                           *
 * Bindings Version 2.1.0                                    *
 *                                                           *
 * If you have a bugfix for this file and want to commit it, *
 * please fix the bug in the generator. You can find a link  *
 * to the generator git on tinkerforge.com                   *
 *************************************************************/

namespace Tinkerforge;

require_once(__DIR__ . '/IPConnection.php');

/**
 * Device with two buttons and two LEDs
 */
class BrickletDualButton extends Device
{

    /**
     * This callback is called whenever a button is pressed. 
     * 
     * Possible states for buttons are:
     * 
     * * 0 = pressed
     * * 1 = released
     * 
     * Possible states for LEDs are:
     * 
     * * 0 = AutoToggleOn: Auto toggle enabled and LED on.
     * * 1 = AutoToggleOff: Auto toggle enabled and LED off.
     * * 2 = On: LED on (auto toggle is disabled).
     * * 3 = Off: LED off (auto toggle is disabled).
     */
    const CALLBACK_STATE_CHANGED = 4;


    /**
     * @internal
     */
    const FUNCTION_SET_LED_STATE = 1;

    /**
     * @internal
     */
    const FUNCTION_GET_LED_STATE = 2;

    /**
     * @internal
     */
    const FUNCTION_GET_BUTTON_STATE = 3;

    /**
     * @internal
     */
    const FUNCTION_SET_SELECTED_LED_STATE = 5;

    /**
     * @internal
     */
    const FUNCTION_GET_IDENTITY = 255;

    const LED_STATE_AUTO_TOGGLE_ON = 0;
    const LED_STATE_AUTO_TOGGLE_OFF = 1;
    const LED_STATE_ON = 2;
    const LED_STATE_OFF = 3;
    const BUTTON_STATE_PRESSED = 0;
    const BUTTON_STATE_RELEASED = 1;
    const LED_LEFT = 0;
    const LED_RIGHT = 1;

    const DEVICE_IDENTIFIER = 230;

    /**
     * Creates an object with the unique device ID $uid. This object can
     * then be added to the IP connection.
     *
     * @param string $uid
     */
    public function __construct($uid, $ipcon)
    {
        parent::__construct($uid, $ipcon);

        $this->apiVersion = array(2, 0, 0);

        $this->responseExpected[self::FUNCTION_SET_LED_STATE] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_GET_LED_STATE] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_GET_BUTTON_STATE] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::CALLBACK_STATE_CHANGED] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::FUNCTION_SET_SELECTED_LED_STATE] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_GET_IDENTITY] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;

        $this->callbackWrappers[self::CALLBACK_STATE_CHANGED] = 'callbackWrapperStateChanged';
    }

    /**
     * @internal
     * @param string $header
     * @param string $data
     */
    public function handleCallback($header, $data)
    {
        call_user_func(array($this, $this->callbackWrappers[$header['functionID']]), $data);
    }

    /**
     * Sets the state of the LEDs. Possible states are:
     * 
     * * 0 = AutoToggleOn: Enables auto toggle with initially enabled LED.
     * * 1 = AutoToggleOff: Activates auto toggle with initially disabled LED.
     * * 2 = On: Enables LED (auto toggle is disabled).
     * * 3 = Off: Disables LED (auto toggle is disabled).
     * 
     * In auto toggle mode the LED is toggled automatically at each press of a button.
     * 
     * If you just want to set one of the LEDs and don't know the current state
     * of the other LED, you can get the state with BrickletDualButton::getLEDState() or you
     * can use BrickletDualButton::setSelectedLEDState().
     * 
     * The default value is (1, 1).
     * 
     * @param int $led_l
     * @param int $led_r
     * 
     * @return void
     */
    public function setLEDState($led_l, $led_r)
    {
        $payload = '';
        $payload .= pack('C', $led_l);
        $payload .= pack('C', $led_r);

        $this->sendRequest(self::FUNCTION_SET_LED_STATE, $payload);
    }

    /**
     * Returns the current state of the LEDs, as set by BrickletDualButton::setLEDState().
     * 
     * 
     * @return array
     */
    public function getLEDState()
    {
        $result = array();

        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_LED_STATE, $payload);

        $payload = unpack('C1led_l/C1led_r', $data);

        $result['led_l'] = $payload['led_l'];
        $result['led_r'] = $payload['led_r'];

        return $result;
    }

    /**
     * Returns the current state for both buttons. Possible states are:
     * 
     * * 0 = pressed
     * * 1 = released
     * 
     * 
     * @return array
     */
    public function getButtonState()
    {
        $result = array();

        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_BUTTON_STATE, $payload);

        $payload = unpack('C1button_l/C1button_r', $data);

        $result['button_l'] = $payload['button_l'];
        $result['button_r'] = $payload['button_r'];

        return $result;
    }

    /**
     * Sets the state of the selected LED (0 or 1). 
     * 
     * The other LED remains untouched.
     * 
     * @param int $led
     * @param int $state
     * 
     * @return void
     */
    public function setSelectedLEDState($led, $state)
    {
        $payload = '';
        $payload .= pack('C', $led);
        $payload .= pack('C', $state);

        $this->sendRequest(self::FUNCTION_SET_SELECTED_LED_STATE, $payload);
    }

    /**
     * Returns the UID, the UID where the Bricklet is connected to, 
     * the position, the hardware and firmware version as well as the
     * device identifier.
     * 
     * The position can be 'a', 'b', 'c' or 'd'.
     * 
     * The device identifier numbers can be found :ref:`here <device_identifier>`.
     * |device_identifier_constant|
     * 
     * 
     * @return array
     */
    public function getIdentity()
    {
        $result = array();

        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_IDENTITY, $payload);

        $payload = unpack('c8uid/c8connected_uid/c1position/C3hardware_version/C3firmware_version/v1device_identifier', $data);

        $result['uid'] = IPConnection::implodeUnpackedString($payload, 'uid', 8);
        $result['connected_uid'] = IPConnection::implodeUnpackedString($payload, 'connected_uid', 8);
        $result['position'] = chr($payload['position']);
        $result['hardware_version'] = IPConnection::collectUnpackedArray($payload, 'hardware_version', 3);
        $result['firmware_version'] = IPConnection::collectUnpackedArray($payload, 'firmware_version', 3);
        $result['device_identifier'] = $payload['device_identifier'];

        return $result;
    }

    /**
     * Registers a callback with ID $id to the callable $callback.
     *
     * @param int $id
     * @param callable $callback
     * @param mixed $userData
     *
     * @return void
     */
    public function registerCallback($id, $callback, $userData = NULL)
    {
        if (!is_callable($callback)) {
            throw new \Exception('Callback function is not callable');
        }

        $this->registeredCallbacks[$id] = $callback;
        $this->registeredCallbackUserData[$id] = $userData;
    }

    /**
     * @internal
     * @param string $data
     */
    public function callbackWrapperStateChanged($data)
    {
        $result = array();
        $payload = unpack('C1button_l/C1button_r/C1led_l/C1led_r', $data);

        array_push($result, $payload['button_l']);
        array_push($result, $payload['button_r']);
        array_push($result, $payload['led_l']);
        array_push($result, $payload['led_r']);
        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_STATE_CHANGED]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_STATE_CHANGED], $result);
    }
}

?>
