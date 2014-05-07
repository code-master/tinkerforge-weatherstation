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
 * Device for controling four 7-segment displays
 */
class BrickletSegmentDisplay4x7 extends Device
{

    /**
     * This callback is triggered when the counter (see BrickletSegmentDisplay4x7::startCounter()) is
     * finished.
     */
    const CALLBACK_COUNTER_FINISHED = 5;


    /**
     * @internal
     */
    const FUNCTION_SET_SEGMENTS = 1;

    /**
     * @internal
     */
    const FUNCTION_GET_SEGMENTS = 2;

    /**
     * @internal
     */
    const FUNCTION_START_COUNTER = 3;

    /**
     * @internal
     */
    const FUNCTION_GET_COUNTER_VALUE = 4;

    /**
     * @internal
     */
    const FUNCTION_GET_IDENTITY = 255;


    const DEVICE_IDENTIFIER = 237;

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

        $this->responseExpected[self::FUNCTION_SET_SEGMENTS] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_GET_SEGMENTS] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_START_COUNTER] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_GET_COUNTER_VALUE] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::CALLBACK_COUNTER_FINISHED] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::FUNCTION_GET_IDENTITY] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;

        $this->callbackWrappers[self::CALLBACK_COUNTER_FINISHED] = 'callbackWrapperCounterFinished';
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
     * The 7-segment display can be set with bitmaps. Every bit controls one
     * segment:
     * 
     * .. image:: /Images/Bricklets/bricklet_segment_display_4x7_bit_order.png
     *    :scale: 100 %
     *    :alt: Bit order of one segment
     *    :align: center
     * 
     * For example to set a "5" you would want to activate segments 0, 2, 3, 5 and 6.
     * This is represented by the number 0b01101101 = 0x6d = 109.
     * 
     * The brightness can be set between 0 (dark) and 7 (bright). The colon
     * parameter turns the colon of the display on or off.
     * 
     * @param int[] $segments
     * @param int $brightness
     * @param bool $colon
     * 
     * @return void
     */
    public function setSegments($segments, $brightness, $colon)
    {
        $payload = '';
        for ($i = 0; $i < 4; $i++) {
            $payload .= pack('C', $segments[$i]);
        }
        $payload .= pack('C', $brightness);
        $payload .= pack('C', intval((bool)$colon));

        $this->sendRequest(self::FUNCTION_SET_SEGMENTS, $payload);
    }

    /**
     * Returns the segment, brightness and color data as set by 
     * BrickletSegmentDisplay4x7::setSegments().
     * 
     * 
     * @return array
     */
    public function getSegments()
    {
        $result = array();

        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_SEGMENTS, $payload);

        $payload = unpack('C4segments/C1brightness/C1colon', $data);

        $result['segments'] = IPConnection::collectUnpackedArray($payload, 'segments', 4);
        $result['brightness'] = $payload['brightness'];
        $result['colon'] = (bool)$payload['colon'];

        return $result;
    }

    /**
     * Starts a counter with the *from* value that counts to the *to*
     * value with the each step incremented by *increment*.
     * The *length* of the increment is given in ms.
     * 
     * Example: If you set *from* to 0, *to* to 100, *increment* to 1 and
     * *length* to 1000, a counter that goes from 0 to 100 with 1 second
     * pause between each increment will be started.
     * 
     * The maximum values for *from*, *to* and *increment* is 9999, 
     * the minimum value is -999.
     * 
     * You can stop the counter at every time by calling BrickletSegmentDisplay4x7::setSegments().
     * 
     * @param int $value_from
     * @param int $value_to
     * @param int $increment
     * @param int $length
     * 
     * @return void
     */
    public function startCounter($value_from, $value_to, $increment, $length)
    {
        $payload = '';
        $payload .= pack('v', $value_from);
        $payload .= pack('v', $value_to);
        $payload .= pack('v', $increment);
        $payload .= pack('V', $length);

        $this->sendRequest(self::FUNCTION_START_COUNTER, $payload);
    }

    /**
     * Returns the counter value that is currently shown on the display.
     * 
     * If there is no counter running a 0 will be returned.
     * 
     * 
     * @return int
     */
    public function getCounterValue()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_COUNTER_VALUE, $payload);

        $payload = unpack('v1value', $data);

        return $payload['value'];
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
    public function callbackWrapperCounterFinished($data)
    {
        $result = array();



        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_COUNTER_FINISHED]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_COUNTER_FINISHED], $result);
    }
}

?>
