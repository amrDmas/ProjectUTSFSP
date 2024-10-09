<?php 
    

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
<h1>Add New Team</h1>
    <form method="POST" action="add_team_proses.php">
        <p><label>Team Name:</label>
        <input type="text" name="name" required><br></p>

        <p><label>Select Game:</label></p>
        <select name="idgame">
        <?php 
            require_once "../service/koneksi.php";

            $sql = "SELECT * FROM game";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                $idgame = $row['idgame'];
                $name = $row['name'];

                echo "<option value='$idgame'>$name</option>";
            }
        ?>
        </select><br></p>
        <button type="submit" name="add_team">Add Team</button>
    </form>
    
</body>
</html>