<?php

require_once("../vendor/autoload.php");

$GLOBALS["ATHENA"] = new MattKurek\AthenaAPI\API(

    databaseHostEnvVar: "asdfasdf",
    databaseNameEnvVar: "adsf",
    databasePasswordEnvVar: "adsf",
    databaseUserEnvVar: "adsf",

    endpointsFolder: "/var/www/hq.api.mattkurek.com/endpoints/",
    
);

