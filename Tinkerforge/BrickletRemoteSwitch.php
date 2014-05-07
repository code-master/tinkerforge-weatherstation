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
 * Device that controls mains switches remotely
 */
class BrickletRemoteSwitch extends Device
{

    /**
     * This callback is called whenever the switching state changes
     * from busy to ready, see BrickletRemoteSwitch::getSwitchingState().
     */
    const CALLBACK_SWITCHING_DONE = 3;


    /**
     * @internal
     */
    const FUNCTION_SWITCH_SOCKET = 1;

    /**
     * @internal
     */
    const FUNCTION_GET_SWITCHING_STATE = 2;

    /**
     * @internal
     */
    const FUNCTION_SET_REPEATS = 4;

    /**
     * @internal
     */
    const FUNCTION_GET_REPEATS = 5;

    /**
     * @internal
     */
    const FUNCTION_SWITCH_SOCKET_A = 6;

    /**
     * @internal
     */
    const FUNCTION_SWITCH_SOCKET_B = 7;

    /**
     * @internal
     */
    const FUNCTION_DIM_SOCKET_B = 8;

    /**
     * @internal
     */
    const FUNCTION_SWITCH_SOCKET_C = 9;

    /**
     * @internal
     */
    const FUNCTION_GET_IDENTITY = 255;

    const SWITCH_TO_OFF = 0;
    const SWITCH_TO_ON = 1;
    const SWITCHING_STATE_READY = 0;
    const SWITCHING_STATE_BUSY = 1;

    const DEVICE_IDENTIFIER = 235;

