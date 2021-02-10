<?php
require_once('../form/const.php');
require_once('../form/functions.php');

class FullName
{
    protected $full_name;

    public function validation()
    {
        $validation_flg = false;

        //必須のバリデーション
        if (!isset($this->full_name) || $this->full_name == '') {
            $validation_flg = true;
        } elseif (countStrings($this->full_name, 255)) {
            $validation_flg = true;
        }

        return $validation_flg;
    }
}

class Kana
{
    protected $kana;

    public function validation()
    {
        $validation_flg = false;

        //必須のバリデーション
        if (!isset($this->kana) || $this->kana == '') {
            $validation_flg = true;
        } else {
            //フォーマットと桁数のバリデーション
            $return_format = checkFormat($this->kana, '/^[ァ-ヶーa-zA-Zａ-ｚＡ-Ｚ]+$/u');
            $return_length = countStrings($this->kana, 255);

            if ($return_format || $return_length) {
                $validation_flg = true;
            }
        }

        return $validation_flg;
    }
}

class Sex
{
    protected $sex;

    public function validation()
    {
        $validation_flg = false;

        //必須のバリデーション
        if (!isset($this->sex) || $this->sex == '') {
            $validation_flg = true;
        } else {
            //フォーマットと桁数のバリデーション
            $return_format = checkFormat($this->sex, '/^[ァ-ヶーa-zA-Zａ-ｚＡ-Ｚ]+$/u');
            $return_length = countStrings($this->sex, 255);

            if ($return_format || $return_length) {
                $validation_flg = true;
            }
        }

        return $validation_flg;
    }
}

class Age
{
    protected $age;

    public function validation()
    {
        $validation_flg = false;

        //必須のバリデーション
        if (!isset($age) || $age == '') {
            $validation_flg = true;
        } elseif (checkDataFromOutside($this->age, AGE)) {
            //画面外からのバリデーション
            $validation_flg = true;
        }

        return $validation_flg;
    }
}

class BloodType
{
    protected $blood_type;

    public function validation()
    {
        $validation_flg = false;

        //必須のバリデーション
        if (!isset($blood_type) || $blood_type == '') {
            $validation_flg = true;
        } elseif (checkDataFromOutside($this->blood_type, BLOOD_TYPE)) {
            //画面外からのバリデーション
            $validation_flg = true;
        }

        return $validation_flg;
    }
}

class Job
{
    protected $job;

    public function validation()
    {
        $validation_flg = false;

        //必須のバリデーション
        if (!isset($job) || $job == '') {
            $validation_flg = true;
        } elseif (checkDataFromOutside($this->job, JOB)) {
            //画面外からのバリデーション
            $validation_flg = true;
        }

        return $validation_flg;
    }
}

class ZipCode
{
    protected $zip_code1;
    protected $zip_code2;

    public function validation()
    {
        $validation_flg = false;

        //半角に変換
        $this->zip_code1 = mb_convert_kana($this->zip_code1, "n", 'UTF-8');
        $this->zip_code2 = mb_convert_kana($this->zip_code2, "n", 'UTF-8');

        //必須のバリデーション
        if (
            !isset($this->zip_code1) || $this->zip_code1 == '' ||
            !isset($this->zip_code2) || $this->zip_code2 == ''
        ) {
            $validation_flg = true;
        } else {
            $return_format_post_1 = checkFormat($this->zip_code1, '/^[0-9]{3}$/');
            $return_format_post_2 = checkFormat($this->zip_code2, '/^[0-9]{4}$/');

            //フォーマットのバリデーション
            if ($return_format_post_1 || $return_format_post_2) {
                $validation_flg = true;
            }
        }

        return $validation_flg;
    }
}

class Prefecture
{
    protected $prefecture;

    public function validation()
    {
        $validation_flg = false;

        //必須のバリデーション
        if (!isset($this->prefecture) || $this->prefecture == '') {
            $validation_flg = true;
        } elseif (checkDataFromOutside($this->prefecture, PREFECTURE)) {
            //画面外からのバリデーション
            $validation_flg = true;
        }

        return $validation_flg;
    }
}

class Municipality
{
    protected $municipality;

    public function validation()
    {
        $validation_flg = false;

        //必須のバリデーション
        if (!isset($this->municipality) || $this->municipality == '') {
            $validation_flg = true;
        } elseif (countStrings($this->municipality, 255)) {
            //桁数のバリデーション
            $validation_flg = true;
        }

        return $validation_flg;
    }
}

class AddressOther
{
    protected $address_other;

    public function validation()
    {
        $validation_flg = false;

        //桁数のバリデーション
        if (countStrings($this->address_other, 255)) {
            $validation_flg = true;
        }

        return $validation_flg;
    }
}

class PhoneNumber
{
    protected $phone_number_1;
    protected $phone_number_2;
    protected $phone_number_3;
    public $phone_number;

