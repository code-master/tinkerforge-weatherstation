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
 * Device for sensing Moisture
 */
class BrickletMoisture extends Device
{

    /**
     * This callback is triggered periodically with the period that is set by
     * BrickletMoisture::setMoistureCallbackPeriod(). The parameter is the moisture value
     * of the sensor.
     * 
     * BrickletMoisture::CALLBACK_MOISTURE is only triggered if the moisture value has changed since the
     * last triggering.
     */
    const CALLBACK_MOISTURE = 8;

    /**
     * This callback is triggered when the threshold as set by
     * BrickletMoisture::setMoistureCallbackThreshold() is reached.
     * The parameter is the moisture value of the sensor.
     * 
     * If the threshold keeps being reached, the callback is triggered periodically
     * with the period as set by BrickletMoisture::setDebouncePeriod().
     */
    const CALLBACK_MOISTURE_REACHED = 9;


    /**
     * @internal
     */
    const FUNCTION_GET_MOISTURE_VALUE = 1;

    /**
     * @internal
     */
    const FUNCTION_SET_MOISTURE_CALLBACK_PERIOD = 2;

    /**
     * @internal
     */
    const FUNCTION_GET_MOISTURE_CALLBACK_PERIOD = 3;

    /**
     * @internal
     */
    const FUNCTION_SET_MOISTURE_CALLBACK_THRESHOLD = 4;

    /**
     * @internal
     */
    const FUNCTION_GET_MOISTURE_CALLBACK_THRESHOLD = 5;

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
    const FUNCTION_SET_MOVING_AVERAGE = 10;

    /**
     * @internal
     */
    const FUNCTION_GET_MOVING_AVERAGE = 11;

    /**
     * @internal
     */
    const FUNCTION_GET_IDENTITY = 255;

    const THRESHOLD_OPTION_OFF = 'x';
    const THRESHOLD_OPTION_OUTSIDE = 'o';
    const THRESHOLD_OPTION_INSIDE = 'i';
    const THRESHOLD_OPTION_SMALLER = '<';
    const THRESHOLD_OPTION_GREATER = '>';

    const DEVICE_IDENTIFIER = 232;

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

