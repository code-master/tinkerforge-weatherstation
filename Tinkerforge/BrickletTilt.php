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
 * Device for sensing tilt and vibration
 */
class BrickletTilt extends Device
{

    /**
     * This callback provides the current tilt state. It is called every time the
     * state changes.
     * 
     * See BrickletTilt::getTiltState() for a description of the states.
     */
    const CALLBACK_TILT_STATE = 5;


    /**
     * @internal
     */
    const FUNCTION_GET_TILT_STATE = 1;

    /**
     * @internal
     */
    const FUNCTION_ENABLE_TILT_STATE_CALLBACK = 2;

    /**
     * @internal
     */
    const FUNCTION_DISABLE_TILT_STATE_CALLBACK = 3;

    /**
     * @internal
     */
    const FUNCTION_IS_TILT_STATE_CALLBACK_ENABLED = 4;

    /**
     * @internal
     */
    const FUNCTION_GET_IDENTITY = 255;

    const TILT_STATE_CLOSED = 0;
    const TILT_STATE_OPEN = 1;
    const TILT_STATE_CLOSED_VIBRATING = 2;

    const DEVICE_IDENTIFIER = 239;

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

        $this->responseExpected[self::FUNCTION_GET_TILT_STATE] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_ENABLE_TILT_STATE_CALLBACK] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_DISABLE_TILT_STATE_CALLBACK] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_IS_TILT_STATE_CALLBACK_ENABLED] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::CALLBACK_TILT_STATE] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::FUNCTION_GET_IDENTITY] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;

        $this->callbackWrappers[self::CALLBACK_TILT_STATE] = 'callbackWrapperTiltState';
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
     * Returns the current tilt state. The state can either be
     * 
     * * 0 = Closed: The ball in the tilt switch closes the circuit.
     * * 1 = Open: The ball in the tilt switch does not close the circuit.
     * * 2 = Closed Vibrating: The tilt switch is in motion (rapid change between open and close).
     * 
     * .. image:: /Images/Bricklets/bricklet_tilt_mechanics.jpg
     *    :scale: 100 %
     *    :alt: Tilt states
     *    :align: center
     *    :target: ../../_images/Bricklets/bricklet_tilt_mechanics.jpg
     * 
     * 
     * @return int
     */
    public function getTiltState()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_TILT_STATE, $payload);

        $payload = unpack('C1state', $data);

        return $payload['state'];
    }

    /**
     * Enables the BrickletTilt::CALLBACK_TILT_STATE callback.
     * 
     * 
     * @return void
     */
    public function enableTiltStateCallback()
    {
        $payload = '';

        $this->sendRequest(self::FUNCTION_ENABLE_TILT_STATE_CALLBACK, $payload);
    }

    /**
     * Disables the BrickletTilt::CALLBACK_TILT_STATE callback.
     * 
     * 
     * @return void
     */
    public function disableTiltStateCallback()
    {
        $payload = '';

        $this->sendRequest(self::FUNCTION_DISABLE_TILT_STATE_CALLBACK, $payload);
    }

    /**
     * Returns *true* if the BrickletTilt::CALLBACK_TILT_STATE callback is enabled.
     * 
     * 
     * @return bool
     */
    public function isTiltStateCallbackEnabled()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_IS_TILT_STATE_CALLBACK_ENABLED, $payload);

        $payload = unpack('C1enabled', $data);

        return (bool)$payload['enabled'];
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
    public function callbackWrapperTiltState($data)
    {
        $result = array();
        $payload = unpack('C1state', $data);

        array_push($result, $payload['state']);
        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_TILT_STATE]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_TILT_STATE], $result);
    }
}

?>