    public function validation()
    {
        $validation_flg = false;

        //半角に変換
        $this->phone_number_1 =  mb_convert_kana($this->phone_number_1, "n", 'UTF-8');
        $this->phone_number_2 =  mb_convert_kana($this->phone_number_2, "n", 'UTF-8');
        $this->phone_number_3 =  mb_convert_kana($this->phone_number_3, "n", 'UTF-8');

        //必須のバリデーション
        if (
            !isset($this->phone_number_1) || $this->phone_number_1 == '' ||
            !isset($this->phone_number_2) || $this->phone_number_2 == '' ||
            !isset($this->phone_number_3) || $this->phone_number_3 == ''
        ) {
            $validation_flg = true;
        } else {
            $return_format_phone_1 = checkFormat($this->phone_number_1, '/^[0-9]{2,5}$/');
            $return_format_phone_2 = checkFormat($this->phone_number_2, '/^[0-9]{2,4}$/');
            $return_format_phone_3 = checkFormat($this->phone_number_3, '/^[0-9]{3,4}$/');

            //フォーマットのバリデーション
            if ($return_format_phone_1 || $return_format_phone_2 || $return_format_phone_3) {
                $validation_flg = true;
            }
        }

        return $validation_flg;
    }

    public function linkingPhoneNumber()
    {
        $this->phone_number = $this->phone_number_1 . '-' . $this->phone_number_2 . '-' . $this->phone_number_3;
        return $this->phone_number;
    }
}

class MailEnter
{
    public $mail;

    public function validation()
    {
        $validation_flg = false;

        //必須のバリデーション
        if (!isset($this->mail) || $this->mail == '') {
            $validation_flg = true;
        } else {
            //文字数のカウント
            $return_mail_length = countStrings($this->mail, 255);
            $return_format_mail = checkFormat($this->mail, '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD');

            //フォーマットのバリデーション
            if ($return_format_mail || $return_mail_length) {
                $validation_flg = true;
            }
        }

        return $validation_flg;
    }
}

class MailReenter
{
    protected $remail;

    public function validation($mail)
    {
        $validation_flg = false;

        //必須のバリデーション
        if (!isset($this->remail) || $this->remail == '') {
            $validation_flg = true;
        } else {
            //文字数のカウント
            $return_confirm_length = countStrings($this->remail, 255);

            //フォーマットのバリデーション
            if (($mail != $this->remail) || $return_confirm_length) {
                $validation_flg = true;
            }
        }

        return $validation_flg;
    }
}

class Mail
{
    protected $mail_enter;
    protected $mail_reenter;

    function __construct()
    {
        $this->mail_enter = new MailEnter();
        $this->mail_reenter = new MailReenter();
    }

    public function executeValidation()
    {
        $this->mail_enter->validation();
        $this->mail_reenter->validation($this->mail_enter->mail);
    }
}

class InterestCategory
{
    protected $interest_category;

    public function validation()
    {
        $validation_flg = false;

        //何か選択されていれば、バリデーションチェックをする。
        if (!empty($this->interest_category)) {
            //画面外からのバリデーション
            foreach ($this->interest_category as $value) {
                if (checkDataFromOutside($value, CATEGORY)) {
                    $validation_flg = true;
                    break;
                }
            }
        }

        return $validation_flg;
    }

    public function maintainingValue()
    {
        foreach (CATEGORY as $key => $value) {
            $checked = '';
            if (isset($this->interest_category)) {
                if (in_array($key, $this->interest_category)) {
                    //選択を維持する。
                    $checked = 'checked=checked';
                }
            }
        }

        return $checked;
    }
}

class ContactContent
{
    protected $contact_content;

    public function validation()
    {
        $validation_flg = false;

        //必須のバリデーション
        if (!isset($this->contact_content) || $this->contact_content == '') {
            $validation_flg = true;
        }

        return $validation_flg;
    }
}


class Name
{
    protected $fullname;
    protected $kana;

    function __construct()
    {
        $this->fullname = new fullName();
        $this->kana = new kana();
    }

    public function executeValidation()
    {
        $this->fullname->validation();
        $this->kana->validation();
    }
}

class Address
{
    protected $zip_code;
    protected $prefecture;
    protected $municipality;
    protected $address_other;

    function __construct()
    {
        $this->zip_code = new ZipCode();
        $this->prefecture = new Prefecture();
        $this->municipality = new Municipality();
        $this->address_other = new AddressOther();
    }
}

class Customer
{
    protected $name;
    protected $sex;
    protected $age;
    protected $blood_type;
    protected $job;
    protected $address;
    protected $phone_number;
    protected $mail;
    protected $interest_category;
    protected $contact_content;

    function __construct()
    {
        $this->name = new Name();
        $this->sex = new Sex();
        $this->age = new Age();
        $this->blood_type = new BloodType();
        $this->job = new Job();
        $this->address = new Address();
        $this->phone_number = new PhoneNumber();
        $this->mail = new Mail();
        $this->interest_category = new InterestCategory();
        $this->contact_content = new ContactContent();
    }
}
