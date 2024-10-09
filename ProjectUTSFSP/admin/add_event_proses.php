<?php 
    require_once "../service/koneksi.php";

    if(isset($_POST['add_event'])){
        $name = $_POST['name'];
        $date = $_POST['date'];
        $description = $_POST['description'];

        $sql = "INSERT INTO event(name, date, description) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $date, $description);
        $stmt->execute();

        if ($stmt){
            echo "Add Event Success";
            echo "ID Event : ".$stmt->insert_id;
            header("Location: event.php");
        }
        else{
            echo "Add Event Failed";
        }                  
    }

?>