<?php

namespace App\Helper;

use App\Models\FillInBlank;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Support\Facades\Http;

class Helper
{
    /**
     * Helper function to generate unique id
     * 
     */
    public static function getUniqueID()
    {
        return md5(date('Y-m-d') . microtime() . rand());
    }

    /**
     * Helper function to generate unique case id
     * 
     */
    public static function getUniqueFormatedId($prefix = null)
    {
        return $prefix . strtoupper(substr(uniqid(), 7, 5));
    }

    /**
     * Helper function to generate random phone number
     * 
     */
    public static function generateRandomPhoneNumber()
    {
        $min = 10000000000; // The minimum 11-digit number (inclusive)
        $max = 99999999999; // The maximum 11-digit number (inclusive)

        return rand($min, $max);
    }

   public static function checkImageUrl($url)
    {
        try {
            $headers = @get_headers($url);

            if ($headers && strpos($headers[0], '200')) {
                return true; // Image exists and is valid

            }else{
                return false;
            }
        } catch (\Exception $e) {
            // \Log::error("Error checking image URL: {$url} - " . $e->getMessage());
            return false; // Any error indicates the image is not valid
        }
    }
}
