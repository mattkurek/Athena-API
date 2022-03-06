<?php

namespace MattKurek\AthenaAPI;

/**
 *      used to initiate the web app
 */
class Router
{

    public function __construct() 
    {
        $this->fullPath = $_SERVER["REQUEST_URL"];

        echo $this->fullPath . '<br />';
    }

    public function __destruct()
    {

    }
    
}
