<?php

class InputValidator
{
    public function hasSpecialCharacter($inputs)
    {
        foreach ($inputs as $input) {
            if (!preg_match('/^[a-zA-Z0-9_\-\s]+$/', $input)) {
                return true;
            }
        }
        return false;
    }

    public function hasNumber($input)
    {
        if (!preg_match('/^[a-zA-Z\s\-]+$/', $input)) {
            return true;
        } else {
            return false;
        }
    }

    public function sanitize($key, $default = '', $ucwords = false)
    {
        $value = $_REQUEST[$key] ?? $default;
        $value = trim($value);
        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

        if($ucwords){
            $value = ucwords($value);
        }
        
        return $value;
    }
}
