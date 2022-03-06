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

        echo "API Initiation Beginning <br />";

        // set property values        
        $this->endpointsFolder = $endpointsFolder;

        // initiate the Router object and decipher the client's request
        $this->router = new \MattKurek\AthenaAPI\Router();

        $this->endpoint = new \MattKurek\AthenaAPI\Endpoint();

        // load the proper endpoint

        echo "API Initiation Finished <br />";
    }

    public function __destruct()
    {
    }
}
