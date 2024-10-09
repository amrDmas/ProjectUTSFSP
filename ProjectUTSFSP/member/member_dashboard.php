<?php 
    session_start();

    define("APP_NAME", "E-Sport - Club e-Sport INFORMATICS")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=APP_NAME?></title>
</head>
<body>
    <h1><?= $_SESSION['profile'] ?> Dashboard</h1>
    <h3>Selamat Datang <?= $_SESSION['username'] ?></h3>
</body>
</html>