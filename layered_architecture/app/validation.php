<?php
class Validation
{
    //必須のバリデーション
    public function isEmpty($post_data)
    {
        if (!isset($post_data) || $post_data == '') {
            return true;
        }

        return false;
    }

    //桁数のバリデーション
    function checkStringsMaxNum($check_data, $count_num)
    {
        $count_result = mb_strlen($check_data, 'utf-8');
        if ($count_result > $count_num) {
            return true;
        }

        return false;
    }

    //型のバリデーション
    function checkFormat($check_data, $pattern)
    {
        if (!preg_match($pattern, $check_data)) {
            return true;
        }

        return false;
    }

    //リスト内のバリデーション
    function checkDataFromOutside($check_data, $const_array)
    {
        if (!array_key_exists($check_data, $const_array)) {
            return true;
        }

        return false;
    }

    function checkHalfAndFullSizeStrings($check_data)
    {
        //フォーマットと桁数のバリデーション
        $return_format = $this->checkFormat($check_data, '/^[ァ-ヶーa-zA-Zａ-ｚＡ-Ｚ]+$/u');

        if ($return_format) {
            return true;
        }
        return false;
    }

    function checkMailPattern($check_data)
    {
        //フォーマットと桁数のバリデーション
        $return_format = $this->checkFormat($check_data, '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD');

        if ($return_format) {
            return true;
        }
        return false;
    }
}
