<?php
require_once('../../src/model/name.php');

class TopApplication
{
    private $top_model;

    public function confirm($form_data)
    {
        $this->top_model = new Customer($form_data);
        $error_message = array();

        if ($this->top_model->name->full_name->validation($form_data['full_name'])) {
            $error_message['name'] = 'お名前は、正しく入力してください。';
        }
        if ($this->top_model->name->kana->validation($form_data['kana'])) {
            $error_message['name'] = 'フリガナは、正しく入力してください。';
        }
        if ($this->top_model->sex->validation($form_data['sex'])) {
            $error_message['sex'] = '性別は、正しく入力してください。';
        }
        if ($this->top_model->age->validation($form_data['age'])) {
            $error_message['age'] = '年齢は、正しく入力してください。';
        }
        if ($this->top_model->blood_type->validation($form_data['blood_type'])) {
            $error_message['blood_type'] = '血液型は、正しく選択してください。';
        }
        if ($this->top_model->job->validation($form_data['job'])) {
            $error_message['job'] = '職業は、正しく入力してください。';
        }
        if ($this->top_model->address->zip_code->validation($form_data['zip_code_1'], $form_data['zip_code_2'])) {
            $error_message['address'] = '郵便番号は、正しく入力してください。';
        }
        if ($this->top_model->address->prefecture->validation($form_data['prefecture'])) {
            $error_message['address'] = '都道府県は、正しく入力してください。';
        }
        if ($this->top_model->address->city->validation($form_data['city'])) {
            $error_message['address'] = '市区町村は、正しく入力してください。';
        }
        if ($this->top_model->address->address_other->validation($form_data['address_other'])) {
            $error_message['address'] = '住所(その他)は、正しく入力してください。';
        }
        $phone_number_flg = $this->top_model->phone_number->validation($form_data['phone_number_1'], $form_data['phone_number_2'], $form_data['phone_number_3']);
        if ($phone_number_flg) {
            $error_message['phone_number'] = '電話番号は、正しく入力してください。';
        }
        if ($this->top_model->mail->executeValidation($form_data['mail'], $form_data['mail_confirm'])) {
            $error_message['mail'] = 'メールアドレスは、正しく入力してください。';
        }
        if ($this->top_model->interest_category->validation($form_data['interest_category'])) {
            $error_message['interest_category'] = '興味のあるカテゴリ-は、正しく入力してください。';
        }
        if ($this->top_model->contact_content->validation($form_data['contact_content'])) {
            $error_message['interest_category'] = 'お問い合わせ内容は、正しく入力してください。';
        }

        return $error_message;
    }
}
