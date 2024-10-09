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

    $idachievement = $_GET['id'];

    $sql = "SELECT * FROM achievement WHERE idachievement = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idachievement);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // $idteam = $row['idteam'];
        $idteam_selected = $row['idteam'];
        $name = $row['name'];
        $date = $row['date'];
        $description = $row['description'];
    } else {
        die("Game Not Found");
    }


    ?>

    <h1>Edit Game</h1>
    <form method="POST" action="edit_achievment_proses.php">
        <input type="hidden" name="idachievment" value="<?= $idachievement ?>">
        <p><label>Select Team Name:</label>
            <select name="idteam" required>
                <?php
                require_once "../service/koneksi.php";

                $sql = "SELECT * FROM team";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $idteam = $row['idteam'];
                    $team_name = $row['name'];
                    $selected = ($idteam == $idteam_selected) ? "selected" : "";
                    echo "<option value='$idteam' $selected>$team_name</option>";
                }
                $conn->close();
                ?>
            </select><br><br>
        <p><label>Achievement Name:</label>
            <input type="text" name="name" value="<?= $name ?>" required></p>
        <p><label>Achievement Date:</label>
            <input type="date" name="date" value="<?= $date ?>" required></p>
        <p><label>Achievement Description:</label>  
            <textarea name="description" rows="3" required><?= $description ?></textarea></p>
            <input type="submit" name="edit_achievement" value="Edit Achievement">
    </form>
</body>

</html>