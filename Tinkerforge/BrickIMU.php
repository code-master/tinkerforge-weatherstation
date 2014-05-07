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
 * Device for sensing acceleration, magnetic field and angular velocity
 */
class BrickIMU extends Device
{

    /**
     * This callback is triggered periodically with the period that is set by
     * BrickIMU::setAccelerationPeriod(). The parameters are the acceleration
     * for the x, y and z axis.
     */
    const CALLBACK_ACCELERATION = 31;

    /**
     * This callback is triggered periodically with the period that is set by
     * BrickIMU::setMagneticFieldPeriod(). The parameters are the magnetic field
     * for the x, y and z axis.
     */
    const CALLBACK_MAGNETIC_FIELD = 32;

    /**
     * This callback is triggered periodically with the period that is set by
     * BrickIMU::setAngularVelocityPeriod(). The parameters are the angular velocity
     * for the x, y and z axis.
     */
    const CALLBACK_ANGULAR_VELOCITY = 33;

    /**
     * This callback is triggered periodically with the period that is set by
     * BrickIMU::setAllDataPeriod(). The parameters are the acceleration,
     * the magnetic field and the angular velocity for the x, y and z axis as
     * well as the temperature of the IMU Brick.
     */
    const CALLBACK_ALL_DATA = 34;

    /**
     * This callback is triggered periodically with the period that is set by
     * BrickIMU::setOrientationPeriod(). The parameters are the orientation
     * (roll, pitch and yaw) of the IMU Brick in Euler angles. See
     * BrickIMU::getOrientation() for details.
     */
    const CALLBACK_ORIENTATION = 35;

    /**
     * This callback is triggered periodically with the period that is set by
     * BrickIMU::setQuaternionPeriod(). The parameters are the orientation
     * (x, y, z, w) of the IMU Brick in quaternions. See BrickIMU::getQuaternion()
     * for details.
     */
    const CALLBACK_QUATERNION = 36;


    /**
     * @internal
     */
    const FUNCTION_GET_ACCELERATION = 1;

    /**
     * @internal
     */
    const FUNCTION_GET_MAGNETIC_FIELD = 2;

    /**
     * @internal
     */
    const FUNCTION_GET_ANGULAR_VELOCITY = 3;

    /**
     * @internal
     */
    const FUNCTION_GET_ALL_DATA = 4;

    /**
     * @internal
     */
    const FUNCTION_GET_ORIENTATION = 5;

    /**
     * @internal
     */
    const FUNCTION_GET_QUATERNION = 6;

    /**
     * @internal
     */
    const FUNCTION_GET_IMU_TEMPERATURE = 7;

    /**
     * @internal
     */
    const FUNCTION_LEDS_ON = 8;

    /**
     * @internal
     */
    const FUNCTION_LEDS_OFF = 9;

    /**
     * @internal
     */
    const FUNCTION_ARE_LEDS_ON = 10;

    /**
     * @internal
     */
    const FUNCTION_SET_ACCELERATION_RANGE = 11;

    /**
     * @internal
     */
    const FUNCTION_GET_ACCELERATION_RANGE = 12;

    /**
     * @internal
     */
    const FUNCTION_SET_MAGNETOMETER_RANGE = 13;

    /**
     * @internal
     */
    const FUNCTION_GET_MAGNETOMETER_RANGE = 14;

    /**
     * @internal
     */
    const FUNCTION_SET_CONVERGENCE_SPEED = 15;

    /**
     * @internal
     */
    const FUNCTION_GET_CONVERGENCE_SPEED = 16;

    /**
     * @internal
     */
    const FUNCTION_SET_CALIBRATION = 17;

    /**
     * @internal
     */
    const FUNCTION_GET_CALIBRATION = 18;

    /**
     * @internal
     */
    const FUNCTION_SET_ACCELERATION_PERIOD = 19;

    /**
     * @internal
     */
    const FUNCTION_GET_ACCELERATION_PERIOD = 20;

    /**
     * @internal
     */
    const FUNCTION_SET_MAGNETIC_FIELD_PERIOD = 21;

    /**
     * @internal
     */
    const FUNCTION_GET_MAGNETIC_FIELD_PERIOD = 22;

    /**
     * @internal
     */
    const FUNCTION_SET_ANGULAR_VELOCITY_PERIOD = 23;

    /**
     * @internal
     */
    const FUNCTION_GET_ANGULAR_VELOCITY_PERIOD = 24;

