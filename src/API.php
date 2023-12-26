<?php

namespace MattKurek\AthenaAPI;

/**
 *      the API object is used to initiate the web app and serves as the parent object for the entire API's function
 */
class API
{

    /** 
     *      @property object endpoint
     */
    public object $endpoint;

    /** 
     *      @property object the router object decipher's the requested URL path
     */
    public object $router;

    /**
     *      @param string endpointsFolder - the full file path to the folder containing endpoint scripts
     */
    public function __construct(

        string $databaseHostEnvVar,
        string $databaseNameEnvVar,
        string $databasePassEnvVar,
        string $databaseUserEnvVar,

        string $endpointsFolder,

    ) {

        // initiate the Router object and decipher the client's request
        $this->router = new \MattKurek\AthenaAPI\Router();

        // load the endpoint file
        $this->endpoint = new \MattKurek\AthenaAPI\Endpoint(
            endpointsFolder: $endpointsFolder,
            parameters: $this->router->parameters
        );

        $GLOBALS["API_DOMAIN"] = "https://hq.mattkurek.com/";

        $GLOBALS['_ATHENA_DATABASE_'] = new \MattKurek\AthenaAPI\Database(
            $databaseHostEnvVar,
            $databaseNameEnvVar,
            $databasePassEnvVar,
            $databaseUserEnvVar
        );

    }

    public function __destruct()
    {
    }
}
