<?php

namespace MattKurek\AthenaAPI;

/**
 *      used to initiate the web app
 */
class Endpoint
{

    public function __construct(
        private string $endpointsFolder,
        private array $parameters
    ) 
    {

        $endpoint = $endpointsFolder;

        foreach ($parameters as $parameter) {

            $endpoint .= "/" . $parameter;

            if (file_exists($endpoint . ".php")) {

                require_once($endpoint . ".php");

            } 

        }

    }

    public function __destruct()
    {

    }
    
}
