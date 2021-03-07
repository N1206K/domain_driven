<?php
require_once('../../app/const.php');
require_once('../../app/validation.php');

class FullName
{
    private $full_name;

    public function validation()
    {
        $validation = new Validation();
        if ($validation->isEmpty($this->full_name) || $validation->checkStringsMaxNum($this->full_name, 255)) {
            return false;
        }
    }
}

class Kana
{
    private $kana;

    public function validation()
    {
        $validation = new Validation();
        if (
            $validation->isEmpty($this->kana) ||
            $validation->checkHalfAndFullSizeStrings($this->kana) ||
            $validation->checkStringsMaxNum($this->kana, 255)
        ) {
            return false;
        }
    }
}

class Sex
{
    private $sex;

    public function validation()
    {
        $validation = new Validation();
        if ($validation->isEmpty($this->sex) || $validation->checkDataFromOutside($this->sex, SEX)) {
            return false;
        }
    }
}

class Age
{
    private $age;

    public function validation()
    {
        $validation = new Validation();
        if ($validation->isEmpty($this->age) || $validation->checkDataFromOutside($this->age, AGE)) {
            return false;
        }
    }
}

class BloodType
{
    private $blood_type;

    public function validation()
    {
        $validation = new Validation();
        if ($validation->isEmpty($this->blood_type) || $validation->checkDataFromOutside($this->blood_type, BLOOD_TYPE)) {
            return false;
        }
    }
}

class Job
{
    private $job;

    public function validation()
    {
        $validation = new Validation();
        if ($validation->isEmpty($this->job) || $validation->checkDataFromOutside($this->job, JOB)) {
            return false;
        }
    }
}

class ZipCode
{
    private $zip_code1;
    private $zip_code2;

    public function validation()
    {
        $validation = new Validation();

        //半角に変換
        $this->zip_code1 = mb_convert_kana($this->zip_code1, "n", 'UTF-8');
        $this->zip_code2 = mb_convert_kana($this->zip_code2, "n", 'UTF-8');

        if (
            $validation->isEmpty($this->zip_code1) ||
            $validation->isEmpty($this->zip_code2) ||
            $validation->checkFormat($this->zip_code1, '/^[0-9]{3}$/') ||
            $validation->checkFormat($this->zip_code2, '/^[0-9]{4}$/')
        ) {
            return false;
        }
    }
}

class Prefecture
{
    private $prefecture;

    public function validation()
    {
        $validation = new Validation();
        if ($validation->isEmpty($this->prefecture) || $validation->checkDataFromOutside($this->prefecture, PREFECTURE)) {
            return false;
        }
    }
}

class City
{
    private $city;

    public function validation()
    {
        $validation = new Validation();
        if ($validation->isEmpty($this->city) || $validation->checkStringsMaxNum($this->city, 255)) {
            return false;
        }
    }
}

class AddressOther
{
    private $address_other;

    public function validation()
    {
        $validation = new Validation();
        if ($validation->checkStringsMaxNum($this->address_other, 255)) {
            return false;
        }
    }
}

class PhoneNumber
{
    private $phone_number_1;
    private $phone_number_2;
    private $phone_number_3;
    public $phone_number;

    public function validation()
    {
        $validation = new Validation();

        //半角に変換
        $this->phone_number_1 =  mb_convert_kana($this->phone_number_1, "n", 'UTF-8');
        $this->phone_number_2 =  mb_convert_kana($this->phone_number_2, "n", 'UTF-8');
        $this->phone_number_3 =  mb_convert_kana($this->phone_number_3, "n", 'UTF-8');

        if (
            $validation->isEmpty($this->phone_number_1) ||
            $validation->isEmpty($this->phone_number_2) ||
            $validation->isEmpty($this->phone_number_3) ||
            $validation->checkFormat($this->phone_number_1, '/^[0-9]{2,5}$/') ||
            $validation->checkFormat($this->phone_number_2, '/^[0-9]{2,4}$/') ||
            $validation->checkFormat($this->phone_number_3, '/^[0-9]{3,4}$/')
        ) {
            return false;
        }
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
        $validation = new Validation();

        if (
            $validation->isEmpty($this->mail) ||
            $validation->checkHalfAndFullSizeStrings($this->mail) ||
            $validation->checkStringsMaxNum($this->mail, 255)
        ) {
            return false;
        }
    }
}

class MailReenter
{
    private $remail;

    public function validation($mail)
    {
        $validation = new Validation();
        if (
            $validation->isEmpty($this->remail) ||
            $validation->checkStringsMaxNum($this->remail, 255) ||
            $mail != $this->remail
        ) {
            return false;
        }
    }
}

class Mail
{
    private $mail_enter;
    private $mail_reenter;

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
    private $interest_category;

    public function validation()
    {
        $validation = new Validation();
        //何か選択されていれば、バリデーションチェックをする。
        if (!empty($this->interest_category)) {
            //画面外からのバリデーション
            foreach ($this->interest_category as $value) {
                if ($validation->checkDataFromOutside($value, CATEGORY)) {
                    return false;
                    break;
                }
            }
        }
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
    private $contact_content;

    public function validation()
    {
        $validation = new Validation();
        if ($validation->isEmpty($this->contact_content)) {
            return false;
        }
    }
}


class Name
{
    private $fullname;
    private $kana;

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
    protected $city;
    protected $address_other;

    private function __construct()
    {
        $this->zip_code = new ZipCode();
        $this->prefecture = new Prefecture();
        $this->city = new City();
        $this->address_other = new AddressOther();
    }
    public function executeValidation()
    {
        $this->zip_code->validation();
        $this->prefecture->validation();
        $this->city->validation();
        $this->address_other->validation();
    }
}

class Customer
{
    public $name;
    public $sex;
    public $age;
    public $blood_type;
    public $job;
    public $address;
    public $phone_number;
    public $mail;
    public $interest_category;
    public $contact_content;

    public function __construct($form_data)
    {
        $this->name = new Name($form_data['full_name'], $form_data['kana']);
        $this->sex = new Sex($form_data['sex']);
        $this->age = new Age($form_data['age']);
        $this->blood_type = new BloodType($form_data['blood_type']);
        $this->job = new Job($form_data['job']);
        $this->address = new Address($form_data['zip_code_1'], $form_data['zip_code_2'], $form_data['prefecture'], $form_data['city'], $form_data['address_other']);
        $this->phone_number = new PhoneNumber($form_data['phone_number_1'], $form_data['phone_number_2'], $form_data['phone_number_3']);
        $this->mail = new Mail($form_data['mail'], $form_data['mail_confirm']);
        $this->interest_category = new InterestCategory($form_data['interest_category']);
        $this->contact_content = new ContactContent($form_data['contact_content']);
    }
}
