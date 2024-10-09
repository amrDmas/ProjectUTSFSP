<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "esport_db";

    $conn = new mysqli($hostname, $username, $password, $database);

    if($conn->connect_errno){
        echo "Koneksi ke Database Error". $conn->connect_error;
        die("Error!!");
    }

    // echo "Koneksi ke Database Sukses. <br>";

?>