<?php
    session_start();
    ini_set('mbstring.internal_encoding' , 'UTF-8');
    ini_set('display_errors', "On");
    require_once(__DIR__.'/../../database.php');
    require_once(__DIR__.'/../../common_functions.php');
    require_once(__DIR__.'/functions.php');

    //変数の初期化
    $form_data = array();
    include('list_model.php');
