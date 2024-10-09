<?php 
    require_once "../service/koneksi.php";

    if(isset($_POST['edit_team'])){ 
        $idteam = $_POST['idteam'];
        $idgame = $_POST['idgame'];
        $team_name = $_POST['name'];
        

        $sql = "UPDATE team SET  idgame=?, name=?  WHERE idteam=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isi", $idgame,$team_name,$idteam);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            echo "Update Sukses";
            echo "ID Team : ".$stmt->insert_id;
            header("Location: team.php");
        }
        else{
            echo "Update Gagal";
        }
        $conn->close();
    }



?>