        $this->responseExpected[self::FUNCTION_GET_MOISTURE_VALUE] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_MOISTURE_CALLBACK_PERIOD] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_MOISTURE_CALLBACK_PERIOD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_MOISTURE_CALLBACK_THRESHOLD] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_MOISTURE_CALLBACK_THRESHOLD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_DEBOUNCE_PERIOD] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_DEBOUNCE_PERIOD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::CALLBACK_MOISTURE] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::CALLBACK_MOISTURE_REACHED] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::FUNCTION_SET_MOVING_AVERAGE] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_GET_MOVING_AVERAGE] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_GET_IDENTITY] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;

        $this->callbackWrappers[self::CALLBACK_MOISTURE] = 'callbackWrapperMoisture';
        $this->callbackWrappers[self::CALLBACK_MOISTURE_REACHED] = 'callbackWrapperMoistureReached';
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
     * Returns the current moisture value. The value has a range of
     * 0 to 4095. A small value corresponds to little moisture, a big
     * value corresponds to much moisture.
     * 
     * If you want to get the moisture value periodically, it is recommended 
     * to use the callback BrickletMoisture::CALLBACK_MOISTURE and set the period with 
     * BrickletMoisture::setMoistureCallbackPeriod().
     * 
     * 
     * @return int
     */
    public function getMoistureValue()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_MOISTURE_VALUE, $payload);

        $payload = unpack('v1moisture', $data);

        return $payload['moisture'];
    }

    /**
     * Sets the period in ms with which the BrickletMoisture::CALLBACK_MOISTURE callback is triggered
     * periodically. A value of 0 turns the callback off.
     * 
     * BrickletMoisture::CALLBACK_MOISTURE is only triggered if the moisture value has changed since the
     * last triggering.
     * 
     * The default value is 0.
     * 
     * @param int $period
     * 
     * @return void
     */
    public function setMoistureCallbackPeriod($period)
    {
        $payload = '';
        $payload .= pack('V', $period);

        $this->sendRequest(self::FUNCTION_SET_MOISTURE_CALLBACK_PERIOD, $payload);
    }

    /**
     * Returns the period as set by BrickletMoisture::setMoistureCallbackPeriod().
     * 
     * 
     * @return int
     */
    public function getMoistureCallbackPeriod()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_MOISTURE_CALLBACK_PERIOD, $payload);

        $payload = unpack('V1period', $data);

        return IPConnection::fixUnpackedUInt32($payload['period']);
    }

    /**
     * Sets the thresholds for the BrickletMoisture::CALLBACK_MOISTURE_REACHED callback. 
     * 
     * The following options are possible:
     * 
     * <code>
     *  "Option", "Description"
     * 
     *  "'x'",    "Callback is turned off"
     *  "'o'",    "Callback is triggered when the moisture value is *outside* the min and max values"
     *  "'i'",    "Callback is triggered when the moisture value is *inside* the min and max values"
     *  "'<'",    "Callback is triggered when the moisture value is smaller than the min value (max is ignored)"
     *  "'>'",    "Callback is triggered when the moisture value is greater than the min value (max is ignored)"
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
    public function setMoistureCallbackThreshold($option, $min, $max)
    {
        $payload = '';
        $payload .= pack('c', ord($option));
        $payload .= pack('v', $min);
        $payload .= pack('v', $max);

        $this->sendRequest(self::FUNCTION_SET_MOISTURE_CALLBACK_THRESHOLD, $payload);
    }

    /**
     * Returns the threshold as set by BrickletMoisture::setMoistureCallbackThreshold().
     * 
     * 
     * @return array
     */
    public function getMoistureCallbackThreshold()
    {
        $result = array();

        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_MOISTURE_CALLBACK_THRESHOLD, $payload);

        $payload = unpack('c1option/v1min/v1max', $data);

        $result['option'] = chr($payload['option']);
        $result['min'] = $payload['min'];
        $result['max'] = $payload['max'];

        return $result;
    }

    /**
     * Sets the period in ms with which the threshold callback
     * 
     * * BrickletMoisture::CALLBACK_MOISTURE_REACHED
     * 
     * is triggered, if the threshold
     * 
     * * BrickletMoisture::setMoistureCallbackThreshold()
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
     * Returns the debounce period as set by BrickletMoisture::setDebouncePeriod().
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
     * Sets the length of a `moving averaging <http://en.wikipedia.org/wiki/Moving_average>`__ 
     * for the moisture value.
     * 
     * Setting the length to 0 will turn the averaging completely off. With less
     * averaging, there is more noise on the data.
     * 
     * The range for the averaging is 0-100.
     * 
     * The default value is 100.
     * 
     * @param int $average
     * 
     * @return void
     */
    public function setMovingAverage($average)
    {
        $payload = '';
        $payload .= pack('C', $average);

        $this->sendRequest(self::FUNCTION_SET_MOVING_AVERAGE, $payload);
    }

    /**
     * Returns the length moving average as set by BrickletMoisture::setMovingAverage().
     * 
     * 
     * @return int
     */
    public function getMovingAverage()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_MOVING_AVERAGE, $payload);

        $payload = unpack('C1average', $data);

        return $payload['average'];
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
    public function callbackWrapperMoisture($data)
    {
        $result = array();
        $payload = unpack('v1moisture', $data);

        array_push($result, $payload['moisture']);
        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_MOISTURE]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_MOISTURE], $result);
    }

    /**
     * @internal
     * @param string $data
     */
    public function callbackWrapperMoistureReached($data)
    {
        $result = array();
        $payload = unpack('v1moisture', $data);

        array_push($result, $payload['moisture']);
        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_MOISTURE_REACHED]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_MOISTURE_REACHED], $result);
    }
}

?>
