<?php 
    require_once "../service/koneksi.php";

    if(isset($_POST['edit_game'])){ 
        $idgame = $_POST['idgame'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $sql = "UPDATE game SET name=?, description=? WHERE idgame=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $description, $idgame);
        $stmt->execute();

        if($stmt){
            echo "Update Sukses";
            echo "ID Game : ".$stmt->insert_id;
            header("Location: game.php");
        }
        else{
            echo "Update Gagal";
        }
        $conn->close();
    }



?>