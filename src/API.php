<?php

namespace MattKurek\AthenaAPI;

/**
 *      used to initiate the web app
 */
class API {

    public function __construct(
        ?string $databaseHost,
        ?string $databaseName,
        ?string $databasePassword,
        ?string $databaseUser,
    )
    {
        
        echo "API Initiation Beginning <br />";

        // check that proper values were provided for each required parameter

        // decipher the request

        // load the proper endpoint

        echo "API Initiation Finished <br />";
    }

    public function __destruct()
    {
        


    }

}