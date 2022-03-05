<?php

namespace MattKurek\AthenaAPI;

class DatabaseCredential
{

    /** 
     *      @var string a reference name for referring to a specific database, useful when using multiple databases
     */
    private string $referenceName;

    /** 
     *      @var string the name of the SQL database 
     */
    private string $name;

    /** 
     *      @var string the host address for the SQL server
     */
    private string $host;

    /** 
     *      @var string the password for accessing the SQL server, should only be provided via environmental variables
     */
    private string $password;

    /** 
     *      @var string the username for accessing the SQL server
     */
    private string $username;

    public function __construct(
        string $referenceName,
        string $host,
        string $name, 
        string $password,
        string $username
    )
    {
        
    }



}
