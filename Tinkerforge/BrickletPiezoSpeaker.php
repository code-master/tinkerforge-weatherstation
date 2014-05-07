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
 * Device for controlling a piezo buzzer with configurable frequencies
 */
class BrickletPiezoSpeaker extends Device
{

    /**
     * This callback is triggered if a beep set by BrickletPiezoSpeaker::beep() is finished
     */
    const CALLBACK_BEEP_FINISHED = 4;

    /**
     * This callback is triggered if the playback of the morse code set by
     * BrickletPiezoSpeaker::morseCode() is finished.
     */
    const CALLBACK_MORSE_CODE_FINISHED = 5;


    /**
     * @internal
     */
    const FUNCTION_BEEP = 1;

    /**
     * @internal
     */
    const FUNCTION_MORSE_CODE = 2;

    /**
     * @internal
     */
    const FUNCTION_CALIBRATE = 3;

    /**
     * @internal
     */
    const FUNCTION_GET_IDENTITY = 255;


    const DEVICE_IDENTIFIER = 242;

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

        $this->responseExpected[self::FUNCTION_BEEP] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_MORSE_CODE] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_CALIBRATE] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::CALLBACK_BEEP_FINISHED] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::CALLBACK_MORSE_CODE_FINISHED] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::FUNCTION_GET_IDENTITY] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;

        $this->callbackWrappers[self::CALLBACK_BEEP_FINISHED] = 'callbackWrapperBeepFinished';
        $this->callbackWrappers[self::CALLBACK_MORSE_CODE_FINISHED] = 'callbackWrapperMorseCodeFinished';
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
     * Beeps with the given frequency for the duration in ms. For example: 
     * If you set a duration of 1000, with a frequency value of 2000
     * the piezo buzzer will beep for one second with a frequency of
     * approximately 2 kHz.
     * 
     * *frequency* can be set between 585 and 7100.
     * 
     * The Piezo Speaker Bricklet can only approximate the frequency, it will play
     * the best possible match by applying the calibration (see BrickletPiezoSpeaker::calibrate()).
     * 
     * @param int $duration
     * @param int $frequency
     * 
     * @return void
     */
    public function beep($duration, $frequency)
    {
        $payload = '';
        $payload .= pack('V', $duration);
        $payload .= pack('v', $frequency);

        $this->sendRequest(self::FUNCTION_BEEP, $payload);
    }

    /**
     * Sets morse code that will be played by the piezo buzzer. The morse code
     * is given as a string consisting of "." (dot), "-" (minus) and " " (space)
     * for *dits*, *dahs* and *pauses*. Every other character is ignored.
     * The second parameter is the frequency (see BrickletPiezoSpeaker::beep()).
     * 
     * For example: If you set the string "...---...", the piezo buzzer will beep
     * nine times with the durations "short short short long long long short 
     * short short".
     * 
     * The maximum string size is 60.
     * 
     * @param string $morse
     * @param int $frequency
     * 
     * @return void
     */
    public function morseCode($morse, $frequency)
    {
        $payload = '';
        for ($i = 0; $i < strlen($morse) && $i < 60; $i++) {
            $payload .= pack('c', ord($morse[$i]));
        }
        for ($i = strlen($morse); $i < 60; $i++) {
            $payload .= pack('c', 0);
        }
        $payload .= pack('v', $frequency);

        $this->sendRequest(self::FUNCTION_MORSE_CODE, $payload);
    }

    /**
     * The Piezo Speaker Bricklet can play 512 different tones. This function
     * plays each tone and measures the exact frequency back. The result is a
     * mapping between setting value and frequency. This mapping is stored
     * in the EEPROM and loaded on startup.
     * 
     * The Bricklet should come calibrated, you only need to call this
     * function (once) every time you reflash the Bricklet plugin.
     * 
     * Returns *true* after the calibration finishes.
     * 
     * 
     * @return bool
     */
    public function calibrate()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_CALIBRATE, $payload);

        $payload = unpack('C1calibration', $data);

        return (bool)$payload['calibration'];
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
    public function callbackWrapperBeepFinished($data)
    {
        $result = array();



        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_BEEP_FINISHED]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_BEEP_FINISHED], $result);
    }

    /**
     * @internal
     * @param string $data
     */
    public function callbackWrapperMorseCodeFinished($data)
    {
        $result = array();



        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_MORSE_CODE_FINISHED]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_MORSE_CODE_FINISHED], $result);
    }
}

?>