    /**
     * @internal
     */
    const FUNCTION_SET_ALL_DATA_PERIOD = 25;

    /**
     * @internal
     */
    const FUNCTION_GET_ALL_DATA_PERIOD = 26;

    /**
     * @internal
     */
    const FUNCTION_SET_ORIENTATION_PERIOD = 27;

    /**
     * @internal
     */
    const FUNCTION_GET_ORIENTATION_PERIOD = 28;

    /**
     * @internal
     */
    const FUNCTION_SET_QUATERNION_PERIOD = 29;

    /**
     * @internal
     */
    const FUNCTION_GET_QUATERNION_PERIOD = 30;

    /**
     * @internal
     */
    const FUNCTION_ORIENTATION_CALCULATION_ON = 37;

    /**
     * @internal
     */
    const FUNCTION_ORIENTATION_CALCULATION_OFF = 38;

    /**
     * @internal
     */
    const FUNCTION_IS_ORIENTATION_CALCULATION_ON = 39;

    /**
     * @internal
     */
    const FUNCTION_GET_PROTOCOL1_BRICKLET_NAME = 241;

    /**
     * @internal
     */
    const FUNCTION_GET_CHIP_TEMPERATURE = 242;

    /**
     * @internal
     */
    const FUNCTION_RESET = 243;

    /**
     * @internal
     */
    const FUNCTION_GET_IDENTITY = 255;

    const CALIBRATION_TYPE_ACCELEROMETER_GAIN = 0;
    const CALIBRATION_TYPE_ACCELEROMETER_BIAS = 1;
    const CALIBRATION_TYPE_MAGNETOMETER_GAIN = 2;
    const CALIBRATION_TYPE_MAGNETOMETER_BIAS = 3;
    const CALIBRATION_TYPE_GYROSCOPE_GAIN = 4;
    const CALIBRATION_TYPE_GYROSCOPE_BIAS = 5;

    const DEVICE_IDENTIFIER = 16;

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

