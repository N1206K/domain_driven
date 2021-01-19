<?php
    //出力するデータをエスケープ
    function h($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    //DB接続用メソッド
    function connect_pdo($db_info) {
        $dsn      = 'mysql:dbname='.$db_info['database'].';host='.$db_info['host'].';charset='.$db_info['charset'];
        $user     = $db_info['username'];
        $password = $db_info['password'];
        $option   = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false);

        try{
            $pdo = new PDO($dsn,$user,$password,$option);
        }catch(Exception $e){
            echo 'error' .$e->getMesseage;
            exit();
        }

        return $pdo;
    }