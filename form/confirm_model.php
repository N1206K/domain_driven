<?php

/********** メール送信用に、データを整形する。 **********/
//初期化
$all_data                    = $_SESSION['form_data'];

//性別
$all_data['sex_mail']             = $sex[$_SESSION['form_data']['sex']];

//年齢
$all_data['age_mail']             = $age[$_SESSION['form_data']['age']];

//血液型
$all_data['blood_type_mail']      = $blood_type[$_SESSION['form_data']['blood_type']];

//職業
$all_data['job_mail']             = $job[$_SESSION['form_data']['job']];

//郵便番号
$all_data['post_code']       = $_SESSION['form_data']['post_code_1'] . '-' . $_SESSION['form_data']['post_code_2'];

//住所
$all_data['address']         = $prefecture[$_SESSION['form_data']['prefecture']] . $_SESSION['form_data']['address'];

//電話番号
$all_data['phone_number']    = $_SESSION['form_data']['phone_number_1'] . '-' . $_SESSION['form_data']['phone_number_2'] . '-' . $_SESSION['form_data']['phone_number_3'];

//興味あるカテゴリー
//未入力時に対応する為、未チェック時に初期化しておく。
$all_data['interest_category'] = '';
if (!empty($_SESSION['form_data']['interest_category'])) {
    foreach ($_SESSION['form_data']['interest_category'] as $value) {
        if (empty($all_data['interest_category'])) {
            $all_data['interest_category'] = $category[$value];
        } else {
            $all_data['interest_category'] .= "\n" . $category[$value];
        }
    }
}


/********** メールを送信する。 **********/
$mail_addr_administer = 'naito@training.com';

//管理者宛先情報を設定
$to_name_administer     = "training";
$to_addr_administer     = $mail_addr_administer;
//送信元情報を設定
$from_name_administer     = "training " . $all_data['mail'];
$from_addr_administer     = $all_data['mail'];
//管理者用件名
$subject_administer = "[training]お問い合わせがありました。";


//登録者宛先情報を設定
$to_name_customer     = $all_data['full_name'];
$to_addr_customer     = $all_data['mail'];
//送信元情報を設定
$from_name_customer     = "training";
$from_addr_customer     = $mail_addr_administer;
//登録者用件名
$subject_customer = "[training]お問い合わせありがとうございました。";


//管理者へ
$result_administer = sendMail($all_data, $to_name_administer, $to_addr_administer, $from_name_administer, $from_addr_administer, $subject_administer);

//登録者へ
$result_customer   = sendMail($all_data, $to_name_customer, $to_addr_customer, $from_name_customer, $from_addr_customer, $subject_customer);


//メール送信の結果に応じて遷移先変更
if ($result_administer && $result_customer) {
    //登録用にデータを整形
    $all_data['name']     = $_SESSION['form_data']['full_name'];
    $all_data['zip1']     = $_SESSION['form_data']['post_code_1'];
    $all_data['zip2']     = $_SESSION['form_data']['post_code_2'];
    $all_data['address1'] = $_SESSION['form_data']['prefecture'];
    $all_data['address2'] = $_SESSION['form_data']['address'];
    $all_data['address3'] = $_SESSION['form_data']['address_other'];
    $all_data['tel']      = $_SESSION['form_data']['phone_number_1'] . '-' . $_SESSION['form_data']['phone_number_2'] . '-' . $_SESSION['form_data']['phone_number_3'];
    $all_data['category'] = implode(' ', $_SESSION['form_data']['interest_category']);
    $all_data['info']     = $_SESSION['form_data']['contact_content'];
    $all_data['created']  = date("Y-m-d H:i:s");
    $all_data['modified'] = date("Y-m-d H:i:s");

    $sql =  <<< EOF
INSERT INTO
    naito_contact_info (
        name,
        kana,
        sex,
        age,
        blood_type,
        job,
        zip1,
        zip2,
        address1,
        address2,
        address3,
        tel,
        mail,
        category,
        info,
        created,
        modified
    )
VALUES (
    :name,
    :kana,
    :sex,
    :age,
    :blood_type,
    :job,
    :zip1,
    :zip2,
    :address1,
    :address2,
    :address3,
    :tel,
    :mail,
    :category,
    :info,
    :created,
    :modified
);
EOF;
    //sql実行
    try {
        $pdo  = connect_pdo($datasouce);
        $stmh = $pdo->prepare($sql);
        $stmh->bindParam(':name', $all_data['full_name'], PDO::PARAM_STR);
        $stmh->bindParam(':kana', $all_data['kana'], PDO::PARAM_STR);
        $stmh->bindParam(':sex', $all_data['sex'], PDO::PARAM_INT);
        $stmh->bindParam(':age', $all_data['age'], PDO::PARAM_INT);
        $stmh->bindParam(':blood_type', $all_data['blood_type'], PDO::PARAM_INT);
        $stmh->bindParam(':job', $all_data['job'], PDO::PARAM_INT);
        $stmh->bindParam(':zip1', $all_data['zip1'], PDO::PARAM_STR);
        $stmh->bindParam(':zip2', $all_data['zip2'], PDO::PARAM_STR);
        $stmh->bindParam(':address1', $all_data['address1'], PDO::PARAM_INT);
        $stmh->bindParam(':address2', $all_data['address2'], PDO::PARAM_STR);
        $stmh->bindParam(':address3', $all_data['address3'], PDO::PARAM_STR);
        $stmh->bindParam(':tel', $all_data['tel'], PDO::PARAM_STR);
        $stmh->bindParam(':mail', $all_data['mail'], PDO::PARAM_STR);
        $stmh->bindParam(':category', $all_data['category'], PDO::PARAM_STR);
        $stmh->bindParam(':info', $all_data['info'], PDO::PARAM_STR);
        $stmh->bindParam(':created', $all_data['created'], PDO::PARAM_STR);
        $stmh->bindParam(':modified', $all_data['modified'], PDO::PARAM_STR);
        $stmh->execute();
    } catch (PDOException $Exception) {
        die('エラー：' . $Exception->getMessage());
    }
    $uri = '/naito/form/complete/';
} else {
    $uri = '/naito/form/';
}
header("Location: " . $uri);

/********** セッションの破棄 **********/

//セッション変数を全て解除する
$_SESSION = array();

//最終的に、セッションを破壊する
session_destroy();
