<?php

/*
 *
 * 
 *          this class's only purpose is to implement static functions for accessing the global database object
 * 
 * 
 */

namespace MattKurek\AthenaAPI;

class DB {


    /*
     *
     *     function that allows for execution of SQL queries for creating tables
     * 
     */
    public static function createTable(string $sql) {

        try {

            return $GLOBALS['_ATHENA_DATABASE_']->createTable($sql);

        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while attempting to delete from the database",
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
     *     function that allows for execution of SQL queries for delete statements
     * 
     */
    public static function delete($sql, $parameters) {

        try {

            return $GLOBALS['_ATHENA_DATABASE_']->delete($sql, $parameters);

        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while attempting to delete from the database",
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
     *      function that allows for execution of SQL queries for insert statements
     * 
     */
    public static function insert($sql, $parameters) {

        try {

            return $GLOBALS['_ATHENA_DATABASE_']->insert($sql, $parameters);

        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while attempting to insert into the database",
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
     *      Returns the ID of the most recently inserted data entry in the global database
     * 
     */
    public static function insertID() {

        try {

            return $GLOBALS['_ATHENA_DATABASE_']->insertID;

        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while attempting to delete from the database",
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
     *      function that allows for the execution of SQL queries for select statements. 
     * 
     */
    public static function select($sql, $parameters = false) {

        try {

            return $GLOBALS['_ATHENA_DATABASE_']->select($sql, $parameters);

        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while attempting to search the database",
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
     *     function that allows for the execution of SQL queries for update statements
     * 
     */
    public static function update($sql, $parameters) {

        try {

            return $GLOBALS['_ATHENA_DATABASE_']->update($sql, $parameters);

        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while attempting to update the database",
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