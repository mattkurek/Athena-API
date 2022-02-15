<?php

namespace MattKurek\AthenaAPI;

class ErrorEvent
{
    /** 
     *      @var \DateTime the date and time at which the error occured
     */
    public ?\DateTime $createdAt = null;

    /** 
     *      @var string the name of the class in which the error occured, if applicable
     */
    public ?string $class = null;

    /** 
     *      @var string the data type that was being handled, if applicable
     */
    public ?string $dataType = null;

    /** 
     *      @var string the name of the endpoint in which the error occured, if applicable
     */
    public ?string $endpoint = null;

    /** 
     *      @var string the name of the endpoint in which the error occured, if applicable
     */
    public bool $errorResponse = true;

    /** 
     *      @var string the name of the file in which the error occured, if applicable
     */
    public bool $file = true;

    /** 
     *      @var string the name of the function in which the error occured, if applicable
     */
    public ?string $function = null;

    /** 
     *      @var int  the 
     */
    public ?int $line = null;

    /**     
     *      the name of the method in which the error occured, if applicable
     *      @var string 
     */
    public ?string $method = null;

    /** 
     *      @var string 
     */
    public ?string $message = null;

    /** 
     *      @var string 
     */
    public ?string $namespace = null;

    
    public static function _install()
    {
        try {

            $sql = "CREATE TABLE IF NOT EXISTS ErrorEvents(
                    id INT PRIMARY KEY AUTO_INCREMENT UNIQUE NOT NULL,
                    createdAt TIMESTAMP NOT NULL DEFAULT(CURRENT_TIMESTAMP),
                    class VARCHAR(255) NOT NULL DEFAULT('N/A'),
                    dataType VARCHAR(255) NOT NULL DEFAULT('N/A'),
                    endpoint VARCHAR(255) NOT NULL DEFAULT('N/A'),
                    file VARCHAR(255) NOT NULL DEFAULT('N/A'),
                    function VARCHAR(255) NOT NULL DEFAULT('N/A'),
                    line VARCHAR(255) NOT NULL DEFAULT('N/A'),
                    method VARCHAR(255) NOT NULL DEFAULT('N/A'),
                    message VARCHAR(255) NOT NULL DEFAULT('N/A'),
                    namespace VARCHAR(255) NOT NULL DEFAULT('N/A')
                );";

                if (DB::createTable($sql)){
                    echo '<span style="color: green;">The "ErrorEvents" table was installed </span><br />';
                } else {
                    echo '<span style="color: red;">The "ErrorEvents" table was not installed </span><br />';
                };


        } catch (\Exception $e) {
            error_log($e);
            echo '<span style="color: red; font-size: 24px;">Error installing the "ErrorEvents" table</span><br />';
        }
    }

    /** 
     *      Fill this in with a description of the function...
     *      
     *      @param string class
     *      @param string data
     *      @param string dataType
     *      @param string exception
     *      @param string endpoint
     *      @param string function
     *      @param string method
     *      @param string message
     * 
     */
    public function __construct(
        ?string $class = null,
        bool $createLogEntry = true,
        ?string $data = null,
        ?string $dataType = null,
        ?\Exception $exception = null,
        ?string $endpoint = null,
        bool $errorResponse = true,
        ?string $file = null,
        ?string $function = null,
        ?int $line = null,
        ?string $message = null,
        ?string $method = null,
        ?string $namespace = null,
    ) {

        // set object properties
        $this->class = $class;
        $this->data = $data;
        $this->dataType = $dataType;
        $this->endpoint = $endpoint;
        $this->errorResponse = $errorResponse;
        $this->file = $file;
        $this->function = $function;
        $this->line = $line;
        $this->message = $message;
        $this->method = $method;
        $this->namespace = $namespace;

        // if an Exception was thrown and provided, then add it to the error log
        if (!is_null($exception)) {
            error_log($exception);
        }

        if ($createLogEntry) {
            $this->create();
        }

        if ($errorResponse && !is_null($this->message)) {
            \MattKurek\AthenaAPI\Response::setError($this->message);
        }
    }

    /** 
     *      Fill this in with a description of the function...
     *      
     * 
     */
    public function create(): void
    {

        try {

            if (!self::isLoggingEnabled()) {
                return;
            }

            $sql = new \MattKurek\AthenaAPI\SQL(
                sql: "INSERT INTO ErrorEvents SET",
                parameters: [],
                needsComma: false,
            );

            $validStatement = false;

            if ($sql->addIfTermExists('class', $this->class, 'string')) {
                $validStatement = true;
            }

            if ($sql->addIfTermExists('dataType', $this->dataType, 'string')) {
                $validStatement = true;
            }

            if ($sql->addIfTermExists('endpoint', $this->endpoint, 'string')) {
                $validStatement = true;
            }

            if ($sql->addIfTermExists('function', $this->function, 'string')) {
                $validStatement = true;
            }

            if ($sql->addIfTermExists('message', $this->message, 'string')) {
                $validStatement = true;
            }

            if ($sql->addIfTermExists('method', $this->method, 'string')) {
                $validStatement = true;
            }

            if (is_string($this->data)) {
                // if the data is a string then its ready to add to the database
                if ($sql->addIfTermExists('data', $this->data, 'string')) {
                    $validStatement = true;
                }
            } else if (is_numeric($this->data)) {
                // if the data is numeric then we just need to convert to a string
                $convertedData = strval($this->data);
                if ($sql->addIfTermExists('data', $convertedData, 'string')) {
                    $validStatement = true;
                }
            } else if (is_object($this->data) || is_array($this->data)) {
                // if the data is an object or is an array then we will encode it as a json object so we can store it in the database
                $convertedData = json_encode($this->data);
                if ($sql->addIfTermExists('data', $convertedData, 'string')) {
                    $validStatement = true;
                }
            }

            if ($validStatement) {
                DB::Insert($sql->sql, $sql->parameters);
            }

            return;
        } catch (\Exception $e) {
        }
    }


    public static function install(): void
    {

        try {

            $sql = "CREATE TABLE IF NOT EXISTS Users(
                        class varchar(255) default ('N/A'),
                        createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        data varchar(255) default ('N/A'),
                        dataType varchar(255) default ('N/A'),
                        endpoint varchar(255) default ('N/A'),
                        file varchar(255) default ('N/A'),
                        function varchar(255)  default ('N/A'),
                        line varchar(255) default ('N/A'),
                        method varchar(255) default ('N/A'),
                        message varchar(255) default ('N/A'),
                        namespace varchar(255) default ('N/A'),
                        userId int
                    );  
                    ";

            DB::createTable($sql);
            
        } catch (\Exception $e) {
            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }
    }

    /** 
     *      Fill this in with a description of the function...
     *      
     *      @return bool
     */
    private static function isLoggingEnabled(): bool
    {

        try {
            // make sure constant has been defined
            if (defined(ERROREVENTS_LOGGING_ENABLED)) {
                if (ERROREVENTS_LOGGING_ENABLED) {
                    return true;
                } else {
                    return false;
                }
            } else {
                // if constant hasn't been defined, default to a value of false
                return false;
            }
        } catch (\Exception $e) {
        }
    }
}
