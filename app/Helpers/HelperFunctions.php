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
