<?php
    //sql実行の共通関数
    function execute_sql($pdo,$sql,$bind_name,$bind_kana,$bind_mail) {
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':name' , "%{$bind_name}%", PDO::PARAM_STR);
        $stmh->bindValue(':kana' , "%{$bind_kana}%", PDO::PARAM_STR);
        $stmh->bindValue(':mail' , "%{$bind_mail}%", PDO::PARAM_STR);
        $stmh->execute();
        $rows = $stmh->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }