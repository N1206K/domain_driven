<?php
/*********** ログイン画面のフロー **********/
    //バリデーションフラグ用変数を初期化する（falseを設定しておく）。
    $validation_flg = false;

    /*********** ログインIDのバリデーション **********/

    //ログインIDのエラーメッセージ用変数を初期化する。
    $error_message['login_id'] = '';

    //ログインIDの必須チェック。true=>エラー、false=>エラーではない
    if (!isset($form_data['login_id']) || $form_data['login_id'] == '') {
        //ログインIDのエラーメッセージ用変数にエラーメッセージを設定する。
        $error_message['login_id'] = 'ログインIDを入力してください。';
        //バリデーションフラグ用変数にtrueを設定する。
        $validation_flg = true;
    }

    /*********** パスワードのバリデーション **********/

    //パスワードのエラーメッセージ用変数を初期化する。
    $error_message['password'] = '';

    //パスワードの必須チェック。true=>エラー、false=>エラーではない
    if (!isset($form_data['password']) || $form_data['password'] == '') {
        //パスワードのエラーメッセージ用変数にエラーメッセージを変数に設定する。
        $error_message['password'] = 'パスワードを入力してください。';
        //バリデーションフラグ用変数にtrueを設定する。
        $validation_flg = true;
    }

    //バリデーションフラグ用変数の中身がfalse（上記入力内容にエラーがないなら）
    if (!$validation_flg) {
        //パスワードがハッシュ化されて登録されているので、形式を揃える。（ハッシュ化されて登録されている前提）
        $hash_pw = hash('sha256', $form_data['password']);

        //DBからログイン情報を取得
        try {
            //new PDOでインスタンスを生成し、データベースに接続する。
            $pdo  = connect_pdo($datasouce);
            //入力されたログインIDとpasswordが一致するデータ（ログインIDとパスワード）を取得する。
            $sql = 'SELECT login_id, password FROM naito_administrators WHERE login_id = :login_id AND password = :password';
            $stmh = $pdo->prepare($sql);
            $stmh->bindParam(':login_id' , $form_data['login_id'], PDO::PARAM_STR);
            $stmh->bindParam(':password' , $hash_pw, PDO::PARAM_STR);
            $stmh->execute();
            $rows = $stmh->fetch(PDO::FETCH_ASSOC);

            //組み合わせのバリデーションを実行する。
            if (!$rows) {
                //エラーメッセージを変数に設定する。
                $error_message['login_error'] = 'ログインIDまたはパスワードが間違っています。';
                //バリデーションフラグ用変数にtrueを設定する。
                $validation_flg = true;
            } else {
                //データが取得できたなら、ログイン日時を保存する。
                $current_time = date("Y-m-d H:i:s");

                $sql = 'UPDATE naito_administrators SET last_login_date = :last_login_date, modified = :modified WHERE login_id = :login_id';
                //sql実行
                $stmh = $pdo->prepare($sql);
                $stmh->bindParam(':login_id' , $form_data['login_id'], PDO::PARAM_STR);
                $stmh->bindParam(':last_login_date' , $current_time, PDO::PARAM_STR);
                $stmh->bindParam(':modified' , $current_time, PDO::PARAM_STR);
                $stmh->execute();
            }
        } catch (Exception $e){
            //データベースでの処理中にエラーがあれば、エラーメッセージを表示する。
            echo 'error' .$e->getMesseage;
            exit();
        }
    }
    /*********** 入力内容をセッションに保持する。 **********/

    //入力画面の入力項目に入力内容を保持する為、セッションに入力されたpostデータをセットする。
    $_SESSION['login_data'] = $form_data;

    /*********** リスト画面へ遷移する。 **********/

    //バリデーションフラグ用変数の中身がtrue（上記入力内容にエラーがあるなら）
    if ($validation_flg) {
        //エラーがあるので、入力画面に遷移する。
        include('login_template.php');
    } else {
        /********** ログイン有効期限用のセッションを設定 **********/

        //ログインの有効期限用フラグとして、セッションにtrueを設定する。
        $_SESSION['login_flg'] = true;

        //エラーがないので、リスト画面に遷移。
        header("Location: /naito/admin/list");
    }