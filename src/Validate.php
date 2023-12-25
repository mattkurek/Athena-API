<?php

namespace MattKurek\AthenaAPI;

class Validate
{

    /** 
     *      Function used to determine if an object is an array.
     *      Returns true if object is array.
     *      Returns false if object is not an array.
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isArray($array)
    {

        try {

            // check if array and return if so
            if (is_array($array)) {
                return $array;
            } else {
                return null;
            }
            
        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while verifying the data type for the data that was recieved",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }
    }

    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isBool($boolean)
    {

        try {

            if (is_bool($boolean)) {
                return $boolean;
            } else {
                $converted = boolval($boolean);
                if (is_bool($converted)) {
                    return $converted;
                } else {
                    return null;
                }
            }
            return null;
        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while verifying the data type for the data that was recieved",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }
    }


    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isEmail($email)
    {

        try {

            // Removing the illegal characters
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            // Validating
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                return ($email);
            } else {
                return null;
            }
        } catch (\Exception $e) {
            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while verifying the data type for the data that was recieved",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }
    }

    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isFloat($float_number)
    {

        try {

            // make sure its a valid number
            if (!filter_var($float_number, FILTER_VALIDATE_FLOAT) === false) {
                return ($float_number);
            } else {
                return null;
            }
        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while verifying the data type for the data that was recieved",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }
    }

    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isInt($int_number)
    {

        try {

            // make sure its a valid number
            if (!filter_var($int_number, FILTER_VALIDATE_INT) === false) {
                return ($int_number);
            } else {
                // count 0 as a valid integer
                if ($int_number == "0" || $int_number == 0) {
                    return 0;
                } else {
                    return null;
                }
            }
        } catch (\Exception $e) {
            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while verifying the data type for the data that was recieved",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }
    }

    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isIPAddress($ip_address)
    {

        try {

            // make sure its a valid ip address
            if (!filter_var($ip_address, FILTER_VALIDATE_IP) === false) {
                return ($ip_address);
            } else {
                return null;
            }
        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while verifying the data type for the data that was recieved",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }
    }


    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isString($string)
    {

        try {

            // sanitize the text and return it
            $string = filter_var($string, FILTER_SANITIZE_STRING);

            if (is_string($string)) {
                return $string;
            } else {
                return null;
            }
            
        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while verifying the data type for the data that was recieved",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }
    }

    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isURL($url)
    {

        try {

            // sanitize the url
            $url = filter_var($url, FILTER_SANITIZE_URL);

            // then make sure the url is valid
            if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
                return ($url);
            } else {
                return null;
            }
        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while verifying the data type for the data that was recieved",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }
    }

    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isType(mixed $term, string $dataType, ?string $errorName = null)
    {

        switch ($dataType) {
            case ('array'):
                return self::isArray($term);
            case ('bool'):
                return self::isBool($term);
            case ('email'):
                return self::isEmail($term);
            case ('float'):
                return self::isFloat($term);
            case ('int'):
                return self::isInt($term);
            case ('ip'):
                return self::isIPAddress($term);
            case ('skip'):
                return $term;
            case ('string'):
                return self::isString($term);
            case ('url'):
                return self::isURL($term);
            default:
                // ERROR MESSAGE HERE
                return $term;
                break;
        }
    }

    /** 
     *      Description goes here...
     *  
     */
    public static function isDataValid(mixed $term, string $dataType, string $errorName)
    {

        if (self::isType($term, $dataType, $errorName) == null) {
            \MattKurek\AthenaAPI\Response::setError("Invalid data was provided for '" . $errorName . "', not of type '" . $dataType . "'");
        }

        return true;

    }

}