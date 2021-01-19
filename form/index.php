<?php
    session_start();
    ini_set('mbstring.internal_encoding' , 'UTF-8');
    ini_set('display_errors', "On");
    require_once(__DIR__.'/../database.php');
    require_once(__DIR__.'/../common_functions.php');
    require_once(__DIR__.'/../const.php');
    require_once(__DIR__.'/functions.php');

    //変数の初期化
    $form_data = array();
    $error_massage = array();

    if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
        //POSTされたデータを設定
        $form_data = $_POST;

        if (isset($form_data['submit_top'])) {
            include('top_model.php');
        } elseif (isset($form_data['submit_confirm'])) {
            include('confirm_model.php');
        }
    }else{
        session_destroy();
        include('top_template.php');
    }