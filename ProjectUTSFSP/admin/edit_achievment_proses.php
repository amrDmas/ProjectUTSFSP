<?php 
    require_once "../service/koneksi.php";

    if(isset($_POST['edit_achievement'])){ 
        $idachievment = $_POST['idachievment'];
        $team_name = $_POST['idteam'];
        $achievement_name = $_POST['name'];
        $date = $_POST['date'];
        $description = $_POST['description'];

        echo $idachievment;
        echo $team_name;
        echo $achievement_name;
        echo $date;
        echo $description;


        $sql = "UPDATE achievement SET  idteam=?, name=?, date=?, description=?  WHERE idachievement=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssi", $team_name, $achievement_name, $date, $description, $idachievment);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            echo "Update Sukses";
            echo "ID Achievment : ".$stmt->insert_id;
            header("Location: achievment.php");
        }
        else{
            echo "Update Gagal";
        }
        $conn->close();
    }



?>