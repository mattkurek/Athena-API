<?php

namespace MattKurek\AthenaAPI;

class Generate
{


    public static function encryptionKey(int $length)
    {

        try {

            // characters to pick from when generating keys
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            // generate the encryption key
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            // return the encryption key
            return $randomString;
        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while generating encryption keys",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }
    }


    public static function uniqueKey(int $length): string
    {

        try {

            // generate the random and unique key
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            // return the random and unique key
            return $randomString;
        } catch (\Exception $e) {

            // log any unexpected errors which may occur and return an error response

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while generating unique keys",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }
    }





    /*
     *
     *      Function to generate a string of unique and random numbers
     * 
     */
    public static function randomNumbers(int $length): string
    {

        try {

            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            return $randomString;
        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while generating random numbers",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }
    }





    /*
     *
     *      Function to generate a slug given a non-slugifed term 
     * 
     */
    public static function slug(string $text_to_slugify): string
    {

        try {

            // use cocur/slugify to generate a slug

            // use cocur/slugify to generate a slug

            $slugify = new \Cocur\Slugify\Slugify();
            $newslug = $slugify->slugify($text_to_slugify); // hello-world

            return $newslug;
        
        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while generating a slug",
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