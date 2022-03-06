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
     *      @property string endpointsFolder is asdfa 
     */
    public string $endpointsFolder;

    /** 
     *      @property object router
     */
    public object $router;


    public function __construct(
        string $endpointsFolder,
    ) {

        // initiate the Router object and decipher the client's request
        $this->router = new \MattKurek\AthenaAPI\Router();

        // load the endpoint file
        $this->endpoint = new \MattKurek\AthenaAPI\Endpoint(
            endpointsFolder: $endpointsFolder,
            parameters: $this->router->parameters
        );

    }

    public function __destruct()
    {
    }
}
