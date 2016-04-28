<?php
    function remove_url($value){
        $value = str_replace('../','', $value);
        $value = str_replace('public/files',FILE_URL, $value);
        return $value;
    }
    function showText($value, $options = null){
            $value = str_replace("\'", "'", $value);
            $value = str_replace('\"', '"', $value);
            $value = str_replace("\\\\", "\\", $value);	
            return $value;
    }
    function remove_all_html($string) {
            $string = preg_replace ('/<[^>]*>/', ' ', $string);
            $string = str_replace("\r", '', $string);
            $string = str_replace("\n", ' ', $string);
            $string = str_replace("\t", ' ', $string);
            $string = trim(preg_replace('/ {2,}/', ' ', $string));
            return $string;
    }
    function cut_string($oldstring, $wordsreturned)
    {
        $retval = $string;
        $string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $oldstring);
        $string = str_replace("\n", " ", $string);
        $array = explode(" ", $string);
        if (count($array)<=$wordsreturned)
        {
            $retval = $string;
        }
        else
        {
            array_splice($array, $wordsreturned);
            $retval = implode(" ", $array)."...";
        }
        return $retval;
    }
    function remove_div($string){
            $string = preg_replace ('/\<[\/]{0,1}div[^\>]*\>/i', ' ', $string);
            $string = preg_replace ('/\<[\/]{0,1}p[^\>]*\>/i', ' ', $string);
            $string = preg_replace ('/\<[\/]{0,1}span[^\>]*\>/i', ' ', $string);
            $string = preg_replace ('/\<[\/]{0,1}a[^\>]*\>/i', ' ', $string);
            $string = preg_replace ('/\<[\/]{0,1}h1[^\>]*\>/i', ' ', $string);
            $string = preg_replace ('/\<[\/]{0,1}h2[^\>]*\>/i', ' ', $string);
            $string = preg_replace ('/\<[\/]{0,1}h3[^\>]*\>/i', ' ', $string);
            $string = preg_replace ('/\<[\/]{0,1}h4[^\>]*\>/i', ' ', $string);
            $string = preg_replace ('/\<[\/]{0,1}h5[^\>]*\>/i', ' ', $string);
            $string = preg_replace ('/\<[\/]{0,1}h6[^\>]*\>/i', ' ', $string);
            return $string;
    }