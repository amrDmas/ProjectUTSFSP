<?php 
    require_once "../service/koneksi.php";

    if(isset($_POST['add_team'])){
        $team_name = $_POST['name'];
        $idgame = $_POST['idgame'];

        $sql = "INSERT INTO team(name, idgame) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $team_name, $idgame);
        $stmt->execute();

        if ($stmt){
            echo "Add Team Success";
            echo "ID Team : ".$stmt->insert_id;
            header("Location: team.php");
        }
        else{
            echo "Add Team Failed";
        }
    }

?>