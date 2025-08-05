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

    public function sanitize($field, $default = '', $type = 'string')
    {
        $value = $_REQUEST[$field] ?? $default;
        $value = trim($value);

        switch ($type) {
            case 'name':
                $value = preg_replace("/[^a-zA-Z\s\-'.]/", '', $value); // Keep letters, space, hyphen, apostrophe
                $value = ucwords(strtolower($value));
                break;
            case 'email':
                $value = filter_var($value, FILTER_SANITIZE_EMAIL);
                break;
            case 'mobile':
                $value = preg_replace('/[^0-9]/', '', $value); // Only digits
                break;
            case 'date':
                try {
                    $value = new DateTime($value);
                } catch (Exception $e) {
                    $value = $default; // or $default
                }
                break;
            case 'year':
                $value = preg_replace('/[^0-9]/', '', $value); // Keep digits
                break;
            default:
                $value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS); // For general string
        }

        return $value;
    }
}
