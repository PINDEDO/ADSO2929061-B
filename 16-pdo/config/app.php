<?php
    // Sessions
    session_start();

    // Routes Absolutes
    $url    = 'http://'.$_SERVER['HTTP_HOST'].'/'."16-pdo/";
    $public = $url . "public/";
    $css    = $public . "css/";
    $js     = $public . "js/";
    $imgs   = $public . "imgs/";

    // Data Base Config
    $host   = "localhost";
    $user   = "root";
    $pass   = "";
    $dbname = "petsdb";