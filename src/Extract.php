<?php

namespace MattKurek\AthenaAPI;

class Extract
{

    /** 
     *      @param array 
     *      @param string 
     *      @param string 
     *      @param string 
     * 
     *      @return mixed 
     */
    public static function fromArray(array $targetArray, string $termName, string $dataType, ?string $errorName = null, bool $allowNull = false)
    {

        try {
            if (!array_key_exists($termName, $targetArray)) {
                if ($errorName !== null) {
                    \MattKurek\AthenaAPI\Response::setError(
                        message: "Invalid data type provided for '" . $errorName . "'",
                    );
                } else {
                    \MattKurek\AthenaAPI\Response::setError(
                        message: "Invalid data type provided and no error name was provided",
                    );
                }
            }

            if ($allowNull && is_null($targetArray[$termName])) {
                return $targetArray[$termName];
            }

            $term = \MattKurek\AthenaAPI\Validate::isType($targetArray[$termName], $dataType);

            return $term;
        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while extracting data",
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
     *      @param object 
     *      @param string 
     *      @param string 
     *      @param string 
     * 
     *      @return mixed 
     */
    public static function fromObject(object $targetObject, string $propertyName, string $dataType, ?string $errorName = null)
    {


        try {
            if (!property_exists($targetObject, $propertyName)) {
                if ($errorName !== null) {
                    \MattKurek\AthenaAPI\Response::setError(
                        message: "Invalid data type provided for '" . $errorName . "'",
                    );
                } else {
                    \MattKurek\AthenaAPI\Response::setError(
                        message: "Invalid data type provided and no error name was provided",
                    );
                }
            }

            $term = \MattKurek\AthenaAPI\Validate::isType($targetObject->$propertyName, $dataType);

            return $term;

        } catch (\Exception $e) {

            new \MattKurek\AthenaAPI\ErrorEvent(
                message: "An unexpected error occured while extracting data",
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