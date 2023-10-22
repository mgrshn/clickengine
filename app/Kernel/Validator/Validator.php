<?php

namespace App\Kernel\Validator;

use App\Kernel\Database\Database;

class Validator
{
    private static array $errors = [];

    public static function validate(array $data, array $validationRules, Database $pdo): array
    {
        self::clearErrors();

        foreach ($validationRules as $field => $rulesString) {
            $currentFieldRules = explode('|', $rulesString);
            foreach ($currentFieldRules as $currentFieldRule) {
                $message = self::validateRule($currentFieldRule, $data[$field], $pdo);
                if ($message) {
                    self::$errors[$field] = $message;
                    break;
                }
            }
        }
        return self::$errors;
    }

    private static function clearErrors()
    {
        self::$errors = [];
    }

    private static function validateRule(string $ruleName, string $ruleVal, Database $pdo): string|false
    {
        switch ($ruleName) {
            case 'email':
                if (!filter_var($ruleVal, FILTER_VALIDATE_EMAIL)) {
                    return "Invalid email!!";
                }
                break;
            case 'required':
                if (empty($ruleVal)) {
                    return "This field is required";
                }
                break;
            case 'min8':
                if (mb_strlen($ruleVal) < 8) {
                    return "This field must be longer than 8 symbols";
                }
                break;
            case 'max255':
                if (mb_strlen($ruleVal) > 255) {
                    return "This field must be shorter than 8 symbols";
                }
                break;
            case 'unique':
                $userId = $pdo->getUserIdByEmail($ruleVal);
                if ($userId) {
                    return "User with this email already exists";
                }
                break;
        }
        return false; 
    }
}