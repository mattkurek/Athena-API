<?php

namespace MattKurek\AthenaAPI;




class Authorize {

    public static function requireToken(string $token_type) {
        
        $auth_tokens = \MattKurek\AthenaAPI\Input::getCleanJson("auth", "array");

        if (!array_key_exists($token_type, $auth_tokens)) {
            return false;
        }

        $desired_token = $auth_tokens[$token_type];

        $token = new \MattKurek\AthenaAPI\Token();
        
        if (!$token->verifyToken($desired_token)){
            return false;
        }

        $GLOBALS["CURRENT_USER_ID"] = $token->user_id;

        return true;
        
    }

    public static function requireAdminToken() {
        
    }

    public static function requireUserToken() {

    }

}