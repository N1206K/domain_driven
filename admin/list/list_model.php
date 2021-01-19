<?php
    //ログインのセッションが切れていたら、ログイン画面に遷移する。
    if (!$_SESSION['login_flg']) {
        header("Location: /naito/admin/login");
        exit;
    }

    try {
        //ページング用変数$nowに1を設定して初期化する。
        $now = 1;
        //データベースに接続する。
        $pdo  = connect_pdo($datasouce);

        //お名前のバインド用変数$bind_nameを初期化する。
        $bind_name = '';

        //カナのバインド用変数$bind_kanaを初期化する。
        $bind_kana = '';

        //メールアドレスのバインド用変数$bind_mailを初期化する。
        $bind_mail = '';

        if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
            //POSTされたデータ$_POSTをポスト用変数$form_dataに設定する。
            $form_data = $_POST;

            //検索条件のお名前が存在するなら、設定を行う。
            if (isset($form_data['full_name'])) {
                $bind_name = $form_data['full_name'];
            }

            //検索条件のカナが存在するなら、設定を行う。
            if (isset($form_data['kana'])) {
                $bind_kana = $form_data['kana'];
            }

            //検索条件のメールが存在するなら、設定を行う。
            if (isset($form_data['mail'])) {
                $bind_mail = $form_data['mail'];
            }

            //バインド用にデータを設定する。
            $_SESSION['full_name'] = $bind_name;
            $_SESSION['kana'] = $bind_kana;
            $_SESSION['mail'] = $bind_mail;
        } else {

            //URL直打ち対策。page_idが存在する時以外は、セッションを覗かせないようにする。
            if (isset($_GET['page_id'])) {

                if (isset($_SESSION['full_name'])) {
                    $bind_name = $_SESSION['full_name'];
                }


                if (isset($_SESSION['kana'])) {
                    $bind_kana = $_SESSION['kana'];
                }


                if (isset($_SESSION['mail'])) {
                    $bind_mail = $_SESSION['mail'];
                }

                //ポストIDを設定する。
                $now = $_GET['page_id'];

            }
        }

        //sql用変数$sqlにお問い合わせ情報を取得するsql文を設定する。
        $sql = 'SELECT contact_no, name, kana, mail, modified FROM naito_contact_info WHERE name LIKE :name AND kana LIKE :kana AND mail LIKE :mail';

        //offset設定用変数$offsetにsql文のoffsetに設定する値の処理を設定する。
        $offset = ($now - 1) * 5;

        //$sqlに追加sql用変数$add_sql_offに上記で設定した$offsetをする。
        $sql .= ' LIMIT 5 OFFSET '.$offset;

        //表示用データを取得する。
        $rows = execute_sql($pdo,$sql,$bind_name,$bind_kana,$bind_mail);

        //登録件数用変数$count_sql変数に、登録されている全件をカウントするsql文を設定する。
        $count_sql = 'SELECT COUNT( contact_no ) AS max_num FROM naito_contact_info WHERE name LIKE :name AND kana LIKE :kana AND mail LIKE :mail';

        //登録件数用データを取得する。
        $count_rows = execute_sql($pdo,$count_sql,$bind_name,$bind_kana,$bind_mail);

        //最大ページ数を格納する変数$max_pageに最大ページ数の設定を行う。
        foreach ($count_rows as $value) {
            if ($value['max_num'] == 0) {
                $count_result = 0;
            }else{
                $count_result = $value['max_num'];
            }
            $max_page = ceil($value['max_num'] / 5);
        }

    } catch (Exception $e) {

        echo 'error' .$e->getMesseage;
        exit();

    }

    //テンプレート読み込み
    include('list_template.php');