        $this->responseExpected[self::FUNCTION_GET_ACCELERATION] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_GET_MAGNETIC_FIELD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_GET_ANGULAR_VELOCITY] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_GET_ALL_DATA] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_GET_ORIENTATION] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_GET_QUATERNION] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_GET_IMU_TEMPERATURE] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_LEDS_ON] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_LEDS_OFF] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_ARE_LEDS_ON] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_ACCELERATION_RANGE] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_GET_ACCELERATION_RANGE] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_MAGNETOMETER_RANGE] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_GET_MAGNETOMETER_RANGE] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_CONVERGENCE_SPEED] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_GET_CONVERGENCE_SPEED] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_CALIBRATION] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_GET_CALIBRATION] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_ACCELERATION_PERIOD] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_ACCELERATION_PERIOD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_MAGNETIC_FIELD_PERIOD] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_MAGNETIC_FIELD_PERIOD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_ANGULAR_VELOCITY_PERIOD] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_ANGULAR_VELOCITY_PERIOD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_ALL_DATA_PERIOD] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_ALL_DATA_PERIOD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_ORIENTATION_PERIOD] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_ORIENTATION_PERIOD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_SET_QUATERNION_PERIOD] = self::RESPONSE_EXPECTED_TRUE;
        $this->responseExpected[self::FUNCTION_GET_QUATERNION_PERIOD] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::CALLBACK_ACCELERATION] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::CALLBACK_MAGNETIC_FIELD] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::CALLBACK_ANGULAR_VELOCITY] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::CALLBACK_ALL_DATA] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::CALLBACK_ORIENTATION] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::CALLBACK_QUATERNION] = self::RESPONSE_EXPECTED_ALWAYS_FALSE;
        $this->responseExpected[self::FUNCTION_ORIENTATION_CALCULATION_ON] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_ORIENTATION_CALCULATION_OFF] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_IS_ORIENTATION_CALCULATION_ON] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_GET_PROTOCOL1_BRICKLET_NAME] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_GET_CHIP_TEMPERATURE] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;
        $this->responseExpected[self::FUNCTION_RESET] = self::RESPONSE_EXPECTED_FALSE;
        $this->responseExpected[self::FUNCTION_GET_IDENTITY] = self::RESPONSE_EXPECTED_ALWAYS_TRUE;

        $this->callbackWrappers[self::CALLBACK_ACCELERATION] = 'callbackWrapperAcceleration';
        $this->callbackWrappers[self::CALLBACK_MAGNETIC_FIELD] = 'callbackWrapperMagneticField';
        $this->callbackWrappers[self::CALLBACK_ANGULAR_VELOCITY] = 'callbackWrapperAngularVelocity';
        $this->callbackWrappers[self::CALLBACK_ALL_DATA] = 'callbackWrapperAllData';
        $this->callbackWrappers[self::CALLBACK_ORIENTATION] = 'callbackWrapperOrientation';
        $this->callbackWrappers[self::CALLBACK_QUATERNION] = 'callbackWrapperQuaternion';
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
     * Returns the calibrated acceleration from the accelerometer for the 
     * x, y and z axis in mG (G/1000, 1G = 9.80605m/s²).
     * 
     * If you want to get the acceleration periodically, it is recommended 
     * to use the callback BrickIMU::CALLBACK_ACCELERATION and set the period with 
     * BrickIMU::setAccelerationPeriod().
     * 
     * 
     * @return array
     */
    public function getAcceleration()
    {
        $result = array();

        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_ACCELERATION, $payload);

        $payload = unpack('v1x/v1y/v1z', $data);

        $result['x'] = IPConnection::fixUnpackedInt16($payload['x']);
        $result['y'] = IPConnection::fixUnpackedInt16($payload['y']);
        $result['z'] = IPConnection::fixUnpackedInt16($payload['z']);

        return $result;
    }

    /**
     * Returns the calibrated magnetic field from the magnetometer for the 
     * x, y and z axis in mG (Milligauss or Nanotesla).
     * 
     * If you want to get the magnetic field periodically, it is recommended 
     * to use the callback BrickIMU::CALLBACK_MAGNETIC_FIELD and set the period with 
     * BrickIMU::setMagneticFieldPeriod().
     * 
     * 
     * @return array
     */
    public function getMagneticField()
    {
        $result = array();

        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_MAGNETIC_FIELD, $payload);

        $payload = unpack('v1x/v1y/v1z', $data);

        $result['x'] = IPConnection::fixUnpackedInt16($payload['x']);
        $result['y'] = IPConnection::fixUnpackedInt16($payload['y']);
        $result['z'] = IPConnection::fixUnpackedInt16($payload['z']);

        return $result;
    }

    /**
     * Returns the calibrated angular velocity from the gyroscope for the 
     * x, y and z axis in °/14.375s (you have to divide by 14.375 to
     * get the value in °/s).
     * 
     * If you want to get the angular velocity periodically, it is recommended 
     * to use the callback BrickIMU::CALLBACK_ANGULAR_VELOCITY and set the period with 
     * BrickIMU::setAngularVelocityPeriod().
     * 
     * 
     * @return array
     */
    public function getAngularVelocity()
    {
        $result = array();

        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_ANGULAR_VELOCITY, $payload);

        $payload = unpack('v1x/v1y/v1z', $data);

        $result['x'] = IPConnection::fixUnpackedInt16($payload['x']);
        $result['y'] = IPConnection::fixUnpackedInt16($payload['y']);
        $result['z'] = IPConnection::fixUnpackedInt16($payload['z']);

        return $result;
    }

    /**
     * Returns the data from BrickIMU::getAcceleration(), BrickIMU::getMagneticField() 
     * and BrickIMU::getAngularVelocity() as well as the temperature of the IMU Brick.
     * 
     * The temperature is given in °C/100.
     * 
     * If you want to get the data periodically, it is recommended 
     * to use the callback BrickIMU::CALLBACK_ALL_DATA and set the period with 
     * BrickIMU::setAllDataPeriod().
     * 
     * 
     * @return array
     */
    public function getAllData()
    {
        $result = array();

        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_ALL_DATA, $payload);

        $payload = unpack('v1acc_x/v1acc_y/v1acc_z/v1mag_x/v1mag_y/v1mag_z/v1ang_x/v1ang_y/v1ang_z/v1temperature', $data);

        $result['acc_x'] = IPConnection::fixUnpackedInt16($payload['acc_x']);
        $result['acc_y'] = IPConnection::fixUnpackedInt16($payload['acc_y']);
        $result['acc_z'] = IPConnection::fixUnpackedInt16($payload['acc_z']);
        $result['mag_x'] = IPConnection::fixUnpackedInt16($payload['mag_x']);
        $result['mag_y'] = IPConnection::fixUnpackedInt16($payload['mag_y']);
        $result['mag_z'] = IPConnection::fixUnpackedInt16($payload['mag_z']);
        $result['ang_x'] = IPConnection::fixUnpackedInt16($payload['ang_x']);
        $result['ang_y'] = IPConnection::fixUnpackedInt16($payload['ang_y']);
        $result['ang_z'] = IPConnection::fixUnpackedInt16($payload['ang_z']);
        $result['temperature'] = IPConnection::fixUnpackedInt16($payload['temperature']);

        return $result;
    }

    /**
     * Returns the current orientation (roll, pitch, yaw) of the IMU Brick as Euler
     * angles in one-hundredth degree. Note that Euler angles always experience a
     * `gimbal lock <http://en.wikipedia.org/wiki/Gimbal_lock>`__.
     * 
     * We recommend that you use quaternions instead.
     * 
     * The order to sequence in which the orientation values should be applied is 
     * roll, yaw, pitch. 
     * 
     * If you want to get the orientation periodically, it is recommended 
     * to use the callback BrickIMU::CALLBACK_ORIENTATION and set the period with 
     * BrickIMU::setOrientationPeriod().
     * 
     * 
     * @return array
     */
    public function getOrientation()
    {
        $result = array();

        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_ORIENTATION, $payload);

        $payload = unpack('v1roll/v1pitch/v1yaw', $data);

        $result['roll'] = IPConnection::fixUnpackedInt16($payload['roll']);
        $result['pitch'] = IPConnection::fixUnpackedInt16($payload['pitch']);
        $result['yaw'] = IPConnection::fixUnpackedInt16($payload['yaw']);

        return $result;
    }

    /**
     * Returns the current orientation (x, y, z, w) of the IMU as 
     * `quaternions <http://en.wikipedia.org/wiki/Quaternions_and_spatial_rotation>`__.
     * 
     * You can go from quaternions to Euler angles with the following formula::
     * 
     *  xAngle = atan2(2*y*w - 2*x*z, 1 - 2*y*y - 2*z*z)
     *  yAngle = atan2(2*x*w - 2*y*z, 1 - 2*x*x - 2*z*z)
     *  zAngle =  asin(2*x*y + 2*z*w)
     * 
     * This process is not reversible, because of the 
     * `gimbal lock <http://en.wikipedia.org/wiki/Gimbal_lock>`__.
     * 
     * It is also possible to calculate independent angles. You can calculate 
     * yaw, pitch and roll in a right-handed vehicle coordinate system according to DIN70000
     * with::
     * 
     *  yaw   =  atan2(2*x*y + 2*w*z, w*w + x*x - y*y - z*z)
     *  pitch = -asin(2*w*y - 2*x*z)
     *  roll  = -atan2(2*y*z + 2*w*x, -w*w + x*x + y*y - z*z))
     * 
     * Converting the quaternions to an OpenGL transformation matrix is
     * possible with the following formula::
     * 
     *  matrix = [[1 - 2*(y*y + z*z),     2*(x*y - w*z),     2*(x*z + w*y), 0],
     *            [    2*(x*y + w*z), 1 - 2*(x*x + z*z),     2*(y*z - w*x), 0],
     *            [    2*(x*z - w*y),     2*(y*z + w*x), 1 - 2*(x*x + y*y), 0],
     *            [                0,                 0,                 0, 1]]
     * 
     * If you want to get the quaternions periodically, it is recommended 
     * to use the callback BrickIMU::CALLBACK_QUATERNION and set the period with 
     * BrickIMU::setQuaternionPeriod().
     * 
     * 
     * @return array
     */
    public function getQuaternion()
    {
        $result = array();

        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_QUATERNION, $payload);

        $payload = unpack('f1x/f1y/f1z/f1w', $data);

        $result['x'] = $payload['x'];
        $result['y'] = $payload['y'];
        $result['z'] = $payload['z'];
        $result['w'] = $payload['w'];

        return $result;
    }

    /**
     * Returns the temperature of the IMU Brick. The temperature is given in 
     * °C/100.
     * 
     * 
     * @return int
     */
    public function getIMUTemperature()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_IMU_TEMPERATURE, $payload);

        $payload = unpack('v1temperature', $data);

        return IPConnection::fixUnpackedInt16($payload['temperature']);
    }

    /**
     * Turns the orientation and direction LEDs of the IMU Brick on.
     * 
     * 
     * @return void
     */
    public function ledsOn()
    {
        $payload = '';

        $this->sendRequest(self::FUNCTION_LEDS_ON, $payload);
    }

    /**
     * Turns the orientation and direction LEDs of the IMU Brick off.
     * 
     * 
     * @return void
     */
    public function ledsOff()
    {
        $payload = '';

        $this->sendRequest(self::FUNCTION_LEDS_OFF, $payload);
    }

    /**
     * Returns *true* if the orientation and direction LEDs of the IMU Brick
     * are on, *false* otherwise.
     * 
     * 
     * @return bool
     */
    public function areLedsOn()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_ARE_LEDS_ON, $payload);

        $payload = unpack('C1leds', $data);

        return (bool)$payload['leds'];
    }

    /**
     * Not implemented yet.
     * 
     * @param int $range
     * 
     * @return void
     */
    public function setAccelerationRange($range)
    {
        $payload = '';
        $payload .= pack('C', $range);

        $this->sendRequest(self::FUNCTION_SET_ACCELERATION_RANGE, $payload);
    }

    /**
     * Not implemented yet.
     * 
     * 
     * @return int
     */
    public function getAccelerationRange()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_ACCELERATION_RANGE, $payload);

        $payload = unpack('C1range', $data);

        return $payload['range'];
    }

    /**
     * Not implemented yet.
     * 
     * @param int $range
     * 
     * @return void
     */
    public function setMagnetometerRange($range)
    {
        $payload = '';
        $payload .= pack('C', $range);

        $this->sendRequest(self::FUNCTION_SET_MAGNETOMETER_RANGE, $payload);
    }

    /**
     * Not implemented yet.
     * 
     * 
     * @return int
     */
    public function getMagnetometerRange()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_MAGNETOMETER_RANGE, $payload);

        $payload = unpack('C1range', $data);

        return $payload['range'];
    }

    /**
     * Sets the convergence speed of the IMU Brick in °/s. The convergence speed 
     * determines how the different sensor measurements are fused.
     * 
     * If the orientation of the IMU Brick is off by 10° and the convergence speed is 
     * set to 20°/s, it will take 0.5s until the orientation is corrected. However,
     * if the correct orientation is reached and the convergence speed is too high,
     * the orientation will fluctuate with the fluctuations of the accelerometer and
     * the magnetometer.
     * 
     * If you set the convergence speed to 0, practically only the gyroscope is used
     * to calculate the orientation. This gives very smooth movements, but errors of the
     * gyroscope will not be corrected. If you set the convergence speed to something
     * above 500, practically only the magnetometer and the accelerometer are used to
     * calculate the orientation. In this case the movements are abrupt and the values
     * will fluctuate, but there won't be any errors that accumulate over time.
     * 
     * In an application with high angular velocities, we recommend a high convergence
     * speed, so the errors of the gyroscope can be corrected fast. In applications with
     * only slow movements we recommend a low convergence speed. You can change the
     * convergence speed on the fly. So it is possible (and recommended) to increase 
     * the convergence speed before an abrupt movement and decrease it afterwards 
     * again.
     * 
     * You might want to play around with the convergence speed in the Brick Viewer to
     * get a feeling for a good value for your application.
     * 
     * The default value is 30.
     * 
     * @param int $speed
     * 
     * @return void
     */
    public function setConvergenceSpeed($speed)
    {
        $payload = '';
        $payload .= pack('v', $speed);

        $this->sendRequest(self::FUNCTION_SET_CONVERGENCE_SPEED, $payload);
    }

    /**
     * Returns the convergence speed as set by BrickIMU::setConvergenceSpeed().
     * 
     * 
     * @return int
     */
    public function getConvergenceSpeed()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_CONVERGENCE_SPEED, $payload);

        $payload = unpack('v1speed', $data);

        return $payload['speed'];
    }

    /**
     * There are several different types that can be calibrated:
     * 
     * <code>
     *  "Type", "Description", "Values"
     * 
     *  "0",    "Accelerometer Gain", "``[mul x, mul y, mul z, div x, div y, div z, 0, 0, 0, 0]``"
     *  "1",    "Accelerometer Bias", "``[bias x, bias y, bias z, 0, 0, 0, 0, 0, 0, 0]``"
     *  "2",    "Magnetometer Gain",  "``[mul x, mul y, mul z, div x, div y, div z, 0, 0, 0, 0]``"
     *  "3",    "Magnetometer Bias",  "``[bias x, bias y, bias z, 0, 0, 0, 0, 0, 0, 0]``"
     *  "4",    "Gyroscope Gain",     "``[mul x, mul y, mul z, div x, div y, div z, 0, 0, 0, 0]``"
     *  "5",    "Gyroscope Bias",     "``[bias xl, bias yl, bias zl, temp l, bias xh, bias yh, bias zh, temp h, 0, 0]``"
     * </code>
     * 
     * The calibration via gain and bias is done with the following formula::
     * 
     *  new_value = (bias + orig_value) * gain_mul / gain_div
     * 
     * If you really want to write your own calibration software, please keep
     * in mind that you first have to undo the old calibration (set bias to 0 and
     * gain to 1/1) and that you have to average over several thousand values
     * to obtain a usable result in the end.
     * 
     * The gyroscope bias is highly dependent on the temperature, so you have to
     * calibrate the bias two times with different temperatures. The values ``xl``,
     * ``yl``, ``zl`` and ``temp l`` are the bias for ``x``, ``y``, ``z`` and the
     * corresponding temperature for a low temperature. The values ``xh``, ``yh``,
     * ``zh`` and ``temp h`` are the same for a high temperatures. The temperature
     * difference should be at least 5°C. If you have a temperature where the
     * IMU Brick is mostly used, you should use this temperature for one of the
     * sampling points.
     * 
     * <note>
     *  We highly recommend that you use the Brick Viewer to calibrate your
     *  IMU Brick.
     * </note>
     * 
     * @param int $typ
     * @param int[] $data
     * 
     * @return void
     */
    public function setCalibration($typ, $data)
    {
        $payload = '';
        $payload .= pack('C', $typ);
        for ($i = 0; $i < 10; $i++) {
            $payload .= pack('v', $data[$i]);
        }

        $this->sendRequest(self::FUNCTION_SET_CALIBRATION, $payload);
    }

    /**
     * Returns the calibration for a given type as set by BrickIMU::setCalibration().
     * 
     * @param int $typ
     * 
     * @return array
     */
    public function getCalibration($typ)
    {
        $payload = '';
        $payload .= pack('C', $typ);

        $data = $this->sendRequest(self::FUNCTION_GET_CALIBRATION, $payload);

        $payload = unpack('v10data', $data);

        return IPConnection::collectUnpackedInt16Array($payload, 'data', 10);
    }

    /**
     * Sets the period in ms with which the BrickIMU::CALLBACK_ACCELERATION callback is triggered
     * periodically. A value of 0 turns the callback off.
     * 
     * The default value is 0.
     * 
     * @param int $period
     * 
     * @return void
     */
    public function setAccelerationPeriod($period)
    {
        $payload = '';
        $payload .= pack('V', $period);

        $this->sendRequest(self::FUNCTION_SET_ACCELERATION_PERIOD, $payload);
    }

    /**
     * Returns the period as set by BrickIMU::setAccelerationPeriod().
     * 
     * 
     * @return int
     */
    public function getAccelerationPeriod()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_ACCELERATION_PERIOD, $payload);

        $payload = unpack('V1period', $data);

        return IPConnection::fixUnpackedUInt32($payload['period']);
    }

    /**
     * Sets the period in ms with which the BrickIMU::CALLBACK_MAGNETIC_FIELD callback is triggered
     * periodically. A value of 0 turns the callback off.
     * 
     * @param int $period
     * 
     * @return void
     */
    public function setMagneticFieldPeriod($period)
    {
        $payload = '';
        $payload .= pack('V', $period);

        $this->sendRequest(self::FUNCTION_SET_MAGNETIC_FIELD_PERIOD, $payload);
    }

    /**
     * Returns the period as set by BrickIMU::setMagneticFieldPeriod().
     * 
     * 
     * @return int
     */
    public function getMagneticFieldPeriod()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_MAGNETIC_FIELD_PERIOD, $payload);

        $payload = unpack('V1period', $data);

        return IPConnection::fixUnpackedUInt32($payload['period']);
    }

    /**
     * Sets the period in ms with which the BrickIMU::CALLBACK_ANGULAR_VELOCITY callback is triggered
     * periodically. A value of 0 turns the callback off.
     * 
     * @param int $period
     * 
     * @return void
     */
    public function setAngularVelocityPeriod($period)
    {
        $payload = '';
        $payload .= pack('V', $period);

        $this->sendRequest(self::FUNCTION_SET_ANGULAR_VELOCITY_PERIOD, $payload);
    }

    /**
     * Returns the period as set by BrickIMU::setAngularVelocityPeriod().
     * 
     * 
     * @return int
     */
    public function getAngularVelocityPeriod()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_ANGULAR_VELOCITY_PERIOD, $payload);

        $payload = unpack('V1period', $data);

        return IPConnection::fixUnpackedUInt32($payload['period']);
    }

    /**
     * Sets the period in ms with which the BrickIMU::CALLBACK_ALL_DATA callback is triggered
     * periodically. A value of 0 turns the callback off.
     * 
     * @param int $period
     * 
     * @return void
     */
    public function setAllDataPeriod($period)
    {
        $payload = '';
        $payload .= pack('V', $period);

        $this->sendRequest(self::FUNCTION_SET_ALL_DATA_PERIOD, $payload);
    }

    /**
     * Returns the period as set by BrickIMU::setAllDataPeriod().
     * 
     * 
     * @return int
     */
    public function getAllDataPeriod()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_ALL_DATA_PERIOD, $payload);

        $payload = unpack('V1period', $data);

        return IPConnection::fixUnpackedUInt32($payload['period']);
    }

    /**
     * Sets the period in ms with which the BrickIMU::CALLBACK_ORIENTATION callback is triggered
     * periodically. A value of 0 turns the callback off.
     * 
     * @param int $period
     * 
     * @return void
     */
    public function setOrientationPeriod($period)
    {
        $payload = '';
        $payload .= pack('V', $period);

        $this->sendRequest(self::FUNCTION_SET_ORIENTATION_PERIOD, $payload);
    }

    /**
     * Returns the period as set by BrickIMU::setOrientationPeriod().
     * 
     * 
     * @return int
     */
    public function getOrientationPeriod()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_ORIENTATION_PERIOD, $payload);

        $payload = unpack('V1period', $data);

        return IPConnection::fixUnpackedUInt32($payload['period']);
    }

    /**
     * Sets the period in ms with which the BrickIMU::CALLBACK_QUATERNION callback is triggered
     * periodically. A value of 0 turns the callback off.
     * 
     * @param int $period
     * 
     * @return void
     */
    public function setQuaternionPeriod($period)
    {
        $payload = '';
        $payload .= pack('V', $period);

        $this->sendRequest(self::FUNCTION_SET_QUATERNION_PERIOD, $payload);
    }

    /**
     * Returns the period as set by BrickIMU::setQuaternionPeriod().
     * 
     * 
     * @return int
     */
    public function getQuaternionPeriod()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_QUATERNION_PERIOD, $payload);

        $payload = unpack('V1period', $data);

        return IPConnection::fixUnpackedUInt32($payload['period']);
    }

    /**
     * Turns the orientation calculation of the IMU Brick on.
     * 
     * As default the calculation is on.
     * 
     * .. versionadded:: 2.0.2~(Firmware)
     * 
     * 
     * @return void
     */
    public function orientationCalculationOn()
    {
        $payload = '';

        $this->sendRequest(self::FUNCTION_ORIENTATION_CALCULATION_ON, $payload);
    }

    /**
     * Turns the orientation calculation of the IMU Brick off.
     * 
     * If the calculation is off, BrickIMU::getOrientation() will return
     * the last calculated value until the calculation is turned on again.
     * 
     * The trigonometric functions that are needed to calculate the orientation 
     * are very expensive. We recommend to turn the orientation calculation
     * off if the orientation is not needed, to free calculation time for the
     * sensor fusion algorithm.
     * 
     * As default the calculation is on.
     * 
     * .. versionadded:: 2.0.2~(Firmware)
     * 
     * 
     * @return void
     */
    public function orientationCalculationOff()
    {
        $payload = '';

        $this->sendRequest(self::FUNCTION_ORIENTATION_CALCULATION_OFF, $payload);
    }

    /**
     * Returns *true* if the orientation calculation of the IMU Brick
     * is on, *false* otherwise.
     * 
     * .. versionadded:: 2.0.2~(Firmware)
     * 
     * 
     * @return bool
     */
    public function isOrientationCalculationOn()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_IS_ORIENTATION_CALCULATION_ON, $payload);

        $payload = unpack('C1orientation_calculation_on', $data);

        return (bool)$payload['orientation_calculation_on'];
    }

    /**
     * Returns the firmware and protocol version and the name of the Bricklet for a
     * given port.
     * 
     * This functions sole purpose is to allow automatic flashing of v1.x.y Bricklet
     * plugins.
     * 
     * @param string $port
     * 
     * @return array
     */
    public function getProtocol1BrickletName($port)
    {
        $result = array();

        $payload = '';
        $payload .= pack('c', ord($port));

        $data = $this->sendRequest(self::FUNCTION_GET_PROTOCOL1_BRICKLET_NAME, $payload);

        $payload = unpack('C1protocol_version/C3firmware_version/c40name', $data);

        $result['protocol_version'] = $payload['protocol_version'];
        $result['firmware_version'] = IPConnection::collectUnpackedArray($payload, 'firmware_version', 3);
        $result['name'] = IPConnection::implodeUnpackedString($payload, 'name', 40);

        return $result;
    }

    /**
     * Returns the temperature in °C/10 as measured inside the microcontroller. The
     * value returned is not the ambient temperature!
     * 
     * The temperature is only proportional to the real temperature and it has an
     * accuracy of +-15%. Practically it is only useful as an indicator for
     * temperature changes.
     * 
     * 
     * @return int
     */
    public function getChipTemperature()
    {
        $payload = '';

        $data = $this->sendRequest(self::FUNCTION_GET_CHIP_TEMPERATURE, $payload);

        $payload = unpack('v1temperature', $data);

        return IPConnection::fixUnpackedInt16($payload['temperature']);
    }

    /**
     * Calling this function will reset the Brick. Calling this function
     * on a Brick inside of a stack will reset the whole stack.
     * 
     * After a reset you have to create new device objects,
     * calling functions on the existing ones will result in
     * undefined behavior!
     * 
     * 
     * @return void
     */
    public function reset()
    {
        $payload = '';

        $this->sendRequest(self::FUNCTION_RESET, $payload);
    }

    /**
     * Returns the UID, the UID where the Brick is connected to, 
     * the position, the hardware and firmware version as well as the
     * device identifier.
     * 
     * The position can be '0'-'8' (stack position).
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
    public function callbackWrapperAcceleration($data)
    {
        $result = array();
        $payload = unpack('v1x/v1y/v1z', $data);

        array_push($result, IPConnection::fixUnpackedInt16($payload['x']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['y']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['z']));
        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_ACCELERATION]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_ACCELERATION], $result);
    }

    /**
     * @internal
     * @param string $data
     */
    public function callbackWrapperMagneticField($data)
    {
        $result = array();
        $payload = unpack('v1x/v1y/v1z', $data);

        array_push($result, IPConnection::fixUnpackedInt16($payload['x']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['y']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['z']));
        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_MAGNETIC_FIELD]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_MAGNETIC_FIELD], $result);
    }

    /**
     * @internal
     * @param string $data
     */
    public function callbackWrapperAngularVelocity($data)
    {
        $result = array();
        $payload = unpack('v1x/v1y/v1z', $data);

        array_push($result, IPConnection::fixUnpackedInt16($payload['x']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['y']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['z']));
        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_ANGULAR_VELOCITY]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_ANGULAR_VELOCITY], $result);
    }

    /**
     * @internal
     * @param string $data
     */
    public function callbackWrapperAllData($data)
    {
        $result = array();
        $payload = unpack('v1acc_x/v1acc_y/v1acc_z/v1mag_x/v1mag_y/v1mag_z/v1ang_x/v1ang_y/v1ang_z/v1temperature', $data);

        array_push($result, IPConnection::fixUnpackedInt16($payload['acc_x']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['acc_y']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['acc_z']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['mag_x']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['mag_y']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['mag_z']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['ang_x']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['ang_y']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['ang_z']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['temperature']));
        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_ALL_DATA]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_ALL_DATA], $result);
    }

    /**
     * @internal
     * @param string $data
     */
    public function callbackWrapperOrientation($data)
    {
        $result = array();
        $payload = unpack('v1roll/v1pitch/v1yaw', $data);

        array_push($result, IPConnection::fixUnpackedInt16($payload['roll']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['pitch']));
        array_push($result, IPConnection::fixUnpackedInt16($payload['yaw']));
        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_ORIENTATION]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_ORIENTATION], $result);
    }

    /**
     * @internal
     * @param string $data
     */
    public function callbackWrapperQuaternion($data)
    {
        $result = array();
        $payload = unpack('f1x/f1y/f1z/f1w', $data);

        array_push($result, $payload['x']);
        array_push($result, $payload['y']);
        array_push($result, $payload['z']);
        array_push($result, $payload['w']);
        array_push($result, $this->registeredCallbackUserData[self::CALLBACK_QUATERNION]);

        call_user_func_array($this->registeredCallbacks[self::CALLBACK_QUATERNION], $result);
    }
}

?>
