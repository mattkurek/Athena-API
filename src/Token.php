<?php

namespace MattKurek\AthenaAPI;

class Token {

    public static $SQL_TABLE = "Tokens";

    public $id = "";
    public $created_at = "";
    
    public $token_type = "";
    public $expires_at = "";
    public $user_id = "";
    public $random_key = "adsfadsgr5345t";

    private $key = "25q326afdgsadfh";

    public $issued_by = "";

    public $decrypted_payload = "";
    public $encrypted_payload = "";

    public function _install() {

    }

    public function create() {

        try {

            $sql = "INSERT INTO Tokens 
                    SET 
                        expires_at = ? , 
                        user_id = ? ,
                        random_key = ? ,
                        token_type = ?
                    ";

            $parameters = [
                [$this->expires_at, 'string'],
                [$this->user_id, 'int'],
                [$this->random_key, 'string'],
                [$this->token_type, 'string'],

            ];

            if (!\MattKurek\AthenaAPI\DB::insert($sql, $parameters)) {
                return false;
            }

            $this->id = DB::insertId();

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
            
            $token = new Token();

            $token->id = \MattKurek\AthenaAPI\Extract::fromArray($database_results, "id", "int", "Token ID");
            $token->created_at = \MattKurek\AthenaAPI\Extract::fromArray($database_results, "created_at", "string", "Created At");
            $token->expires_at = \MattKurek\AthenaAPI\Extract::fromArray($database_results, "expires_at", "string", "Expires At");
            $token->user_id = \MattKurek\AthenaAPI\Extract::fromArray($database_results, "user_id", "int", "User ID");
            $token->random_key = \MattKurek\AthenaAPI\Extract::fromArray($database_results, "random_key", "string", "Random Key");
            $token->token_type = \MattKurek\AthenaAPI\Extract::fromArray($database_results, "token_type", "string", "Token Type");

            return $token;

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

    public static function createToken(int $user_id, string $token_type) {

        $token = new Token();

        $token->user_id = $user_id;
        $token->token_type = $token_type;

        $token->generateToken();

        return $token;

    }



    public function isTimeValid() {

        return true;

    }

    public function generateToken() {

        $this->create();

        $payload = [
            'tid' => $this->id,
            'iss' => $_SERVER['HOST_NAME'],
            'exp' => time()+600, 
            'uid' => $this->user_id,
            'ran' => $this->random_key,
            'typ' => $this->token_type
        ];

        $this->encrypted_payload = \Firebase\JWT\JWT::encode($payload, $this->key, 'RS256'); 
        
    }

    public function decodeToken() {

        try {

            $this->decrypted_payload = \Firebase\JWT\JWT::decode($this->encrypted_payload, $this->key);

        } catch (\Exception $e) {

            return false;
        }

        $this->id = $this->decrypted_payload->tid;
        $this->issued_by = $this->decrypted_payload->iss;
        $this->expires_at = $this->decrypted_payload->exp;
        $this->user_id = $this->decrypted_payload->uid;
        $this->random_key = $this->decrypted_payload->ran;
        $this->token_type = $this->decrypted_payload->typ;

        return true;

    }

    public function readByID($token_id) {

        try {

            $sql = "SELECT * FROM Tokens WHERE id = ?";
            $parameters = [[$token_id, 'int']];
    
            // attempt to query the database, return an error if fail
            $results = \MattKurek\AthenaAPI\DB::select($sql, $parameters);
    
            if (!$results) {
                return false;
            }

            $token = self::CreateObjectFromDatabaseResults($results[0]);

            return $token;

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


    public function verifyToken(string $token_to_verify) {

        $this->encrypted_payload = $token_to_verify;

        $this->decodeToken();

        $this->isTimeValid();

        return true;

    }

}