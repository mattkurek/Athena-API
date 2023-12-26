<?php

namespace MattKurek\AthenaAPI;

class Headers {

    /*
     *
     * 
     *      Function to Set the Headers for the App
     * 
     * 
     */
    public static function setAll($parameter = false) {
        
        try {

            // required headers
            header('Access-Control-Allow-Origin: *');
            header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
            header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
            header('Content-Type: application/json');

            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "OPTIONS") {
                header('Access-Control-Allow-Origin: *');
                header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
                header("HTTP/1.1 200 OK");
                die();
            }

            return;

        } catch (\Exception $e) {

            // log any unexpected errors and return an error response message
            error_log($e);
            die('Error Code H-1: Unable to properly launch the application');

        }

        
    }





    /*
     *
     * 
     *          Function to Set the Header for Allowing Access From a Specific Origin
     * 
     * 
     */
    public static function AllowOrigin($parameter) {

        // allow access from the specified origin
        /*
        switch ($parameter) {
            case ('ADMIN'):
                $url = App::ADMIN_FRONTEND_URL;
                break;
            case ('CLIENT'): 
                $url = App::CLIENT_FRONTEND_URL;
                break;
            default:
                exit('Headers :: Invalid Parameter for Allow-Origin');
        }
        */

        // if developer mode is enabled, also allow access from the developer ip address
        /*
        if (App::DEVELOPMENT_MODE) {
            $url .= ' , ' . App::DEV_IP;
        }
        */

        // set the header for origins
        //header('Access-Control-Allow-Origin: ' . $url);
        //header('Access-Control-Allow-Origin: *');

    }

    public static function allowMethod(string $httpMethod) {

        $httpMethod = strtoupper($httpMethod);

        if ($_SERVER["REQUEST_METHOD"] == $httpMethod) {

        } else {

        }

        header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");

    }

    /**
     * 
     *      technically HTTP_ORIGIN can be spoofed by the client, so this serves to protect users from XSS
     * 
     */
    public static function allowOriginn() {

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // you want to allow, and if so:
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");

        }

    }

}