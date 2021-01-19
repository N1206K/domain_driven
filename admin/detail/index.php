<?php
    session_start();
    ini_set('mbstring.internal_encoding' , 'UTF-8');
    ini_set('display_errors', "On");
    require_once(__DIR__.'/../../database.php');
    require_once(__DIR__.'/../../common_functions.php');
    require_once(__DIR__.'/../../const.php');

    //変数の初期化
    $get_data = array();
    include('detail_model.php');
