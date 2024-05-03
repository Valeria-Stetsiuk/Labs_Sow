<?php

namespace services;

use \Exception;

abstract class CoreServices
{

    /**
     * @Required
         * @return [
             ['message' => 'string', 'code' => int],
             ['message' => 'string', 'code' => int],
         ]
     **/
    abstract protected function errors():array;

    /**
     * @param int $code
     * @param string $message_error
     * @param bool $return  true - return Exception, false - array
     * @return \Exception or array
    **/
    protected function _error(int $code, string $message_error = '', bool $return = false)
    {
        $errors = $this->errors();

        if (!isset($errors[$code]['message'],$errors[$code]['code'])) {
            throw new \Exception('Not found required key in errors array "message" or "code"' , 400);
        }

        $message = $errors[$code]['message'];

        if (!empty($message_error)) {
            $message = $message_error;
        }

        if ($return) {
            return $errors[$code];
        }

        throw new Exception($message, $errors[$code]['code']);
    }


    /**
     * @param array $data_array ['test' => '12']
     * @param array $keys_to_convert_and_type ['test' => int||str||json_encode||json_decode||bool ]
     * @return array
    **/
    protected function convertTypeInArray(array $data_array, array $keys_to_convert_and_type):array
    {

        $conv_type = function ($data, $type )
        {
            switch ($type) {
                case 'int' :
                    return intval($data);
                case 'str' :
                    return trim(strval($data));
                case 'json_encode' :
                    return json_encode($data);
                case 'json_decode' :
                  return json_decode($data);
                case 'bool' :
                    return filter_var($data, FILTER_VALIDATE_BOOLEAN);
                default :
                    throw new \Exception('Not found type');
            }
        };

        if (array_key_exists('*',$keys_to_convert_and_type) && count($keys_to_convert_and_type) == 1) {
            foreach ($data_array as $key => $value) {

                $data_array[$key] = $conv_type($data_array[$key] , $keys_to_convert_and_type['*']);
            }
            return $data_array;
        }

        foreach ( $keys_to_convert_and_type as $key => $value ) {
            $data_array[$key] = $conv_type($data_array[$key] , $value);
        }

        return $data_array;
    }

    /**
     * @param array $data
     * @param array $keys
     * @param bool $check_keys_value_is_null
    **/
    protected function checkRequiredKeys(
        array $data,
        array $keys,
        bool $value_is_null = true,
        int $error_number = 9999
    ):bool
    {

        $check_key = function ($key) use ($data,$value_is_null) {
            if ($value_is_null) {
                return isset($data[$key]);
            }
            return array_key_exists($key,$data);
        };
        
        foreach ($keys as $key => $value) {
            if (is_numeric($key)) {
                if (!$check_key($value)) {
                    if ($error_number == 9999){
                        return false;
                    }
                   return $this->_error($error_number);
                }
            } else {
                if (!$check_key($key)) {
                    if ($error_number == 9999){
                        return false;
                    }
                    return $this->_error($error_number);
                }

                if(!$this->_checkType($value,$data[$key])) {
                    return $this->_error($error_number);
                }
            }
        }
        return true;
    }

    private function _checkType(string $type, $value): bool
    {
        switch ($type) {
            case 'int':
               return is_numeric($value);
            case 'string':
            case 'str':
               return is_string($value) && !empty($value);
            case 'first_name':
            case 'last_name':
                $pattern = "/^[a-zA-Zа-яА-ЯіІїЇґҐ'’]+(?:-[a-zA-Zа-яА-ЯіІїЇґҐ'’]+)?(?: [a-zA-Zа-яА-ЯіІїЇґҐ'’]+(?:-[a-zA-Zа-яА-ЯіІїЇґҐ'’]+)?)*$/u";
                return preg_match($pattern,$value);
            case 'array':
               return is_array($value) && !empty($value);
            case 'datetime':
                if (preg_match('/[^0-9 :.-]/', $value)) {
                    return false;
                }
                return strtotime($value) > 0;
            default :
               return false;
        }
    }

}