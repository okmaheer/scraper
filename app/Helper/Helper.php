<?php

namespace App\Helper;

use App\Models\FillInBlank;
use App\Models\Option;
use App\Models\Question;

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
    public static function getTestType($type)
    {
        if ($type == '1') {
            return 'Mock';
        } else if ($type == '2') {
            return 'Paid';
        }

        return 'Unknown';
    }

    public static function questionGroup($value = null, $type = 1)
    {
        if ($type == 1) {
            $data = [
                1 => 'Three Options (A,B,C)',
                2 => 'Four Options (A,B,C,D)',
                3 => 'Five Options (A,B,C,D,E)',
                4 => 'Three Options (True,False,Not given)',
                5 => 'Three Options (Yes No Not given)',
            ];
        } else {
            $data = [
                6 => 'Fillin Blank at the end of the sentence',
                7 => '2 or maybe 3 blanks in between the sentence',
                8 => 'Picture and 1,2...questions with 1 or 2 blanks',
                9 => 'Picture and and 1,2.... questions with only one blank',
            ];
        }
        if ($value) {
            // Check if the provided $value exists in the $data array
            if (array_key_exists($value, $data)) {
                return $data[$value]; // Return the corresponding option
            } else {
                return "Invalid value"; // Handle the case when $value is not found
            }
        } else {

            return $data;
        }
    }
    public static function calculateBand($test, $type, $score)
    {
        if ($type == 1) {
          
            if ($test->category == 1) {
              
                if ($score->total_score >= 39 && $score->total_score <= 40) {

                    return 9;
                }
                if ($score->total_score >= 37 && $score->total_score <= 38) {

                    return 8.5;
                }
                if ($score->total_score >= 35 && $score->total_score <= 36) {

                    return 8;
                }
                if ($score->total_score >= 33 && $score->total_score <= 34) {

                    return 7.5;
                }
                if ($score->total_score >= 30 && $score->total_score <= 32) {

                    return 7;
                }
                if ($score->total_score >= 27 && $score->total_score <= 29) {

                    return 6.5;
                }
                if ($score->total_score >= 23 && $score->total_score <= 26) {

                    return 6;
                }
                if ($score->total_score >= 19 && $score->total_score <= 22) {

                    return 5.5;
                }
                if ($score->total_score >= 15 && $score->total_score <= 18) {

                    return 5;
                }
                if ($score->total_score >= 13  && $score->total_score <= 14) {

                    return 4.5;
                }
                if ($score->total_score >= 10 && $score->total_score <= 12) {

                    return 4;
                }
                if ($score->total_score >= 8 && $score->total_score <= 9) {

                    return 3.5;
                }
                
                if ($score->total_score >= 6 && $score->total_score <= 7) {

                    return 3;
                }
               
                if ($score->total_score >= 4 && $score->total_score <= 5) {
                  
                    return 2.5;
                }
                if ($score->total_score  <= 4 && $score->total_score  >= 0) {
             
                    return 2;
                }
               
            } else {
               
                if ($score->total_score == 40) {

                    return 9;
                }
                if ($score->total_score == 39) {

                    return 8.5;
                }
                if ($score->total_score >= 37 && $score->total_score <= 38) {

                    return 8;
                }
                if ($score->total_score == 36) {

                    return 7.5;
                }
                if ($score->total_score >= 34 && $score->total_score <= 35) {

                    return 7;
                }
                if ($score->total_score >= 32 && $score->total_score <= 33) {

                    return 6.5;
                }
                if ($score->total_score >= 30 && $score->total_score <= 31) {

                    return 6;
                }
                if ($score->total_score >= 27 && $score->total_score <= 29) {

                    return 5.5;
                }
                if ($score->total_score >= 23 && $score->total_score <= 26) {

                    return 5;
                }
                if ($score->total_score >= 19  && $score->total_score <= 22) {

                    return 4.5;
                }
                if ($score->total_score >= 15 && $score->total_score <= 18) {

                    return 4;
                }
                if ($score->total_score >= 12 && $score->total_score <= 14) {

                    return 3.5;
                }
                if ($score->total_score >= 9 && $score->total_score <= 11) {

                    return 3;
                }
              
                if ($score->total_score <= 8 && $score->total_score  >= 0) {
                  
                    return 2.5;
                }
            }
        } else {
        
            if ($score->total_score >= 39 && $score->total_score <= 40) {

                return 9;
            }
            if ($score->total_score >= 37 && $score->total_score <= 38) {

                return 8.5;
            }
            if ($score->total_score >= 35 && $score->total_score <= 36) {

                return 8;
            }
            if ($score->total_score >= 32 && $score->total_score <= 34) {

                return 7.5;
            }
            if ($score->total_score >= 30 && $score->total_score <= 31) {

                return 7;
            }
            if ($score->total_score >= 26 && $score->total_score <= 29) {

                return 6.5;
            }
            if ($score->total_score >= 23 && $score->total_score <= 25) {

                return 6;
            }
            if ($score->total_score >= 18 && $score->total_score <= 22) {

                return 5.5;
            }
            if ($score->total_score >= 16 && $score->total_score <= 17) {

                return 5;
            }
            if ($score->total_score >= 13  && $score->total_score <= 15) {

                return 4.5;
            }
            if ($score->total_score >= 11 && $score->total_score <= 12) {

                return 4;
            }
          
            if ($score->total_score  <= 10 && $score->total_score >= 0) {

                return 3.5;
            }
           
           
        
        }
    }

    public static function correctAnswer($id)
    {

        $question = Question::findOrFail($id);
        if ($question->category == 1) {

            $option = Option::where('question_id', $id)->where('is_correct', 1)->first();

            return $option->name;
        } elseif ($question->category == 2) {
            $fill = FillInBlank::where('question_id', $id)->first();

            $answerParts = [];

            if ($fill->ans_first_1) {
                $answerParts[] = $fill->ans_first_1;
            }
            if ($fill->ans_first_2) {
                $answerParts[] = $fill->ans_first_2;
            }
            if ($fill->ans_first_3) {
                $answerParts[] = $fill->ans_first_3;
            }


            if ($fill->ans_sec_1) {
                $answerParts[] = $fill->ans_sec_1;
            }
            if ($fill->ans_sec_2) {
                $answerParts[] = $fill->ans_sec_2;
            }
            if ($fill->ans_sec_3) {
                $answerParts[] = $fill->ans_sec_3;
            }

            if ($fill->ans_third_1) {
                $answerParts[] = $fill->ans_third_1;
            }
            if ($fill->ans_third_2) {
                $answerParts[] = $fill->ans_third_2;
            }
            if ($fill->ans_third_3) {
                $answerParts[] = $fill->ans_third_2;
            }


            return implode(' / ', $answerParts);
        } elseif ($question->category == 3) {
            $option = Option::where('question_id', $id)->where('is_correct', 1)->get();

            if (isset($option[0]->name) && isset($option[1]->name)) {
                return $option[0]->name . ' / ' . $option[1]->name;
            }
            if (isset($option[0]->name)) {
                return $option[0]->name;
            }
        }
    }
    public static function userAnswer($json, $id)
    {
        $question = Question::findOrFail($id);

        if ($question->category == 1 && isset($json->mcqs)) {

            foreach ($json->mcqs as $key => $mcqs) {

                if ($id == $key) {
                    $option = Option::where('id', $mcqs)->first();
                    return $option->name;
                }
            }
        } elseif ($question->category == 2 && isset($json->fill)) {

            $answerParts = [];
            foreach ($json->fill as $key => $fill) {

                if ($id == $key) {
                    if (isset($fill[0])) {
                        $answerParts[] =  $fill[0];
                    }
                    if (isset($fill[1])) {
                        $answerParts[] =  $fill[1];
                    }
                    if (isset($fill[2])) {
                        $answerParts[] =  $fill[2];
                    }
                }
            }
            return implode(' / ', $answerParts);
        } elseif ($question->category == 3 && isset($json->fivechoice)) {
            $text = '';
         
            // foreach ($json->fivechoice as $key => $option) {
                if (isset($json->fivechoice->$id)) {
                    $ans = Option::where('id', $json->fivechoice->$id[0])->first();
                    $text =  $ans->name;
                }
                if (isset($json->fivechoice->$id)) {
                    $ans = Option::where('id',$json->fivechoice->$id[1])->first();
                    $text =   $text . '/' . $ans->name;
                }
              
            // }
            // dd($text);
            return $text;
        }
    }
    public static function checkCorrectOrNot($json, $id)
    {
        $question = Question::findOrFail($id);
        if ($question->category == 1 && isset($json->mcqs)) {

            if ($json->mcqs) {
                $options = Option::where('question_id', $id)->where('is_correct', 1)->first();
                if (in_array($options->id, (array)$json->mcqs)) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        if ($question->category == 2 && isset($json->fill)) {
           
            $data = FillInBlank::where('question_id', $id)->first();
          
            $fill = (array)$json->fill;
            $fillResult = [];
            if (array_key_exists($id, $fill)) {
              
                $currentValue = $fill[$id];
              
                if (isset($currentValue[0])) {
                    if (strtolower($data->ans_first_1) == strtolower($currentValue[0])) {
                        array_push($fillResult, true);
                    } elseif (strtolower($data->ans_first_2) == strtolower($currentValue[0])) {
                        array_push($fillResult, true);
                    } elseif (strtolower($data->ans_first_3) == strtolower($currentValue[0])) {
                        array_push($fillResult, true);
                    } else {
                        array_push($fillResult, false);
                    }
                }
               
                if (isset($currentValue[1])) {
                    if (strtolower($data->ans_sec_1) == strtolower($currentValue[1])) {
                        array_push($fillResult, true);
                    } elseif (strtolower($data->ans_sec_2) == strtolower($currentValue[1])) {
                        array_push($fillResult, true);
                    } elseif (strtolower($data->ans_sec_3) == strtolower($currentValue[1])) {
                        array_push($fillResult, true);
                    } else {
                        array_push($fillResult, false);
                    }
                }
                if (isset($currentValue[3])) {
                    if (strtolower($data->ans_third_1) == strtolower($currentValue[3])) {
                        array_push($fillResult, true);
                    } elseif (strtolower($data->ans_third_2) == strtolower($currentValue[3])) {
                        array_push($fillResult, true);
                    } elseif (strtolower($data->ans_third_3) == strtolower($currentValue[3])) {
                        array_push($fillResult, true);
                    } else {
                        array_push($fillResult, false);
                    }
                }
               
                if (in_array(false, $fillResult)) {
                    return false;
                }
                
                if(in_array(true, $fillResult)){
                    return true;
                }else{
                    return false;  
                }
            }
        }
        if ($question->category == 3 && isset($json->fivechoice)) {
            $fiveChoiceResult = [];
            foreach ($json->fivechoice as $key => $option) {
                if (isset($option[0])) {
                    $ans = Option::where('id', $option[0])->first();
                    if ($ans->is_correct == 0) {
                        array_push($fiveChoiceResult, false);
                    } else {
                        array_push($fiveChoiceResult, true);
                    }
                }
                if (isset($option[1])) {
                    $ans = Option::where('id', $option[1])->first();
                    if ($ans->is_correct == 0) {
                        array_push($fiveChoiceResult, false);
                    } else {
                        array_push($fiveChoiceResult, true);
                    }
                }

                if ($fiveChoiceResult[0] && $fiveChoiceResult[1]) {
                    return true;
                }
                if (!$fiveChoiceResult[0] && !$fiveChoiceResult[1]) {
                    return false;
                }
                if (!$fiveChoiceResult[0] || !$fiveChoiceResult[1]) {
                    return 'one';
                }
            }
        }
    }
}
