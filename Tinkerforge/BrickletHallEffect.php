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
 * Device that detects presence of magnetic field via hall effect
 */
class BrickletHallEffect extends Device
{

    /**
     * This callback is triggered periodically with the period that is set by
     * BrickletHallEffect::setEdgeCountCallbackPeriod(). The parameters are the
     * current count and the current value (see BrickletHallEffect::getValue() and BrickletHallEffect::getEdgeCount()).
     * 
     * BrickletHallEffect::CALLBACK_EDGE_COUNT is only triggered if the count or value changed since the
     * last triggering.
     */
    const CALLBACK_EDGE_COUNT = 10;


    /**
     * @internal
     */
    const FUNCTION_GET_VALUE = 1;

    /**
     * @internal
     */
    const FUNCTION_GET_EDGE_COUNT = 2;

    /**
     * @internal
     */
    const FUNCTION_SET_EDGE_COUNT_CONFIG = 3;

    /**
     * @internal
     */
    const FUNCTION_GET_EDGE_COUNT_CONFIG = 4;

    /**
     * @internal
     */
    const FUNCTION_SET_EDGE_INTERRUPT = 5;

    /**
     * @internal
     */
    const FUNCTION_GET_EDGE_INTERRUPT = 6;

    /**
     * @internal
     */
    const FUNCTION_SET_EDGE_COUNT_CALLBACK_PERIOD = 7;

    /**
     * @internal
     */
    const FUNCTION_GET_EDGE_COUNT_CALLBACK_PERIOD = 8;

    /**
     * @internal
     */
    const FUNCTION_EDGE_INTERRUPT = 9;

    /**
     * @internal
     */
    const FUNCTION_GET_IDENTITY = 255;

    const EDGE_TYPE_RISING = 0;
    const EDGE_TYPE_FALLING = 1;
    const EDGE_TYPE_BOTH = 2;

    const DEVICE_IDENTIFIER = 240;

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

