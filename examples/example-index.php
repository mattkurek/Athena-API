<?php

require_once("../vendor/autoload.php");

$GLOBALS['_ATHENA_DATABASE_'] = new \MattKurek\AthenaAPI\Database(
    databaseHostEnvVar: "MATTHQ_HOST",
    databaseNameEnvVar: "MATTHQ_DATABASE",
    databasePassEnvVar: "MATTHQ_PASSWORD",
    databaseUserEnvVar: "MATTHQ_USER",
);

$GLOBALS["ATHENA"] = new MattKurek\AthenaAPI\API(

    databaseHostEnvVar: "asdfasdf",
    databaseNameEnvVar: "adsf",
    databasePassEnvVar: "adsf",
    databaseUserEnvVar: "adsf",

    endpointsFolder: "/var/www/hq.api.mattkurek.com/endpoints/",
    
);

