<?php

namespace app\core;

class Entity
{
    protected $data = [];
    protected $errors = [];

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->data = $data;
        }
    }

    public function __get($name)
    {
        if (empty($this->data)) {
            return null;
        }

        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        return null;
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function addError($field, $message)
    {
        $this->errors[$field] = $message;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function isFieldError($field)
    {
        return isset($this->errors[$field]);
    }

    public function getFieldError($field)
    {
        if (!isset($this->errors[$field])) {
            return null;
        }

        return $this->errors[$field];
    }

    public static function create($tableClassName, array $data = []) {
        $entityClassName = preg_replace("/s$/", '', $tableClassName);

        if (file_exists(sprintf("app/model/entity/%s.php", $entityClassName))) {
            $fullEntityClassName = '\\app\\model\\entity\\'. $entityClassName;
            return new $fullEntityClassName($data);
        }

        return new self($data);
    }
}