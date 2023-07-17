<?php 
    session_start();

    // Authentification pour membres.php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "w34tp1";

    $connect = mysqli_connect($host, $user, $pass, $dbname);

    if(mysqli_connect_errno()){
        die("Échec de la connexion à la base de données: " . mysqli_connect_errno());
    }else{
        mysqli_set_charset($connect, "utf8");
    }
?>