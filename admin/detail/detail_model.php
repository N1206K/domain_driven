<?php
    //ログインのセッションが切れていたら、ログイン画面に遷移する。
    if (!$_SESSION['login_flg']) {
        header("Location: /naito/admin/login");
        exit;
    }

    try {
        //$_GETを取得し、$get_data変数に格納する。
        $get_data = $_GET;

        //sql用変数$sqlにお問い合わせ情報を取得するsql文を設定する。
        $sql = 'SELECT contact_no, name, kana, sex, age, blood_type, job, zip1, zip2, address1, address2, address3, tel, mail, category, info, mail, created FROM naito_contact_info WHERE contact_no = :contact_no';

        //データベースに接続し、データを取得する。
        $pdo  = connect_pdo($datasouce);
        $stmh = $pdo->prepare($sql);
        $stmh->bindParam(':contact_no' , $get_data['contact_no'], PDO::PARAM_STR);
        $stmh->execute();
        $rows = $stmh->fetch(PDO::FETCH_ASSOC);

        if (!$rows) {
            header("Location: /naito/admin/list");
            exit;
        }

        //表示用にデータを設定する。
        $confirm_data = $rows;
        $confirm_data['post_code']         = $rows['zip1'].'-'.$rows['zip2'];
        $confirm_data['pref']              = $prefecture[$rows['address1']].$rows['address2'];
        $confirm_data['interest_category'] = explode(' ', $rows['category']);
        $confirm_data['created_date']      = explode(' ', $rows['created']);

    } catch (Exception $e) {

        echo 'error' .$e->getMesseage;
        exit();

    }

    //テンプレート読み込み
    include('detail_template.php');
