<?php

namespace MattKurek\AthenaAPI;

class User {

    //public static $table = 'Users';
    //public static $confirmations_table = 'UserConfirmations';

    public static $SQL_TABLE = "Users";

    public $id = false;
    public $createdAt = false;
    public $lastModified = false;

    public $username = null;
    public $userslug = null;

    public $password = "";
    public $password_hash = "";

    public $phone_number = "";
    public $email = "";

    public $user_session_token = "";

    //
    // properties used by the class that do not relate to data that is stored within databases
    //
    public $error_message = false;


    public function __construct() {

    }

    
    public function create(string $password) {

        try {

            \MattKurek\AthenaAPI\Validate::isDataValid($this->username, "string", "Username");

            $this->userslug = \MattKurek\AthenaAPI\Generate::slug($this->username);
            \MattKurek\AthenaAPI\Validate::isDataValid($this->userslug, "string", "Userslug");

            $this->password_hash = self::generatePasswordHash($password);
            \MattKurek\AthenaAPI\Validate::isDataValid($this->password_hash, "string", "Password Hash");

            \MattKurek\AthenaAPI\Validate::isDataValid($this->phone_number, "string", "Phone Number");
            \MattKurek\AthenaAPI\Validate::isDataValid($this->email, "string", "Email");

            $sql = "INSERT INTO Users 
                    SET 
                        username = ? , 
                        userslug = ? ,
                        password_hash = ? ,
                        phone_number = ? ,
                        email = ?
                    ";

            $parameters = [
                [$this->username, 'string'],
                [$this->userslug, 'string'],
                [$this->password_hash, 'string'],
                [$this->phone_number, 'string'],
                [$this->email, 'string'],

            ];

            if (!\MattKurek\AthenaAPI\DB::insert($sql, $parameters)) {
                return false;
            }

            return true;

        } catch (\Exception $e) {
    
            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while creating the new 'Brand'",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }

    }


    public static function createObjectFromDatabaseResults($database_results) {

        try {
            
            $user = new User();

            $user->id = \MattKurek\AthenaAPI\Extract::fromArray($database_results, "id", "int", "Brand ID");
            $user->createdAt = \MattKurek\AthenaAPI\Extract::fromArray($database_results, "createdAt", "string", "Created At");
            $user->lastModified = \MattKurek\AthenaAPI\Extract::fromArray($database_results, "lastModified", "string", "Last Modified");
            $user->username = \MattKurek\AthenaAPI\Extract::fromArray($database_results, "username", "string", "Username");
            $user->userslug = \MattKurek\AthenaAPI\Extract::fromArray($database_results, "userslug", "string", "Userslug");
            $user->phone_number = \MattKurek\AthenaAPI\Extract::fromArray($database_results, "phone_number", "string", "Phone Number");
            $user->email = \MattKurek\AthenaAPI\Extract::fromArray($database_results, "email", "string", "Email");
            $user->password_hash = \MattKurek\AthenaAPI\Extract::fromArray($database_results, "password_hash", "string", "Password Hash");

            return $user;

        } catch (\Exception $e) {
    
            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while creating a new 'Brand' object from the database results",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }


    }


    public function delete() {

        
        try {
            
            \MattKurek\AthenaAPI\Validate::isDataValid($this->id, "int", "User ID");

            $sql = "DELETE FROM Users
                    WHERE id = ?
                    ";

            $parameters = [
                [$this->id, 'int'],
            ];

            if (!\MattKurek\AthenaAPI\DB::delete($sql, $parameters)) {
                return false;
            }

            return true;

        } catch (\Exception $e) {
    
            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while deleting a 'Brand'",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }

    }


    

    public static function generatePasswordHash(string $password) {

        $password_hash = password_hash($password, PASSWORD_ARGON2I);

        return $password_hash;
    }

    public function login(string $password) {

        if (!password_verify($password, $this->password_hash)) {
            return false;
        } 

        $this->user_session_token = \MattKurek\AthenaAPI\Token::createToken(user_id: $this->id, token_type: 'user_session');

        return true;


    }

    public static function readAll() {

        try {

            $sql = "SELECT * FROM Users";
    
            // attempt to query the database, return an error if fail
            $results = \MattKurek\AthenaAPI\DB::select($sql);
    
            if (!$results) {
                return false;
            }

            return $results;

        } catch (\Exception $e) {
    
            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while reading all 'Brands'",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }

    }

    public static function readByID($user_id) {

        try {
            
            $sql = "SELECT * FROM Users WHERE id = ?";
            $parameters = [[$user_id, 'int']];
    
            // attempt to query the database, return an error if fail
            $results = \MattKurek\AthenaAPI\DB::select($sql, $parameters);
    
            if (!$results) {
                return false;
            }

            $user = self::CreateObjectFromDatabaseResults($results[0]);

            return $user;

        } catch (\Exception $e) {
    
            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while reading 'Brands' by ID",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }

    }

    public static function readByUsername($username) {

        try {
            
            $sql = "SELECT * FROM Users WHERE username = ?";
            $parameters = [[$username, 'string']];
    
            // attempt to query the database, return an error if fail
            $results = \MattKurek\AthenaAPI\DB::select($sql, $parameters);
    
            if (!$results) {
                return false;
            }

            $user = self::CreateObjectFromDatabaseResults($results[0]);

            return $user;

        } catch (\Exception $e) {
    
            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while reading 'Brands' by ID",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }

    }

    public function update() {

        try {

            \MattKurek\AthenaAPI\Validate::isDataValid($this->id, "int", "User ID");
            \MattKurek\AthenaAPI\Validate::isDataValid($this->username, "string", "Username");

            $this->userslug = \MattKurek\AthenaAPI\Generate::slug($this->username);
            \MattKurek\AthenaAPI\Validate::isDataValid($this->userslug, "string", "Userslug");

            $sql = "UPDATE Users
                    SET
                        username = ?,
                        userslug = ?
                    WHERE id = ?
                    ";

            $parameters = [
                [$this->username, 'string'],
                [$this->userslug, 'string'],
                [$this->id, 'int'],
            ];

            if (!\MattKurek\AthenaAPI\DB::update($sql, $parameters)) {
                return false;
            }

            return true;

        } catch (\Exception $e) {
    
            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while updating a 'Brand' object",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }
    }


}
