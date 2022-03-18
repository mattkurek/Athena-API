<?php

namespace MattKurek\AthenaAPI;


class SmsEvent
{
    public static string $SQL_TABLE = "SmsEvents";

    public ?string $createdAt = null;

    public ?int $id = null;

    public ?string $event = null;
    public ?string $message = null;

    public ?string $phone = null;

    public ?int $userId = null;

    public static function _install()
    {
        try {

            $sql = "CREATE TABLE IF NOT EXISTS SmsEvents(
                    id INT PRIMARY KEY AUTO_INCREMENT UNIQUE NOT NULL,
                    createdAt TIMESTAMP NOT NULL DEFAULT(CURRENT_TIMESTAMP),
                    adminId INT,
                    event VARCHAR(255) NOT NULL,
                    message VARCHAR(255) NOT NULL,
                    phone VARCHAR(33) NOT NULL,
                    userId INT
                );";

                if (DB::createTable($sql)){
                    echo '<span style="color: green;">The "SmsEvents" table was installed </span><br />';
                } else {
                    echo '<span style="color: red;">The "SmsEvents" table was not installed </span><br />';
                };


        } catch (\Exception $e) {
            error_log($e);
            echo '<span style="color: red; font-size: 24px;">Error installing the "SmsEvents" table</span><br />';
        }
    }

    public static function create(int $adminId = null, string $event, string $message, string $phone, int $userId = null): bool
    {
        try {

            $sql = "INSERT INTO SmsEvents
                    SET
                        adminId = ?,
                        event = ?,
                        message = ?,
                        phone = ?,
                        userId = ?,
                    ";

            $parameters = [
                [$adminId, 'int'],
                [$event, 'string'],
                [$message, 'string'],
                [$phone, 'string'],
                [$userId, 'string'],
            ];

            if (!DB::insert($sql, $parameters)) {
                new \MattKurek\AthenaAPI\ErrorEvent(
                    message: "Unable to create a new sms event",
                    class: __CLASS__,
                    file: __FILE__,
                    line: __LINE__,
                    method: __METHOD__,
                    namespace: __NAMESPACE__,
                );
            
            }

            return true;


        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while reading all users",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }
    }

    public static function readAll(): array
    {
        try {

            $sql = "SELECT * FROM SmsEvents  
                    ";

            $results = DB::select($sql);

            if (!is_array($results)) {
                new \MattKurek\AthenaAPI\ErrorEvent(
                    message: "Unable to find any user events",
                    class: __CLASS__,
                    file: __FILE__,
                    line: __LINE__,
                    method: __METHOD__,
                    namespace: __NAMESPACE__,
                );
            }

            return $results;


        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while reading all users",
                class: __CLASS__,
                exception: $e,
                file: __FILE__,
                line: __LINE__,
                method: __METHOD__,
                namespace: __NAMESPACE__,
            );
        }
    }

    public static function readByAdminId(int $adminId): array
    {
        try {

            $sql = "SELECT * FROM SmsEvents WHERE adminId = ?  
                    ";

            $parameters = [
                [$adminId, "int"]
            ];

            $results = DB::select($sql, $parameters);

            if (!is_array($results)) {
                new \MattKurek\AthenaAPI\ErrorEvent(
                    message: "Unable to find any user events",
                    class: __CLASS__,
                    file: __FILE__,
                    line: __LINE__,
                    method: __METHOD__,
                    namespace: __NAMESPACE__,
                );
            }

            return $results;


        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while reading all users",
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