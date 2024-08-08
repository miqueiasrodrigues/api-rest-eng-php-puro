<?php

namespace App\Http\Models;

use App\Exceptions\AppException;
use Exception;

abstract class Model
{
    protected $fillable;
    protected $rules;
    private $message;

    public function __construct(array $fillable,  $rules)
    {
        $this->fillable = $fillable;
        $this->rules = $rules;
        $this->message = "";
    }

    private function get(array $data)
    {
        $model = array();

        foreach ($this->fillable as $attribute) {
            if (array_key_exists($attribute, $data)) {
                $model[$attribute] = $data[$attribute];
            }
        }
        return $model;
    }

    public function validate(array $data)
    {
        foreach ($this->rules as $field => $rule) {
            if (!array_key_exists($field, $data)) {
                throw new Exception("O campo '$field' é obrigatório.");
            }
           
            if (!$this->validateField($field, $data[$field], $rule)) {
                throw new Exception($this->message);
            }
        }

        $extraFields = array_diff(array_keys($data), $this->fillable);

        if (!empty($extraFields)) {
            throw new AppException(400, "Campos não permitidos: " . implode(', ', $extraFields));
            exit;
        }

        return $this->get($data);
    }

    private function validateField($field, $value, $rules)
    {
        $rulesArray = explode('|', $rules);
        foreach ($rulesArray as $rule) {
            $this->setMessage($field, $rule);
            switch ($rule) {
                case 'required':
                    if (empty($value)) {
                        return false;
                    }
                    break;
                case 'numeric':
                    if (!is_numeric($value)) {
                        return false;
                    }
                    break;
                case 'string':
                    if (!is_string($value)) {
                        return false;
                    }
                    break;
                default:
                    break;
            }
        }
        return true;
    }

    private function setMessage($field, $rule)
    {
        switch ($rule) {
            case 'required':
                $this->message = "O campo '$field' é obrigatório.";
                break;
            case 'numeric':
                $this->message = "O campo '$field' deve ser numérico.";
                break;
            case 'string':
                $this->message = "O campo '$field' deve ser uma string.";
                break;
            default:
                $this->message = "Erro de validação no campo '$field'.";
                break;
        }
    }
}
