<?php 
    require_once "../service/koneksi.php";

    if(isset($_POST['edit_event'])){ 
        $idevent = $_POST['idevent'];
        $name = $_POST['name'];
        $date = $_POST['date'];
        $description = $_POST['description'];
        $sql = "UPDATE event SET name=?, date=?, description=? WHERE idevent=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $date, $description, $idevent);
        $stmt->execute();

        if($stmt){
            echo "Update Sukses";
            echo "ID Event : ".$stmt->insert_id;
            header("Location: event.php");
        }
        else{
            echo "Update Gagal";
        }
        $conn->close(); 
    }



?>