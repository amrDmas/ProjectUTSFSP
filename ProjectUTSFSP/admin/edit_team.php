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

    $idteam = $_GET['id'];

    $sql = "SELECT * FROM team WHERE idteam = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idteam);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // $idteam = $row['idteam'];
        $name = $row['name'];
        $idgame_selected = $row['idgame'];
    } else {
        die("Game Not Found");
    }


    ?>

    <h1>Edit Game</h1>
    <form method="POST" action="edit_team_proses.php">
        <input type="hidden" name="idteam" value="<?= $idteam ?>">
        <p><label>Team Name:</label>
            <input type="text" name="name" value="<?= $name ?>" required><br>
        </p>

        <p><label>Select Game:</label>
            <select name="idgame" required>
                <?php
                require_once "../service/koneksi.php";

                $sql = "SELECT * FROM game";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $idgame = $row['idgame'];
                    $game_name = $row['name'];
                    $selected = ($idgame == $idgame_selected) ? "selected" : "";
                    echo "<option value='$idgame' $selected>$game_name</option>";
                }
                $conn->close();
                ?>
            </select><br><br>
            <input type="submit" name="edit_team" value="Edit Team">
    </form>
</body>

</html>