<?php 
    require_once "../service/koneksi.php";

    if (isset($_POST['add_team_to_event'])) {
        $idevent = $_POST['idevent'];
        $idteam = $_POST['idteam'];

        echo $idevent;
        echo $idteam;
    
        $sql = "INSERT INTO event_teams (idevent, idteam) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $idevent, $idteam);
    
        if ($stmt->execute()) {
            echo "Tim berhasil ditambahkan ke event.";
            header("Location: event_team.php");
        } else {
            echo "Gagal menambahkan tim: " . $stmt->error;
        }
    
        $stmt->close();
        $conn->close();
    }
    
?>