<?php
session_start();
ini_set('mbstring.internal_encoding', 'UTF-8');
ini_set('display_errors', "On");
require_once('../../../app/database.php');
require_once('../../../app/common_functions.php');
require_once('../../../app/const.php');
require_once('../../../app/validation.php');
require_once('../../../src/application/top_application.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //初期化
    $all_data = $_SESSION['form_data'];

    //applicationの読み込み。
    $confirm_application = new ConfirmApplication();

    if ($confirm_application->confirm($all_data)) {
        include('../Template/confirm_complete.php');
        return;
    }
}
include('../Template/confirm_template.php');
