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
            $response = Http::head($url);
            if ($response->status() !== 200) {
                return false; // Image does not exist
            }
    
            // Optionally check if the image is not corrupted
            $imageCheck = @imagecreatefromstring(file_get_contents($url));
            if ($imageCheck === false) {
                return false; // Image is corrupted
            }
    
            return true;
        } catch (\Exception $e) {
            return false; // Any error indicates the image is not valid
        }
    }
}
