<?php

namespace MattKurek\AthenaAPI;

/**
 *      used to initiate the web app
 * 
 *      ~ global flags ~
 *      _json : array - contains the docded json input, if available
 *      _jsonInitiated : true or false - based on whether json input has been decoded yet 
 * 
 * 
 */
class Input
{

    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    public static function analyzeJson(): void
    {
        try {

            if (!$GLOBALS["_jsonInitiated"]) {

                // make sure that the request was a POST request, otherwise no json present
                if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0) {
                    echo 'not a post!';
                    die;
                }

                // get the raw content from the input stream and convert to json
                $rawContent = trim(file_get_contents("php://input"));
                $decodedJson = json_decode($rawContent, true);

                //If json_decode failed, the JSON is invalid.
                if (!is_array($decodedJson)) {
                    echo 'not a post!';
                    die;
                }

                // the json has been successfully recieved so set the global variables
                $GLOBALS["_json"] = $decodedJson;
                $GLOBALS["_jsonInitiated"] = true;
            }
        } catch (\Exception $e) {

            error_log($e);
        }
    }

    /**
     * 
     *      @param string $variableName - the name of the json variable that you wish to extract
     * 
     *      @return mixed the requested data from the json input
     */
    public static function json(string $variableName): mixed
    {

        try {

            // make sure that the json input has been initialized
            self::analyzeJson();

            // check that the requested variable exists within the json data
            if (array_key_exists($variableName, $GLOBALS["_json"])) {
                return ($GLOBALS["_json"])[$variableName];
            } else {
                echo 'array key does not exist!';
            }

        } catch (\Exception $e) {

            error_log($e);
        }
    }

    public static function getCleanJson(string $variableName, string $variableType): mixed
    {

        try {

            // make sure that the json input has been initialized
            self::analyzeJson();

            // fetch the requested data from the json input
            $requestedData = self::json($variableName);

            // validate and sanitize the requested input data

            return $requestedData;

        } catch (\Exception $e) {

            error_log($e);
            
        }
    }

}
