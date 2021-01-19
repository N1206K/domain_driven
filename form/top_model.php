<?php
    //バリデーション用フラグ初期化
    $validation_flg = false;

    /*********** お名前のバリデーション **********/

    //エラーメッセージを初期化
    $error_message['full_name'] = '';

    //必須のバリデーション
    if (!isset($form_data['full_name']) || $form_data['full_name'] == '') {
        $error_message['full_name'] = 'お名前を入力してください。';
        $validation_flg = true;
    } elseif (countStrings($form_data['full_name'],255)) {
        $error_message['full_name'] = 'お名前を正しく入力してください。';
        $validation_flg = true;
    }

    /*********** フリガナのバリデーション **********/

    //エラーメッセージを初期化
    $error_message['kana'] = '';

    //入力値を全角カナに変換する。
    $form_data['kana'] = mb_convert_kana($form_data['kana'], "KVC", 'UTF-8');

    //必須のバリデーション
    if (!isset($form_data['kana']) || $form_data['kana'] == '') {
        $error_message['kana'] = 'フリガナを入力してください。';
        $validation_flg = true;
    } else {
        //フォーマットと桁数のバリデーション
        $return_format = checkFormat($form_data['kana'],'/^[ァ-ヶーa-zA-Zａ-ｚＡ-Ｚ]+$/u');
        $return_length = countStrings($form_data['kana'],255);

        if ($return_format || $return_length) {
            $error_message['kana'] = "フリガナを正しく入力してください。";
            $validation_flg = true;
        }
    }

    /*********** 性別のバリデーション **********/

    //エラーメッセージを初期化
    $error_message['sex'] = '';

    //必須のバリデーション
    if (empty($form_data['sex'])) {
        $error_message['sex'] = '性別を選択してください。';
        $validation_flg = true;
    } elseif (checkDataFromOutside($form_data['sex'],$sex)) {
        //画面外からのバリデーション
        $error_message['sex'] = '画面から選択してください。';
        $validation_flg = true;
    }

    /*********** 年齢のバリデーション **********/

    //エラーメッセージを初期化
    $error_message['age'] = '';

    //必須のバリデーション
    if (!isset($form_data['age']) || $form_data['age'] == '') {
        $error_message['age'] = '年齢を選択してください。';
        $validation_flg = true;
    } elseif (checkDataFromOutside($form_data['age'],$age)) {
        //画面外からのバリデーション
        $error_message['age'] = '画面から選択してください。';
        $validation_flg = true;
    }

    /*********** 血液型のバリデーション **********/

    //エラーメッセージを初期化
    $error_message['blood_type'] = '';

    //必須のバリデーション
    if (empty($form_data['blood_type'])) {
        $error_message['blood_type'] = '血液型を選択してください。';
        $validation_flg = true;
    } elseif (checkDataFromOutside($form_data['blood_type'],$blood_type)) {
        //画面外からのバリデーション
        $error_message['blood_type'] = '画面から選択してください。';
        $validation_flg = true;
    }

    /*********** 職業のバリデーション **********/

    //エラーメッセージを初期化
    $error_message['job'] = '';

    //必須のバリデーション
    if (!isset($form_data['job']) || $form_data['job'] == '') {
        $error_message['job'] = '職業を選択してください。';
        $validation_flg = true;
    } elseif (checkDataFromOutside($form_data['job'],$job)) {
        //画面外からのバリデーション
        $error_message['job'] = '画面から選択してください。';
        $validation_flg = true;
    }

    /*********** 郵便番号のバリデーション **********/

    //エラーメッセージを初期化
    $error_message['post_code'] = '';

    //半角に変換
    $form_data['post_code_1'] = mb_convert_kana($form_data['post_code_1'], "n", 'UTF-8');
    $form_data['post_code_2'] = mb_convert_kana($form_data['post_code_2'], "n", 'UTF-8');

    //必須のバリデーション
    if (
        !isset($form_data['post_code_1']) || $form_data['post_code_1'] == '' ||
        !isset($form_data['post_code_2']) || $form_data['post_code_2'] == ''
    ) {
        $error_message['post_code'] = '郵便番号を入力してください。';
        $validation_flg = true;
    } else {
        $return_format_post_1 = checkFormat($form_data['post_code_1'],'/^[0-9]{3}$/');
        $return_format_post_2 = checkFormat($form_data['post_code_2'],'/^[0-9]{4}$/');

        //フォーマットのバリデーション
        if ($return_format_post_1 || $return_format_post_2) {
            $error_message['post_code'] = "郵便番号を正しく入力してください。";
            $validation_flg = true;
        }
    }

    /*********** 都道府県のバリデーション **********/

    //エラーメッセージを初期化
    $error_message['prefecture'] = '';

    //必須のバリデーション
    if (!isset($form_data['prefecture']) || $form_data['prefecture'] == '') {
        $error_message['prefecture'] = '都道府県を選択してください。';
        $validation_flg = true;
    } elseif (checkDataFromOutside($form_data['prefecture'],$prefecture)) {
        //画面外からのバリデーション
        $error_message['prefecture'] = '画面から選択してください。';
        $validation_flg = true;
    }

    /*********** 住所のバリデーション **********/

    //エラーメッセージを初期化
    $error_message['address'] = '';

    //必須のバリデーション
    if (!isset($form_data['address']) || $form_data['address'] == '') {
        $error_message['address'] = '住所を入力してください。';
        $validation_flg = true;
    } elseif (countStrings ($form_data['address'],255)) {
        //桁数のバリデーション
        $error_message['address'] = '住所を正しく入力してください。';
        $validation_flg = true;
    }

    /*********** ビル・マンションのバリデーション **********/

    //エラーメッセージを初期化
    $error_message['address_other'] = '';

    //桁数のバリデーション
    if (countStrings($form_data['address_other'],255)) {
        $error_message['address_other'] = 'ビル・マンション名を正しく入力してください。';
        $validation_flg = true;
    }

    /*********** 電話番号のバリデーション **********/

    //エラーメッセージを初期化
    $error_message['phone_number'] = '';

    //半角に変換
    $form_data['phone_number_1'] =  mb_convert_kana($form_data['phone_number_1'], "n", 'UTF-8');
    $form_data['phone_number_2'] =  mb_convert_kana($form_data['phone_number_2'], "n", 'UTF-8');
    $form_data['phone_number_3'] =  mb_convert_kana($form_data['phone_number_3'], "n", 'UTF-8');

    //必須のバリデーション
    if (
        !isset($form_data['phone_number_1']) || $form_data['phone_number_1'] == '' ||
        !isset($form_data['phone_number_2']) || $form_data['phone_number_2'] == '' ||
        !isset($form_data['phone_number_3']) || $form_data['phone_number_3'] == ''
    ) {
        $error_message['phone_number'] = '電話番号を入力してください。';
        $validation_flg = true;
    } else {
        $return_format_phone_1 = checkFormat($form_data['phone_number_1'],'/^[0-9]{2,5}$/');
        $return_format_phone_2 = checkFormat($form_data['phone_number_2'],'/^[0-9]{2,4}$/');
        $return_format_phone_3 = checkFormat($form_data['phone_number_3'],'/^[0-9]{3,4}$/');

        //フォーマットのバリデーション
        if ($return_format_phone_1 || $return_format_phone_2 || $return_format_phone_3){
            $error_message['phone_number'] = "電話番号を正しく入力してください。";
            $validation_flg = true;
        }
    }

    /*********** メールアドレスのバリデーション **********/

    //エラーメッセージを初期化
    $error_message['mail'] = '';

    //必須のバリデーション
    if (!isset($form_data['mail']) || $form_data['mail'] == '') {
        $error_message['mail'] = "メールアドレスを入力してください。";
        $validation_flg = true;
    } else {
        //文字数のカウント
        $return_mail_length = countStrings($form_data['mail'],255);
        $return_format_mail = checkFormat($form_data['mail'],'/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD');

        //フォーマットのバリデーション
        if ($return_format_mail || $return_mail_length) {
            $error_message['mail'] = "メールアドレスを正しく入力してください。";
            $validation_flg = true;
        }
    }

    /*********** メールアドレス(再入力)のバリデーション **********/

    //エラーメッセージを初期化
    $error_message['mail_confirm'] = '';

    //必須のバリデーション
    if (!isset($form_data['mail_confirm']) || $form_data['mail_confirm'] == '') {
        $error_message['mail_confirm'] = "メールアドレス(再入力)を入力してください。";
        $validation_flg = true;
    } else {
        //文字数のカウント
        $return_confirm_length = countStrings($form_data['mail_confirm'],255);

        //フォーマットのバリデーション
        if (($form_data['mail'] != $form_data['mail_confirm']) || $return_confirm_length) {
            $error_message['mail_confirm'] = "メールアドレス(再入力)を正しく入力してください。";
            $validation_flg = true;
        }
    }

    /*********** 興味あるカテゴリーのバリデーション **********/

    //エラーメッセージを初期化
    $error_message['interest_category'] = '';

    //何か選択されていれば、バリデーションチェックをする。
    if (!empty($form_data['interest_category'])) {
        //画面外からのバリデーション
        foreach ($form_data['interest_category'] as $value) {
            if (checkDataFromOutside($value,$category)) {
                $error_message['interest_category'] = "画面から選択してください。";
                $validation_flg = true;
                break;
            }
        }
    }

    /*********** お問い合わせ内容のバリデーション **********/

    //エラーメッセージを初期化
    $error_message['contact_content'] = '';

    //必須のバリデーション
    if (!isset($form_data['contact_content']) || $form_data['contact_content'] == '') {
        $error_message['contact_content'] = "お問い合わせ内容を入力してください。";
        $validation_flg = true;
    }

    /*********** 入力内容をsessionに保持する。 **********/

    $_SESSION['form_data'] = $form_data;

    if (!empty($form_data['sex'])) {
        //性別
        $_SESSION['form_data']['sex'] = $form_data['sex'];
    }
    if (!empty($form_data['blood_type'])) {
        //血液型
        $_SESSION['form_data']['blood_type'] = $form_data['blood_type'];
    }
    //興味のあるカテゴリ-
    //未入力時に対応する為、未チェック用に初期化しておく。
    $_SESSION['form_data']['interest_category'] = array();
    if (!empty($form_data['interest_category'])) {
        $_SESSION['form_data']['interest_category'] = $form_data['interest_category'];
    }
    //お問い合わせ
    $_SESSION['form_data']['contact_content'] = $form_data['contact_content'];


    /*********** 確認画面へ遷移する。 **********/

    //確認画面へ遷移する。
    if ($validation_flg) {
        //エラーがある場合は、元の画面に遷移する。
        include('top_template.php');
    } else {
        //郵便番号と住所と電話番号は連結して表示する
        $form_data['pref']         = $prefecture[$form_data['prefecture']].$form_data['address'];
        $form_data['post_code']    = $form_data['post_code_1'].'-'.$form_data['post_code_2'];
        $form_data['phone_number'] = $form_data['phone_number_1'].'-'.$form_data['phone_number_2'].'-'.$form_data['phone_number_3'];
        //エラーがない場合は、確認画面に遷移する。
        include('confirm_template.php');
    }
