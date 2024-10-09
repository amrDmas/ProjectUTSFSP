<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        require_once "../service/koneksi.php";

        $idgame = $_GET['id'];

        $sql = "SELECT * FROM game WHERE idgame = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idgame);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($row = $result->fetch_assoc()){
            $idgame = $row['idgame'];
            $name = $row['name'];
            $description = $row['description'];
        }
        else{
            die("Game Not Found");
        }
        
        $conn->close();
    ?>

    <h1>Edit Game</h1>
    <form method="POST" action="edit_game_proses.php">
        <input type="hidden" name="idgame" value="<?= $idgame ?>">
        <p><label>Name:</label>
        <input type="text" name="name" value="<?= $name ?>" required><br></p>
        <p><label>Description:</label>
        <textarea name="description" required><?= $description ?></textarea><br></p>
        <input type="submit" name="edit_game" value="Edit Game">
    </form>
</body>
</html>