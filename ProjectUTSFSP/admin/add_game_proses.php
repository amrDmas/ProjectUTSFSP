<?php 
    require_once "../service/koneksi.php";

    if(isset($_POST['add_game'])){
        $name = $_POST['name'];
        $description = $_POST['description'];

        $sql = "INSERT INTO game(name, description) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $name, $description);
        $stmt->execute();

        if ($stmt){
            echo "Add Game Success";
            echo "ID Game : ".$stmt->insert_id;
            header("Location: game.php");
        }
        else{
            echo "Add Game Failed";
        }
    }

?>