        $this->responseExpected[self::FUNCTION_GET_VALUE] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_GET_EDGE_COUNT] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_EDGE_COUNT_CONFIG] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_GET_EDGE_COUNT_CONFIG] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_EDGE_INTERRUPT] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_EDGE_INTERRUPT] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_EDGE_COUNT_CALLBACK_PERIOD] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_EDGE_COUNT_CALLBACK_PERIOD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_EDGE_INTERRUPT] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::CALLBACK_EDGE_COUNT] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::FUNCTION_GET_IDENTITY] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;

        $this->callbackWrappers[self::CALLBACK_EDGE_COUNT] = 'callbackWrapperEdgeCount';
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
     * Returns *true* if a magnetic field of 35 Gauss (3.5mT) or greater is detected.
     * 
     * 
     * @return bool
     */
    public function getValue()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_VALUE, $payload);

        $payload = unpack('C1value', $data);

        return (bool)$payload['value'];
    }

    /**
     * Returns the current value of the edge counter. You can configure
     * edge type (rising, falling, both) that is counted with
     * BrickletHallEffect::setEdgeCountConfig().
     * 
     * If you set the reset counter to *true*, the count is set back to 0
     * directly after it is read.
     * 
     * @param bool $reset_counter
     * 
     * @return int
     */
    public function getEdgeCount($reset_counter)
    {
        $payload = '';
        $payload .= pack('C', intval((bool)$reset_counter));

        $data = $this->sendRequest(self::FUNCTION_GET_EDGE_COUNT, $payload);

        $payload = unpack('V1count', $data);

        return IPConnection::fixUnpackedUInt32($payload['count']);
    }

    /**
     * The edge type parameter configures if rising edges, falling edges or 
     * both are counted. Possible edge types are:
     * 
     * * 0 = rising (default)
     * * 1 = falling
     * * 2 = both
     * 
     * A magnetic field of 35 Gauss (3.5mT) or greater causes a falling edge and a
     * magnetic field of 25 Gauss (2.5mT) or smaller causes a rising edge.
     * 
     * If a magnet comes near the Bricklet the signal goes low (falling edge), if
     * a magnet is removed from the vicinity the signal goes high (rising edge).
     * 
     * The debounce time is given in ms.
     * 
     * Configuring an edge counter resets its value to 0.
     * 
     * If you don't know what any of this means, just leave it at default. The
     * default configuration is very likely OK for you.
     * 
     * Default values: 0 (edge type) and 100ms (debounce time)
     * 
     * @param int $edge_type
     * @param int $debounce
     * 
     * @return void
     */
    public function setEdgeCountConfig($edge_type, $debounce)
    {
        $payload = '';
        $payload .= pack('C', $edge_type);
        $payload .= pack('C', $debounce);

        $this->sendRequest(self::FUNCTION_SET_EDGE_COUNT_CONFIG, $payload);
    }

    /**
     * Returns the edge type and debounce time as set by BrickletHallEffect::setEdgeCountConfig().
     * 
     * 
     * @return array
     */
    public function getEdgeCountConfig()
    {
        $result = array();

        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_EDGE_COUNT_CONFIG, $payload);

        $payload = unpack('C1edge_type/C1debounce', $data);

        $result['edge_type'] = $payload['edge_type'];
        $result['debounce'] = $payload['debounce'];

        return $result;
    }

    /**
     * Sets the number of edges until an interrupt is invoked.
     * 
     * If *edges* is set to n, an interrupt is invoked for every n-th detected edge.
     * 
     * If *edges* is set to 0, the interrupt is disabled.
     * 
     * Default value is 0.
     * 
     * @param int $edges
     * 
     * @return void
     */
    public function setEdgeInterrupt($edges)
    {
        $payload = '';
        $payload .= pack('V', $edges);

        $this->sendRequest(self::FUNCTION_SET_EDGE_INTERRUPT, $payload);
    }

    /**
     * Returns the edges as set by BrickletHallEffect::setEdgeInterrupt().
     * 
     * 
     * @return int
     */
    public function getEdgeInterrupt()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_EDGE_INTERRUPT, $payload);

        $payload = unpack('V1edges', $data);

        return IPConnection::fixUnpackedUInt32($payload['edges']);
    }

    /**
     * Sets the period in ms with which the BrickletHallEffect::CALLBACK_EDGE_COUNT callback is triggered
     * periodically. A value of 0 turns the callback off.
     * 
     * BrickletHallEffect::CALLBACK_EDGE_COUNT is only triggered if the edge count has changed since the
     * last triggering.
     * 
     * The default value is 0.
     * 
     * @param int $period
     * 
     * @return void
     */
    public function setEdgeCountCallbackPeriod($period)
    {
        $payload = '';
        $payload .= pack('V', $period);

        $this->sendRequest(self::FUNCTION_SET_EDGE_COUNT_CALLBACK_PERIOD, $payload);
    }

    /**
     * Returns the period as set by BrickletHallEffect::setEdgeCountCallbackPeriod().
     * 
     * 
     * @return int
     */
    public function getEdgeCountCallbackPeriod()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_EDGE_COUNT_CALLBACK_PERIOD, $payload);

        $payload = unpack('V1period', $data);

        return IPConnection::fixUnpackedUInt32($payload['period']);
    }

    /**
     * This callback is triggered every n-th count, as configured with
     * BrickletHallEffect::setEdgeInterrupt(). The parameters are the
     * current count and the current value (see BrickletHallEffect::getValue() and BrickletHallEffect::getEdgeCount()).
     * 
     * 
     * @return array
     */
    public function edgeInterrupt()
    {
        $result = array();

        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_EDGE_INTERRUPT, $payload);

        $payload = unpack('V1count/C1value', $data);

        $result['count'] = IPConnection::fixUnpackedUInt32($payload['count']);
        $result['value'] = (bool)$payload['value'];

        return $result;
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
    public function callbackWrapperEdgeCount($data)
    {
        $result = array();
        $payload = unpack('V1count/C1value', $data);

        array_push($result, IPConnection::fixUnpackedUInt32($payload['count']));
        array_push($result, (bool)$payload['value']);
        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_EDGE_COUNT]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_EDGE_COUNT], $result);
    }
}

?>
