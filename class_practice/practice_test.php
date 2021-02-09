<?php
require_once('practice.php');

//テストデータ
$name = 'タナカイチロウ';
$sex = 1;
$age = 2;
$blood_type = 3;
$job = 4;
$address = '宮崎市出来島町123';
$phone_number = '09012345678';
$mail = 'sample@sample.com';
$interest_category = 5;
$contact_content = 'いろはにほへと';


$customer = new Customer();

echo $customer->name->executeValidation($full_name);
echo $customer->sex->validation($sex);
echo $customer->age->validation($age);
echo $customer->blood_type->validation($blood_type);
echo $customer->job->validation($job);
echo $customer->address->executeValidation($address);
echo $customer->phone_number->validation($phone_number);
echo $customer->mail->executeValidation($mail);
echo $customer->interest_category->validation($interest_category);
echo $customer->contact_content->validation($contact_content);
