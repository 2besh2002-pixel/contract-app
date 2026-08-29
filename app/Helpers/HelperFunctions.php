<?php

if (!function_exists('maskPhone')) {
    /**
     * Mask phone number for display
     * @param string $phone
     * @return string
     */
    function maskPhone(string $phone): string
    {
        if (empty($phone)) {
            return '****';
        }

        // Remove any non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Keep last 4 digits, mask the rest
        if (strlen($phone) > 4) {
            return '****' . substr($phone, -4);
        }

        return '****';
    }
}

if (!function_exists('convertArabicToEnglishNumbers')) {
    /**
     * Convert Eastern Arabic (Hindi) and Persian numerals to Western Arabic (English) numerals.
     *
     * @param string|null $string
     * @return string|null
     */
    function convertArabicToEnglishNumbers(?string $string): ?string
    {
        if ($string === null) {
            return null;
        }

        $easternArabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩', '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $westernArabic = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($easternArabic, $westernArabic, $string);
    }
}
