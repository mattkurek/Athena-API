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
        string $endpointsFolder,
    ) {

        echo "API Initiation Beginning <br />";

        // initiate the Router object and decipher the client's request
        $this->router = new \MattKurek\AthenaAPI\Router();

        // load the endpoint file
        $this->endpoint = new \MattKurek\AthenaAPI\Endpoint(
            endpointsFolder: $endpointsFolder,
            parameters: $this->router->parameters
        );

        echo "API Initiation Finished <br />";
    }

    public function __destruct()
    {
    }
}
