<?php

namespace MattKurek\AthenaAPI;

/**
 *      used to initiate the web app
 */
class Router
{

    public array $parameters = [];

    public function __construct()
    {

        // split the request path by slash marks and then filter out the blank strings 
        foreach (explode("/", $_SERVER["REQUEST_URI"]) as $parameter) {
            if ($parameter != "") {
                $this->parameters[] = $parameter;
            }
        }

    }

    public function __destruct()
    {
    }
}
