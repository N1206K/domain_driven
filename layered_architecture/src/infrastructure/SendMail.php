<?php
class SendMail
{
    public function Send($form_data)
    {
        /********** メールを送信する。 **********/
        $mail_addr_administer = 'naito@training.com';

        //管理者宛先情報を設定
        $to_name_administer     = "training";
        $to_addr_administer     = $mail_addr_administer;
        //送信元情報を設定
        $from_name_administer     = "training " . $form_data->mail;
        $from_addr_administer     = $form_data->mail;
        //管理者用件名
        $subject_administer = "[training]お問い合わせがありました。";


        //登録者宛先情報を設定
        $to_name_customer     = $form_data->full_name;
        $to_addr_customer     = $form_data->mail;
        //送信元情報を設定
        $from_name_customer     = "training";
        $from_addr_customer     = $mail_addr_administer;
        //登録者用件名
        $subject_customer = "[training]お問い合わせありがとうございました。";


        //管理者へ
        $result_administer = $this->sendMail($form_data, $to_name_administer, $to_addr_administer, $from_name_administer, $from_addr_administer, $subject_administer);

        //登録者へ
        $result_customer   = $this->sendMail($form_data, $to_name_customer, $to_addr_customer, $from_name_customer, $from_addr_customer, $subject_customer);

        if ($result_administer && $result_customer) {
            return true;
        }
    }

    public function SendMail($mail_data, $mail_to_name, $mail_to_addr, $mail_from_name, $mail_from_addr, $mail_subject)
    {
        //日本語で送信する為に文字コードを指定しておく。（文字化け防止）
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        //宛先情報をエンコード
        $to_name     = $mail_to_name;
        $to_addr     = $mail_to_addr;
        $to_name_enc = mb_encode_mimeheader($to_name, "ISO-2022-JP");
        $to          = "$to_name_enc<$to_addr>";

        //送信元情報をエンコード
        $from_addr     = $mail_from_addr;
        $from_name     = $mail_from_name;
        $from_name_enc = mb_encode_mimeheader($from_name, "ISO-2022-JP");
        $from          = "$from_name_enc<$from_addr>";

        //メールヘッダーの作成
        $header  = "From: $from\n";
        $header .= "Replay-To: $from";

        //MailerDemonの送信先の指定
        $return_path = "-f naito@training.com";

        //件名や本文をセット
        $subject = $mail_subject;
        $body = "
ーーーーーーーーーーーーー
お問い合わせ内容
ーーーーーーーーーーーーー
氏名：{$mail_data->full_name}

フリガナ：{$mail_data->kana}

性別：{$mail_data->sex_mail}

年齢：{$mail_data->age_mail}

血液型：{$mail_data->blood_type_mail}

職業：{$mail_data->job_mail}

郵便番号：{$mail_data->post_code}

住所：{$mail_data->address}

ビル・マンション名：{$mail_data->address_other}

電話番号：{$mail_data->phone_number}

メールアドレス：{$mail_data->mail}

興味あるカテゴリー：{$mail_data->interest_category}

お問い合わせ：{$mail_data->contact_content}
";
        //メールを送信
        $result = mb_send_mail($to, $subject, $body, $header, $return_path);
        return $result;
    }
}
