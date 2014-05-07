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
 * Device for sensing sound intensity
 */
class BrickletSoundIntensity extends Device
{

    /**
     * This callback is triggered periodically with the period that is set by
     * BrickletSoundIntensity::setIntensityCallbackPeriod(). The parameter is the intensity of
     * the encoder.
     * 
     * BrickletSoundIntensity::CALLBACK_INTENSITY is only triggered if the intensity has changed since the
     * last triggering.
     */
    const CALLBACK_INTENSITY = 8;

    /**
     * This callback is triggered when the threshold as set by
     * BrickletSoundIntensity::setIntensityCallbackThreshold() is reached.
     * The parameter is the intensity of the encoder.
     * 
     * If the threshold keeps being reached, the callback is triggered periodically
     * with the period as set by BrickletSoundIntensity::setDebouncePeriod().
     */
    const CALLBACK_INTENSITY_REACHED = 9;


    /**
     * @internal
     */
    const FUNCTION_GET_INTENSITY = 1;

    /**
     * @internal
     */
    const FUNCTION_SET_INTENSITY_CALLBACK_PERIOD = 2;

    /**
     * @internal
     */
    const FUNCTION_GET_INTENSITY_CALLBACK_PERIOD = 3;

    /**
     * @internal
     */
    const FUNCTION_SET_INTENSITY_CALLBACK_THRESHOLD = 4;

    /**
     * @internal
     */
    const FUNCTION_GET_INTENSITY_CALLBACK_THRESHOLD = 5;

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
    const FUNCTION_GET_IDENTITY = 255;

    const THRESHOLD_OPTION_OFF = 'x';
    const THRESHOLD_OPTION_OUTSIDE = 'o';
    const THRESHOLD_OPTION_INSIDE = 'i';
    const THRESHOLD_OPTION_SMALLER = '<';
    const THRESHOLD_OPTION_GREATER = '>';

    const DEVICE_IDENTIFIER = 238;

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

        $this->responseExpected[self::FUNCTION_GET_INTENSITY] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_INTENSITY_CALLBACK_PERIOD] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_INTENSITY_CALLBACK_PERIOD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_INTENSITY_CALLBACK_THRESHOLD] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_INTENSITY_CALLBACK_THRESHOLD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_DEBOUNCE_PERIOD] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_DEBOUNCE_PERIOD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::CALLBACK_INTENSITY] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::CALLBACK_INTENSITY_REACHED] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::FUNCTION_GET_IDENTITY] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;

        $this->callbackWrappers[self::CALLBACK_INTENSITY] = 'callbackWrapperIntensity';
        $this->callbackWrappers[self::CALLBACK_INTENSITY_REACHED] = 'callbackWrapperIntensityReached';
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
     * Returns the current sound intensity. The value has a range of
     * 0 to 4095.
     * 
     * The value corresponds to the `upper envelop <http://en.wikipedia.org/wiki/Envelope_(waves)>`__
     * of the signal of the microphone capsule.
     * 
     * If you want to get the intensity periodically, it is recommended to use the
     * callback BrickletSoundIntensity::CALLBACK_INTENSITY and set the period with 
     * BrickletSoundIntensity::setIntensityCallbackPeriod().
     * 
     * 
     * @return int
     */
    public function getIntensity()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_INTENSITY, $payload);

        $payload = unpack('v1intensity', $data);

        return $payload['intensity'];
    }

    /**
     * Sets the period in ms with which the BrickletSoundIntensity::CALLBACK_INTENSITY callback is triggered
     * periodically. A value of 0 turns the callback off.
     * 
     * BrickletSoundIntensity::CALLBACK_INTENSITY is only triggered if the intensity has changed since the
     * last triggering.
     * 
     * The default value is 0.
     * 
     * @param int $period
     * 
     * @return void
     */
    public function setIntensityCallbackPeriod($period)
    {
        $payload = '';
        $payload .= pack('V', $period);

        $this->sendRequest(self::FUNCTION_SET_INTENSITY_CALLBACK_PERIOD, $payload);
    }

    /**
     * Returns the period as set by BrickletSoundIntensity::setIntensityCallbackPeriod().
     * 
     * 
     * @return int
     */
    public function getIntensityCallbackPeriod()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_INTENSITY_CALLBACK_PERIOD, $payload);

        $payload = unpack('V1period', $data);

        return IPConnection::fixUnpackedUInt32($payload['period']);
    }

    /**
     * Sets the thresholds for the BrickletSoundIntensity::CALLBACK_INTENSITY_REACHED callback. 
     * 
     * The following options are possible:
     * 
     * <code>
     *  "Option", "Description"
     * 
     *  "'x'",    "Callback is turned off"
     *  "'o'",    "Callback is triggered when the intensity is *outside* the min and max values"
     *  "'i'",    "Callback is triggered when the intensity is *inside* the min and max values"
     *  "'<'",    "Callback is triggered when the intensity is smaller than the min value (max is ignored)"
     *  "'>'",    "Callback is triggered when the intensity is greater than the min value (max is ignored)"
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
    public function setIntensityCallbackThreshold($option, $min, $max)
    {
        $payload = '';
        $payload .= pack('c', ord($option));
        $payload .= pack('v', $min);
        $payload .= pack('v', $max);

        $this->sendRequest(self::FUNCTION_SET_INTENSITY_CALLBACK_THRESHOLD, $payload);
    }

    /**
     * Returns the threshold as set by BrickletSoundIntensity::setIntensityCallbackThreshold().
     * 
     * 
     * @return array
     */
    public function getIntensityCallbackThreshold()
    {
        $result = array();

        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_INTENSITY_CALLBACK_THRESHOLD, $payload);

        $payload = unpack('c1option/v1min/v1max', $data);

        $result['option'] = chr($payload['option']);
        $result['min'] = $payload['min'];
        $result['max'] = $payload['max'];

        return $result;
    }

    /**
     * Sets the period in ms with which the threshold callback
     * 
     * * BrickletSoundIntensity::CALLBACK_INTENSITY_REACHED
     * 
     * is triggered, if the thresholds
     * 
     * * BrickletSoundIntensity::setIntensityCallbackThreshold()
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
     * Returns the debounce period as set by BrickletSoundIntensity::setDebouncePeriod().
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
    public function callbackWrapperIntensity($data)
    {
        $result = array();
        $payload = unpack('v1intensity', $data);

        array_push($result, $payload['intensity']);
        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_INTENSITY]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_INTENSITY], $result);
    }

    /**
     * @internal
     * @param string $data
     */
    public function callbackWrapperIntensityReached($data)
    {
        $result = array();
        $payload = unpack('v1intensity', $data);

        array_push($result, $payload['intensity']);
        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_INTENSITY_REACHED]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_INTENSITY_REACHED], $result);
    }
}

?>
