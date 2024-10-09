<?php 
    require_once "../service/koneksi.php";

    if(isset($_POST['add_achievment'])){
        $team_name = $_POST['idteam'];
        $achievement_name = $_POST['name'];
        $date = $_POST['date'];
        $description = $_POST['description'];

        $sql = "INSERT INTO achievement(idteam, name, date, description) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $team_name, $achievement_name, $date, $description);
        $stmt->execute();

        if ($stmt){
            echo "Add Achievement Success";
            echo "ID Achievement : ".$stmt->insert_id;
            header("Location: achievment.php");
        }
        else{
            echo "Add Achievement Failed";
        }
    }

?>