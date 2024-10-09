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
    <form method="POST" action="add_event_team_proses.php">
        <label for="idevent">Pilih Event:</label>
        <select name="idevent" required>
            <?php
            require_once "../service/koneksi.php";

            $sql = "SELECT idevent, name FROM event";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['idevent']}'>{$row['name']}</option>";
            }
            ?>
        </select><br>

        <label for="idteam">Pilih Tim:</label>
        <select name="idteam" required>
            <?php
            $sql = "SELECT idteam, name FROM team";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['idteam']}'>{$row['name']}</option>";
            }
            ?>
        </select><br>

        <input type="submit" name="add_team_to_event" value="Tambahkan Tim ke Event">
    </form>

</body>

</html>