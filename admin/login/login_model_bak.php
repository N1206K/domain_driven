<?php
    //バリデーション用フラグ初期化
    $validation_flg = false;

    /*********** ログインIDのバリデーション **********/

    //エラーメッセージを初期化
    $error_message['login_id'] = '';

    //必須のバリデーション
    if (!isset($form_data['login_id']) || $form_data['login_id'] == '') {
        $error_message['login_id'] = 'ログインIDを入力してください。';
        $validation_flg = true;
    }

    /*********** パスワードのバリデーション **********/

    //エラーメッセージを初期化
    $error_message['password'] = '';

    //必須のバリデーション
    if (!isset($form_data['password']) || $form_data['password'] == '') {
        $error_message['password'] = 'パスワードを入力してください。';
        $validation_flg = true;
    }

    /*********** 組み合わせのバリデーション **********/

    if (!$validation_flg) {
        //ログイン情報を取得する。
        try {
            $sql = 'SELECT login_id, password FROM naito_administrators WHERE login_id = :login_id AND password = :password';
            //sql実行
            $pdo  = connect_pdo();
            $stmh = $pdo->prepare($sql);
            $stmh->bindParam(':login_id' , $form_data['login_id'], PDO::PARAM_STR);
            $stmh->bindParam(':password' , $form_data['password'], PDO::PARAM_STR);
            $stmh->execute();
            $rows = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e){
            echo 'error' .$e->getMesseage;
            exit();
        }
        //組み合わせのバリデーションを実行する。
        if (!$rows) {
            $error_message['login_error'] = 'ログインIDまたはパスワードが間違っています。';
            $validation_flg = true;
        }
    }

    /*********** 入力内容をsessionに保持する。 **********/

    $_SESSION['login_data'] = $form_data;

    /*********** リスト画面へ遷移する。 **********/

    if ($validation_flg) {
        //エラーがある場合は、元の画面に遷移する。
        include('login_template.php');
    } else {
        $current_time = date("Y-m-d H:i:s");

        try {
            $sql = 'UPDATE naito_administrators SET last_login_date = :last_login_date, modified = :modified WHERE login_id = :login_id';
            //sql実行
            $pdo  = connect_pdo();
            $stmh = $pdo->prepare($sql);
            $stmh->bindParam(':login_id' , $form_data['login_id'], PDO::PARAM_STR);
            $stmh->bindParam(':last_login_date' , $current_time, PDO::PARAM_STR);
            $stmh->bindParam(':modified' , $current_time, PDO::PARAM_STR);
            $stmh->execute();
            $rows = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e){
            echo 'error' .$e->getMesseage;
            exit();
        }

        /********** ログイン有効期限用のセッションを設定 **********/
        $_SESSION['login_limit'] = 1;


        //エラーがない場合は、確認画面に遷移する。
        header("Location: /naito/admin/list");

        /********** セッションの破棄 **********/

        //セッション変数を全て解除する
        $_SESSION['login_data'] = array();
    }
