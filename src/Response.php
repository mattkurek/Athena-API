<?php

namespace MattKurek\AthenaAPI;

class Response
{

    /** 
     *      produces the final http response and sends it to the client with an error status 
     * 
     *      @param string class - 
     *      @param string message - a text string that will be sent back to the client
     *      @param string file - 
     *      @param string function - 
     *      @param string line - 
     *      @param string method - 
     *      @param string namespace - 
     * 
     *      @return void returns the final response message to the client and ends the script
     */
    public static function setError(
        string $message,
        int $responseCode = 400
    ): void {

        try {

            // create an array to hold the response message;
            $response = array(
                'message' => $message,
            );

            // set http response code
            http_response_code($responseCode);

            // send the output object back to the client
            echo (json_encode($response));

            exit();
        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                errorResponse: false,
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );

            // set http response code
            http_response_code(400);

            // send the output object back to the client
            echo (json_encode(array('message' => "An unexpected error occured, please try again")));

            exit();
        }
    }

    /** 
     *      produces the final http response and sends it to the client with a success status
     * 
     *      @param string message - a text string that will be sent back to the client
     * 
     *      @return void returns the final response message to the client and ends the script
     */
    public static function setSuccess(
        mixed $message, 
        int $responseCode = 200
    ): void {


        try {

            if (is_array($message) || is_object($message)) {
                // the full response has already been provided
                $response = $message;
            } else if (is_string($message)) {
                // create an array to hold the response message;
                $response = array(
                    'message' => $message,
                );
            } else {
                // create a default message to send back as an error
                $response = array(
                    'message' => "An invalid message was provided but supposedly the script succeeded",
                );
            }

            // set http response code
            http_response_code($responseCode);

            // send the output object back to the client
            echo (json_encode($response));

            exit();
        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while creating the response to send back to the client",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }
    }
}