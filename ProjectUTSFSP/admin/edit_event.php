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

        $idevent = $_GET['id'];

        $sql = "SELECT * FROM event WHERE idevent = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idevent);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($row = $result->fetch_assoc()){
            $idevent = $row['idevent'];
            $name = $row['name'];
            $date = $row['date'];
            $description = $row['description'];
        }
        else{
            die("Game Not Found");
        }
        
        $conn->close();
    ?>

    <h1>Edit Event</h1>
    <form method="POST" action="edit_event_proses.php">
        <input type="hidden" name="idevent" value="<?= $idevent ?>">
        <p><label>Name:</label>
        <input type="text" name="name" value="<?= $name ?>" required><br></p>
        <p><label>Date:</label>
        <input type="date" name="date" value="<?= $date ?>" required><br></p>
        <p><label>Description:</label>
        <textarea name="description" required><?= $description ?></textarea><br></p>
        <input type="submit" name="edit_event" value="Edit Event">
    </form>
</body>
</html>