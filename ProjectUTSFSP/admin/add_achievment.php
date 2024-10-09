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
<h1>Add New Achievement</h1>
    <form method="POST" action="add_achievment_proses.php">
        <p><label>Select Team Name:</label>
        <select name="idteam">
        <?php 
            require_once "../service/koneksi.php";

            $sql = "SELECT * FROM team";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                $idteam = $row['idteam'];
                $name = $row['name'];

                echo "<option value='$idteam'>$name</option>";
            }
        ?>
        </select><br></p>

        <p><label>Achievement</label>
        <input type="text" name="name" required></p>

        <p><label>Date</label>
        <input type="date" name="date" required></p>

        <p><label>Description</label>
        <input type="text" name="description" required></p>
        
        <button type="submit" name="add_achievment">Add Achievement</button>
    </form>
    
</body>
</html>