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
 * Device for sensing Rotary Encoder input
 */
class BrickletRotaryEncoder extends Device
{

    /**
     * This callback is triggered periodically with the period that is set by
     * BrickletRotaryEncoder::setCountCallbackPeriod(). The parameter is the count of
     * the encoder.
     * 
     * BrickletRotaryEncoder::CALLBACK_COUNT is only triggered if the count has changed since the
     * last triggering.
     */
    const CALLBACK_COUNT = 8;

    /**
     * This callback is triggered when the threshold as set by
     * BrickletRotaryEncoder::setCountCallbackThreshold() is reached.
     * The parameter is the count of the encoder.
     * 
     * If the threshold keeps being reached, the callback is triggered periodically
     * with the period as set by BrickletRotaryEncoder::setDebouncePeriod().
     */
    const CALLBACK_COUNT_REACHED = 9;

    /**
     * This callback is triggered when the button is pressed.
     */
    const CALLBACK_PRESSED = 11;

    /**
     * This callback is triggered when the button is released.
     */
    const CALLBACK_RELEASED = 12;


    /**
     * @internal
     */
    const FUNCTION_GET_COUNT = 1;

    /**
     * @internal
     */
    const FUNCTION_SET_COUNT_CALLBACK_PERIOD = 2;

    /**
     * @internal
     */
    const FUNCTION_GET_COUNT_CALLBACK_PERIOD = 3;

    /**
     * @internal
     */
    const FUNCTION_SET_COUNT_CALLBACK_THRESHOLD = 4;

    /**
     * @internal
     */
    const FUNCTION_GET_COUNT_CALLBACK_THRESHOLD = 5;

    /**
     * @internal
     */
    const FUNCTION_SET_DEBOUNCE_PERIOD = 6;

    /**
     * @internal
     */
    const FUNCTION_GET_DEBOUNCE_PERIOD = 7;

    /**
     * @internal
     */
    const FUNCTION_IS_PRESSED = 10;

    /**
     * @internal
     */
    const FUNCTION_GET_IDENTITY = 255;

    const THRESHOLD_OPTION_OFF = 'x';
    const THRESHOLD_OPTION_OUTSIDE = 'o';
    const THRESHOLD_OPTION_INSIDE = 'i';
    const THRESHOLD_OPTION_SMALLER = '<';
    const THRESHOLD_OPTION_GREATER = '>';

    const DEVICE_IDENTIFIER = 236;

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

