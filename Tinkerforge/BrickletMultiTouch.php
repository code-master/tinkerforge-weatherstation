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
 * Device with 12 touch sensors
 */
class BrickletMultiTouch extends Device
{

    /**
     * Returns the current touch state, see BrickletMultiTouch::getTouchState() for
     * information about the state.
     * 
     * This callback is triggered every time the touch state changes.
     */
    const CALLBACK_TOUCH_STATE = 5;


    /**
     * @internal
     */
    const FUNCTION_GET_TOUCH_STATE = 1;

    /**
     * @internal
     */
    const FUNCTION_RECALIBRATE = 2;

    /**
     * @internal
     */
    const FUNCTION_SET_ELECTRODE_CONFIG = 3;

    /**
     * @internal
     */
    const FUNCTION_GET_ELECTRODE_CONFIG = 4;

    /**
     * @internal
     */
    const FUNCTION_SET_ELECTRODE_SENSITIVITY = 6;

    /**
     * @internal
     */
    const FUNCTION_GET_ELECTRODE_SENSITIVITY = 7;

    /**
     * @internal
     */
    const FUNCTION_GET_IDENTITY = 255;


    const DEVICE_IDENTIFIER = 234;

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

        $this->responseExpected[self::FUNCTION_GET_TOUCH_STATE] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_RECALIBRATE] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_SET_ELECTRODE_CONFIG] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_GET_ELECTRODE_CONFIG] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::CALLBACK_TOUCH_STATE] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::FUNCTION_SET_ELECTRODE_SENSITIVITY] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_GET_ELECTRODE_SENSITIVITY] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_GET_IDENTITY] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;

        $this->callbackWrappers[self::CALLBACK_TOUCH_STATE] = 'callbackWrapperTouchState';
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
     * Returns the current touch state. The state is given as a bitfield.
     * 
     * Bits 0 to 11 represent the 12 electrodes and bit 12 represents
     * the proximity.
     * 
     * If an electrode is touched, the corresponding bit is true. If
     * a hand or similar is in proximity to the electrodes, bit 12 is
     * *true*.
     * 
     * Example: The state 4103 = 0x1007 = 0b1000000000111 means that
     * electrodes 0, 1 and 2 are touched and that something is in the
     * proximity of the electrodes.
     * 
     * The proximity is activated with a distance of 1-2cm. An electrode
     * is already counted as touched if a finger is nearly touching the
     * electrode. This means that you can put a piece of paper or foil
     * or similar on top of a electrode to build a touch panel with
     * a professional look.
     * 
     * 
     * @return int
     */
    public function getTouchState()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_TOUCH_STATE, $payload);

        $payload = unpack('v1state', $data);

        return $payload['state'];
    }

    /**
     * Recalibrates the electrodes. Call this function whenever you changed
     * or moved you electrodes.
     * 
     * 
     * @return void
     */
    public function recalibrate()
    {
        $payload = '';

        $this->sendRequest(self::FUNCTION_RECALIBRATE, $payload);
    }

    /**
     * Enables/disables electrodes with a bitfield (see BrickletMultiTouch::getTouchState()).
     * 
     * *True* enables the electrode, *false* disables the electrode. A
     * disabled electrode will always return *false* as its state. If you
     * don't need all electrodes you can disable the electrodes that are
     * not needed.
     * 
     * It is recommended that you disable the proximity bit (bit 12) if
     * the proximity feature is not needed. This will reduce the amount of
     * traffic that is produced by the BrickletMultiTouch::CALLBACK_TOUCH_STATE callback.
     * 
     * Disabling electrodes will also reduce power consumption.
     * 
     * Default: 8191 = 0x1FFF = 0b1111111111111 (all electrodes enabled)
     * 
     * @param int $enabled_electrodes
     * 
     * @return void
     */
    public function setElectrodeConfig($enabled_electrodes)
    {
        $payload = '';
        $payload .= pack('v', $enabled_electrodes);

        $this->sendRequest(self::FUNCTION_SET_ELECTRODE_CONFIG, $payload);
    }

    /**
     * Returns the electrode configuration, as set by BrickletMultiTouch::setElectrodeConfig().
     * 
     * 
     * @return int
     */
    public function getElectrodeConfig()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_ELECTRODE_CONFIG, $payload);

        $payload = unpack('v1enabled_electrodes', $data);

        return $payload['enabled_electrodes'];
    }

    /**
     * Sets the sensitivity of the electrodes. An electrode with a high sensitivity
     * will register a touch earlier then an electrode with a low sensitivity.
     * 
     * If you build a big electrode you might need to decrease the sensitivity, since
     * the area that can be charged will get bigger. If you want to be able to
     * activate an electrode from further away you need to increase the sensitivity.
     * 
     * After a new sensitivity is set, you likely want to call BrickletMultiTouch::recalibrate()
     * to calibrate the electrodes with the newly defined sensitivity.
     * 
     * The valid sensitivity value range is 5-201.
     * 
     * The default sensitivity value is 181.
     * 
     * @param int $sensitivity
     * 
     * @return void
     */
    public function setElectrodeSensitivity($sensitivity)
    {
        $payload = '';
        $payload .= pack('C', $sensitivity);

        $this->sendRequest(self::FUNCTION_SET_ELECTRODE_SENSITIVITY, $payload);
    }

    /**
     * Returns the current sensitivity, as set by BrickletMultiTouch::setElectrodeSensitivity().
     * 
     * 
     * @return int
     */
    public function getElectrodeSensitivity()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_ELECTRODE_SENSITIVITY, $payload);

        $payload = unpack('C1sensitivity', $data);

        return $payload['sensitivity'];
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
    public function callbackWrapperTouchState($data)
    {
        $result = array();
        $payload = unpack('v1state', $data);

        array_push($result, $payload['state']);
        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_TOUCH_STATE]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_TOUCH_STATE], $result);
    }
}

?>