    /**
     * Creates an object with the unique device ID $uid. This object can
     * then be added to the IP connection.
     *
     * @param string $uid
     */
    public function __construct($uid, $ipcon)
    {
        parent::__construct($uid, $ipcon);

        $this->apiVersion = array(2, 0, 1);

        $this->responseExpected[self::FUNCTION_SWITCH_SOCKET] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_GET_SWITCHING_STATE] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::CALLBACK_SWITCHING_DONE] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::FUNCTION_SET_REPEATS] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_GET_REPEATS] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SWITCH_SOCKET_A] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_SWITCH_SOCKET_B] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_DIM_SOCKET_B] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_SWITCH_SOCKET_C] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_GET_IDENTITY] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;

        $this->callbackWrappers[self::CALLBACK_SWITCHING_DONE] = 'callbackWrapperSwitchingDone';
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
     * This function is deprecated, use BrickletRemoteSwitch::switchSocketA() instead.
     * 
     * @param int $house_code
     * @param int $receiver_code
     * @param int $switch_to
     * 
     * @return void
     */
    public function switchSocket($house_code, $receiver_code, $switch_to)
    {
        $payload = '';
        $payload .= pack('C', $house_code);
        $payload .= pack('C', $receiver_code);
        $payload .= pack('C', $switch_to);

        $this->sendRequest(self::FUNCTION_SWITCH_SOCKET, $payload);
    }

    /**
     * Returns the current switching state. If the current state is busy, the
     * Bricklet is currently sending a code to switch a socket. It will not
     * accept any calls of BrickletRemoteSwitch::switchSocket() until the state changes to ready.
     * 
     * How long the switching takes is dependent on the number of repeats, see
     * BrickletRemoteSwitch::setRepeats().
     * 
     * 
     * @return int
     */
    public function getSwitchingState()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_SWITCHING_STATE, $payload);

        $payload = unpack('C1state', $data);

        return $payload['state'];
    }

    /**
     * Sets the number of times the code is send when of the BrickletRemoteSwitch::switchSocket()
     * functions is called. The repeats basically correspond to the amount of time
     * that a button of the remote is pressed.
     * 
     * Some dimmers are controlled by the length of a button pressed,
     * this can be simulated by increasing the repeats.
     * 
     * The default value is 5.
     * 
     * @param int $repeats
     * 
     * @return void
     */
    public function setRepeats($repeats)
    {
        $payload = '';
        $payload .= pack('C', $repeats);

        $this->sendRequest(self::FUNCTION_SET_REPEATS, $payload);
    }

    /**
     * Returns the number of repeats as set by BrickletRemoteSwitch::setRepeats().
     * 
     * 
     * @return int
     */
    public function getRepeats()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_REPEATS, $payload);

        $payload = unpack('C1repeats', $data);

        return $payload['repeats'];
    }

    /**
     * To switch a type A socket you have to give the house code, receiver code and the
     * state (on or off) you want to switch to.
     * 
     * The house code and receiver code have a range of 0 to 31 (5bit).
     * 
     * A detailed description on how you can figure out the house and receiver code
     * can be found :ref:`here <remote_switch_bricklet_type_a_house_and_receiver_code>`.
     * 
     * .. versionadded:: 2.0.1~(Plugin)
     * 
     * @param int $house_code
     * @param int $receiver_code
     * @param int $switch_to
     * 
     * @return void
     */
    public function switchSocketA($house_code, $receiver_code, $switch_to)
    {
        $payload = '';
        $payload .= pack('C', $house_code);
        $payload .= pack('C', $receiver_code);
        $payload .= pack('C', $switch_to);

        $this->sendRequest(self::FUNCTION_SWITCH_SOCKET_A, $payload);
    }

    /**
     * To switch a type B socket you have to give the address, unit and the state
     * (on or off) you want to switch to.
     * 
     * The address has a range of 0 to 67108863 (26bit) and the unit has a range
     * of 0 to 15 (4bit). To switch all devices with the same address use 255 for
     * the unit.
     * 
     * A detailed description on how you can teach a socket the address and unit can
     * be found :ref:`here <remote_switch_bricklet_type_b_address_and_unit>`.
     * 
     * .. versionadded:: 2.0.1~(Plugin)
     * 
     * @param int $address
     * @param int $unit
     * @param int $switch_to
     * 
     * @return void
     */
    public function switchSocketB($address, $unit, $switch_to)
    {
        $payload = '';
        $payload .= pack('V', $address);
        $payload .= pack('C', $unit);
        $payload .= pack('C', $switch_to);

        $this->sendRequest(self::FUNCTION_SWITCH_SOCKET_B, $payload);
    }

    /**
     * To control a type B dimmer you have to give the address, unit and the
     * dim value you want to set the dimmer to.
     * 
     * The address has a range of 0 to 67108863 (26bit), the unit and the dim value
     * has a range of 0 to 15 (4bit).
     * 
     * A detailed description on how you can teach a dimmer the address and unit can
     * be found :ref:`here <remote_switch_bricklet_type_b_address_and_unit>`.
     * 
     * .. versionadded:: 2.0.1~(Plugin)
     * 
     * @param int $address
     * @param int $unit
     * @param int $dim_value
     * 
     * @return void
     */
    public function dimSocketB($address, $unit, $dim_value)
    {
        $payload = '';
        $payload .= pack('V', $address);
        $payload .= pack('C', $unit);
        $payload .= pack('C', $dim_value);

        $this->sendRequest(self::FUNCTION_DIM_SOCKET_B, $payload);
    }

    /**
     * To switch a type C socket you have to give the system code, device code and the
     * state (on or off) you want to switch to.
     * 
     * The system code has a range of 'A' to 'P' (4bit) and the device code has a
     * range of 1 to 16 (4bit).
     * 
     * A detailed description on how you can figure out the system and device code
     * can be found :ref:`here <remote_switch_bricklet_type_c_system_and_device_code>`.
     * 
     * .. versionadded:: 2.0.1~(Plugin)
     * 
     * @param string $system_code
     * @param int $device_code
     * @param int $switch_to
     * 
     * @return void
     */
    public function switchSocketC($system_code, $device_code, $switch_to)
    {
        $payload = '';
        $payload .= pack('c', ord($system_code));
        $payload .= pack('C', $device_code);
        $payload .= pack('C', $switch_to);

        $this->sendRequest(self::FUNCTION_SWITCH_SOCKET_C, $payload);
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
    public function callbackWrapperSwitchingDone($data)
    {
        $result = array();



        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_SWITCHING_DONE]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_SWITCHING_DONE], $result);
    }
}

?>