        $this->responseExpected[self::FUNCTION_GET_COUNT] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_COUNT_CALLBACK_PERIOD] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_COUNT_CALLBACK_PERIOD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_COUNT_CALLBACK_THRESHOLD] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_COUNT_CALLBACK_THRESHOLD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_DEBOUNCE_PERIOD] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_DEBOUNCE_PERIOD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::CALLBACK_COUNT] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::CALLBACK_COUNT_REACHED] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::FUNCTION_IS_PRESSED] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::CALLBACK_PRESSED] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::CALLBACK_RELEASED] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::FUNCTION_GET_IDENTITY] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;

        $this->callbackWrappers[self::CALLBACK_COUNT] = 'callbackWrapperCount';
        $this->callbackWrappers[self::CALLBACK_COUNT_REACHED] = 'callbackWrapperCountReached';
        $this->callbackWrappers[self::CALLBACK_PRESSED] = 'callbackWrapperPressed';
        $this->callbackWrappers[self::CALLBACK_RELEASED] = 'callbackWrapperReleased';
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
     * Returns the current count of the encoder. If you set reset
     * to true, the count is set back to 0 directly after the
     * current count is read.
     * 
     * The encoder has 24 steps per rotation
     * 
     * Turning the encoder to the left decrements the counter,
     * so a negative count is possible.
     * 
     * @param bool $reset
     * 
     * @return int
     */
    public function getCount($reset)
    {
        $payload = '';
        $payload .= pack('C', intval((bool)$reset));

        $data = $this->sendRequest(self::FUNCTION_GET_COUNT, $payload);

        $payload = unpack('V1count', $data);

        return IPConnection::fixUnpackedInt32($payload['count']);
    }

    /**
     * Sets the period in ms with which the BrickletRotaryEncoder::CALLBACK_COUNT callback is triggered
     * periodically. A value of 0 turns the callback off.
     * 
     * BrickletRotaryEncoder::CALLBACK_COUNT is only triggered if the count has changed since the
     * last triggering.
     * 
     * The default value is 0.
     * 
     * @param int $period
     * 
     * @return void
     */
    public function setCountCallbackPeriod($period)
    {
        $payload = '';
        $payload .= pack('V', $period);

        $this->sendRequest(self::FUNCTION_SET_COUNT_CALLBACK_PERIOD, $payload);
    }

    /**
     * Returns the period as set by BrickletRotaryEncoder::setCountCallbackPeriod().
     * 
     * 
     * @return int
     */
    public function getCountCallbackPeriod()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_COUNT_CALLBACK_PERIOD, $payload);

        $payload = unpack('V1period', $data);

        return IPConnection::fixUnpackedUInt32($payload['period']);
    }

    /**
     * Sets the thresholds for the BrickletRotaryEncoder::CALLBACK_COUNT_REACHED callback. 
     * 
     * The following options are possible:
     * 
     * <code>
     *  "Option", "Description"
     * 
     *  "'x'",    "Callback is turned off"
     *  "'o'",    "Callback is triggered when the count is *outside* the min and max values"
     *  "'i'",    "Callback is triggered when the count is *inside* the min and max values"
     *  "'<'",    "Callback is triggered when the count is smaller than the min value (max is ignored)"
     *  "'>'",    "Callback is triggered when the count is greater than the min value (max is ignored)"
     * </code>
     * 
     * The default value is ('x', 0, 0).
     * 
     * @param string $option
     * @param int $min
     * @param int $max
     * 
     * @return void
     */
    public function setCountCallbackThreshold($option, $min, $max)
    {
        $payload = '';
        $payload .= pack('c', ord($option));
        $payload .= pack('V', $min);
        $payload .= pack('V', $max);

        $this->sendRequest(self::FUNCTION_SET_COUNT_CALLBACK_THRESHOLD, $payload);
    }

    /**
     * Returns the threshold as set by BrickletRotaryEncoder::setCountCallbackThreshold().
     * 
     * 
     * @return array
     */
    public function getCountCallbackThreshold()
    {
        $result = array();

        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_COUNT_CALLBACK_THRESHOLD, $payload);

        $payload = unpack('c1option/V1min/V1max', $data);

        $result['option'] = chr($payload['option']);
        $result['min'] = IPConnection::fixUnpackedInt32($payload['min']);
        $result['max'] = IPConnection::fixUnpackedInt32($payload['max']);

        return $result;
    }

    /**
     * Sets the period in ms with which the threshold callback
     * 
     * * BrickletRotaryEncoder::CALLBACK_COUNT_REACHED
     * 
     * is triggered, if the thresholds
     * 
     * * BrickletRotaryEncoder::setCountCallbackThreshold()
     * 
     * keeps being reached.
     * 
     * The default value is 100.
     * 
     * @param int $debounce
     * 
     * @return void
     */
    public function setDebouncePeriod($debounce)
    {
        $payload = '';
        $payload .= pack('V', $debounce);

        $this->sendRequest(self::FUNCTION_SET_DEBOUNCE_PERIOD, $payload);
    }

    /**
     * Returns the debounce period as set by BrickletRotaryEncoder::setDebouncePeriod().
     * 
     * 
     * @return int
     */
    public function getDebouncePeriod()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_DEBOUNCE_PERIOD, $payload);

        $payload = unpack('V1debounce', $data);

        return IPConnection::fixUnpackedUInt32($payload['debounce']);
    }

    /**
     * Returns *true* if the button is pressed and *false* otherwise.
     * 
     * It is recommended to use the BrickletRotaryEncoder::CALLBACK_PRESSED and BrickletRotaryEncoder::CALLBACK_RELEASED callbacks
     * to handle the button.
     * 
     * 
     * @return bool
     */
    public function isPressed()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_IS_PRESSED, $payload);

        $payload = unpack('C1pressed', $data);

        return (bool)$payload['pressed'];
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
    public function callbackWrapperCount($data)
    {
        $result = array();
        $payload = unpack('V1count', $data);

        array_push($result, IPConnection::fixUnpackedInt32($payload['count']));
        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_COUNT]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_COUNT], $result);
    }

    /**
     * @internal
     * @param string $data
     */
    public function callbackWrapperCountReached($data)
    {
        $result = array();
        $payload = unpack('V1count', $data);

        array_push($result, IPConnection::fixUnpackedInt32($payload['count']));
        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_COUNT_REACHED]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_COUNT_REACHED], $result);
    }

    /**
     * @internal
     * @param string $data
     */
    public function callbackWrapperPressed($data)
    {
        $result = array();



        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_PRESSED]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_PRESSED], $result);
    }

    /**
     * @internal
     * @param string $data
     */
    public function callbackWrapperReleased($data)
    {
        $result = array();



        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_RELEASED]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_RELEASED], $result);
    }
}

?>
