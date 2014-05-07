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
 * Device that reads out PIR motion detector
 */
class BrickletMotionDetector extends Device
{

    /**
     * This callback is called after a motion was detected.
     */
    const CALLBACK_MOTION_DETECTED = 2;

    /**
     * This callback is called when the detection cycle ended. When this
     * callback is called, a new motion can be detected again after approximately 2
     * seconds.
     */
    const CALLBACK_DETECTION_CYCLE_ENDED = 3;


    /**
     * @internal
     */
    const FUNCTION_GET_MOTION_DETECTED = 1;

    /**
     * @internal
     */
    const FUNCTION_GET_IDENTITY = 255;

    const MOTION_NOT_DETECTED = 0;
    const MOTION_DETECTED = 1;

    const DEVICE_IDENTIFIER = 233;

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

        $this->responseExpected[self::FUNCTION_GET_MOTION_DETECTED] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::CALLBACK_MOTION_DETECTED] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::CALLBACK_DETECTION_CYCLE_ENDED] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::FUNCTION_GET_IDENTITY] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;

        $this->callbackWrappers[self::CALLBACK_MOTION_DETECTED] = 'callbackWrapperMotionDetected';
        $this->callbackWrappers[self::CALLBACK_DETECTION_CYCLE_ENDED] = 'callbackWrapperDetectionCycleEnded';
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
     * Returns 1 if a motion was detected. How long this returns 1 after a motion
     * was detected can be adjusted with one of the small potentiometers on the
     * Motion Detector Bricklet, see :ref:`here
     * <motion_detector_bricklet_sensitivity_delay_block_time>`.
     * 
     * There is also a blue LED on the Bricklet that is on as long as the Bricklet is
     * in the "motion detected" state.
     * 
     * 
     * @return int
     */
    public function getMotionDetected()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_MOTION_DETECTED, $payload);

        $payload = unpack('C1motion', $data);

        return $payload['motion'];
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
    public function callbackWrapperMotionDetected($data)
    {
        $result = array();



        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_MOTION_DETECTED]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_MOTION_DETECTED], $result);
    }

    /**
     * @internal
     * @param string $data
     */
    public function callbackWrapperDetectionCycleEnded($data)
    {
        $result = array();



        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_DETECTION_CYCLE_ENDED]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_DETECTION_CYCLE_ENDED], $result);
    }
}

?>
