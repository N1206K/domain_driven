<?php
session_start();
ini_set('mbstring.internal_encoding', 'UTF-8');
ini_set('display_errors', "On");
require_once('../../../app/database.php');
require_once('../../../app/common_functions.php');
require_once('../../../app/const.php');
require_once('../../../app/validation.php');
require_once('../../../src/application/top_application.php');

//変数の初期化
$form_data = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //POSTされたデータを設定
    $form_data = $_POST;

    //applicationの読み込み。
    $top_application = new TopApplication();
    $error_message[] = $top_application->confirm($form_data);

    if (empty($error_message)) {
        $_SESSION['form_data'] = $form_data;
        include('../Controller/ConfirmController.php');
        return;
    }
    $_SESSION['error_message'] = $error_message;
} else {
    session_destroy();
}
include('../Template/top_template.php');
