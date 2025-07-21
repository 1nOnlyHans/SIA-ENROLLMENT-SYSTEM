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

    public function sanitize($key){
        $value = isset($_POST[$key]) ? htmlspecialchars(trim($_POST[$key])) : '';
        if($value){
            $value = ucwords($value);
        }
        return $value;
    }
    
}
