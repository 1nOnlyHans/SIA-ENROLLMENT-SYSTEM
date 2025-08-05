<?php

class InputHandler
{
    public static function sanitize_string($value)
    {
        return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
    }

    public static function sanitize_int($value)
    {
        return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function sanitize_name($value)
    {
        $value = preg_replace("/[^a-zA-Z\s\-'.]/", '', $value);
        $value = ucwords(strtolower($value));
        return $value;
    }

    public static function sanitize_email($value)
    {
        return filter_var($value, FILTER_SANITIZE_EMAIL);
    }

    public static function sanitize_mobile($value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }

    public static function sanitize_date($value)
    {
        try {
            $value = new DateTime($value);
            return $value;
        } catch (Exception $e) {
            return '';
        }
    }

    public static function validate_year($value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }

    public static function validateRequired($value)
    {
        return empty(trim($value));
    }
}
