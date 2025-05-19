<?php
// Classes/PasswordGenerator.php

class PasswordGenerator {
    public static function generate($length = 12, $uppercase = 2, $lowercase = 4, $numbers = 3, $special = 3) {
        $upper_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lower_chars = 'abcdefghijklmnopqrstuvwxyz';
        $number_chars = '0123456789';
        $special_chars = '!@#$%^&*()-_=+[]{}|;:,.<>?';

        // Generate random characters based on the input parameters
        $password = '';
        $password .= self::getRandomChars($upper_chars, $uppercase);
        $password .= self::getRandomChars($lower_chars, $lowercase);
        $password .= self::getRandomChars($number_chars, $numbers);
        $password .= self::getRandomChars($special_chars, $special);

        // Fill the rest with random characters if needed
        while (strlen($password) < $length) {
            $all_chars = $upper_chars . $lower_chars . $number_chars . $special_chars;
            $password .= $all_chars[rand(0, strlen($all_chars) - 1)];
        }

        // Shuffle the password to make it more secure
        return str_shuffle($password);
    }

    private static function getRandomChars($chars, $length) {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $result;
    }
}
?>
