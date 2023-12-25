<?php

namespace MattKurek\AthenaAPI;

/**
 *      Class used to contain all everything related to dissecting the URL request 
 */
class Router
{

    public array $parameters = [];

    public function __construct()
    {

        // first we need to get the parameters from the request
        $this->getRequestParameters();

    }

    public function __destruct()
    {
    }


    /** 
     * 
     *      Function that takes the URL that was requested and breaks it down into it's parameters
     * 
     */
    private function getRequestParameters() {

        // split the request path by slash marks and then filter out the blank strings 
        foreach (explode("/", $_SERVER["REQUEST_URI"]) as $parameter) {
            if ($parameter != "") {
                $this->parameters[] = $parameter;
            }
        }

    }
}
