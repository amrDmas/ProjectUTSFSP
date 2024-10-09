<?php 
    require_once "../service/koneksi.php";

    define("APP_NAME", "E-Sport - Club e-Sport INFORMATICS");
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
<h1>Add New Game</h1>
    <form method="POST" action="add_game_proses.php">
        <p><label>Game Name:</label>
        <input type="text" name="name" required><br></p>
        <p><label>Description:</label>
        <textarea name="description" required></textarea><br></p>
        <button type="submit" name="add_game">Add Game</button>
    </form>
    
</body>
</html>