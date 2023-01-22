<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class AmountInWords extends Model
{

    public function amountInWords($amount)
    {
        $txt = "";
        if (strpos($amount, '.')) {
        } else {
            $amount = $amount . ".00";
        }
        $length = strlen($amount);
        $kobo = substr($amount, $length - 3);
        $kobo = $this->two($kobo) . " Kobo";
        $other = substr($amount, 0, strpos($amount, '.'));
        //dd($other);
        if (strlen($other) == 1) {
            $txt = $this->one($other);
        } else if (strlen($other) == 2) {
            //dd($other);
            $txt = $this->two($other);
        } else if (strlen($other) == 3) {
            if ($other == "000") {
                $txt = "";
            } else {
                $txt = $this->three($other);
            }
        } else if (strlen($other) == 4) {
            if (Str::endsWith($other, "000")) {
                $txt = $this->one(substr($other, 0, 1)) . " thousand";
            } else if (substr($other, 1, 1) == "0" && substr($other, 2, 2) != "00") {

                $txt = $this->one(substr($other, 0, 1)) . " thousand " . $this->two((substr($other, 2, 2)));
            }
            //else
            //{
            //    $txt = $this->onesubtr($other,0,1), thous
            //}

        } else if (strlen($other) == 5) {
            if (Str::endsWith($other, '000')) {
                $txt = $this->two(substr($other, 0, 2)) . " Thousand";
            } else if (substr($other, 2, 1) == "0" && substr($other, 3, 2) != "00") {
                $txt = $this->two(substr($other, 0, 2) . " Thousand " . $this->twosubtr($other, 3, 2));
            } else {
                $txt = $this->two(substr($other, 0, 2)) . " Thousand " . $this->three(substr($other, 2, 3));
            }
        } else if (strlen($other) == 6) {
            if (Str::endsWith($other, "000")) {
                $txt = $this->three(substr($other, 0, 3)) . " Thousand";
            } else {
                $txt = $this->three(substr($other, 0, 3)) . " thousand, " . $this->three(substr($other, 3, 3));
            }
        } else if (strlen($other) == 7) {
            if (Str::endsWith($other, "000000")) {
                $txt = $this->one(substr($other, 0, 1)) . " Million";
            } else //if (substr($other,1, 1) == "0" && substr($other,2, 2) != "00")
            {

                $txt = $this->one(substr($other, 0, 1)) . " million " . $this->amountInWords((substr($other, 1)));
            }
            //else
            //{
            //    $txt = $this->onesubtr($other,0,1), thous
            //}

        } else if (strlen($other) == 8) {
            if (Str::endsWith($other, '000000')) {
                $txt = $this->two(substr($other, 0, 2)) . " Million";
            } else //if (substr($other,2, 1) == "0" && substr($other,3, 2) != "00")
            {
                $txt = $this->two(substr($other, 0, 2)) . " million, " . $this->amountInWords(substr($other, 2));
            }
        }
        if (!Str::endsWith($txt, 'NAIRA ONLY')) {
            $txt .= " NAIRA ONLY";
        }
        return strtoupper($txt);
    }

    public function one($no)
    {
        switch ($no) {
            case "1":
                return "one";
                // break;
            case "2":
                return "two";
                // break;
            case "3":
                return "three";
                //break;
            case "4":
                return "four";
                //break;
            case "5":
                return "five";
                //break;
            case "6":
                return "six";
                // break;
            case "7":
                return "seven";
                //break;
            case "8":
                return "eight";
                //break;
            case "9":
                return "nine";
                //break;
            case "0":
                return "";
            default:
                return "";
        }
    }
    public function two($no)
    {
        $no2 = substr($no, 0, 1);
        // dd($no2,$no);
        switch ($no2) {
            case "1":
                return $this->tens($no);
                //break;

            case "2":
                return "Twenty" . " " . $this->one(substr($no, 1, 1));
                //break;
            case "3":
                return "thirty" . " " . $this->one(substr($no, 1, 1));
                //break;
            case "4":
                return "forty" . " " . $this->one(substr($no, 1, 1));
                //break;
            case "5":
                return "fifty" . " " . $this->one(substr($no, 1, 1));
                //break;
            case "6":
                return "sixty" . " " . $this->one(substr($no, 1, 1));
                //break;
            case "7":
                return "seventy" . " " . $this->one(substr($no, 1, 1));
                //break;
            case "8":
                return "eighty" . " " . $this->one(substr($no, 1, 1));
                //break;
            case "9":
                return "ninety" . " " . $this->one(substr($no, 1, 1));
                //break;
            case "0":
                return "and " . $this->one(substr($no, 1, 1));
            default:
                return "";
        }
    }
    public function three($no)
    {
        $result = "";
        if (substr($no, 1, 2) == "00" && substr($no, 0, 1) != "0") {
            $result = $this->one(substr($no, 0, 1)) . " hundred";
        } else if (substr($no, 1, 1) == "0" && substr($no, 2, 1) != "0") {
            $result = $this->one(substr($no, 0, 1)) . " hundred and " . $this->one(substr($no, 2, 1));
        } else if (substr($no, 1, 2) != "00") {
            $result = $this->one(substr($no, 0, 1)) . " hundred and " . $this->two(substr($no, 1, 2));
        } else if (substr($no, 0, 1) == "0") {
            $result = $this->two(substr($no, 1, 2));
        }

        return $result;
    }
    public function tens($no)
    {
        switch ($no) {
            case "10":
                return "ten";

            case "11":
                return "eleven";
                // break;
            case "12":
                return "twelve";
                //break;
            case "13":
                return "thirteen";
                //break;
            case "14":
                return "fourteen";
                //break;
            case "15":
                return "fifteen";
                //break;
            case "16":
                return "sixteen";
                //break;
            case "17":
                return "seventeen";
                //break;
            case "18":
                return "eighteen";
                // break;
            case "19":
                return "nineteen";
                //break;
            default:
                return "";
        }
    }
}