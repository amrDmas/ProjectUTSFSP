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

        if (isset($_GET['id'])) {
            $idjoin_proposal = $_GET['id'];
        } else {
            die("Invalid request. Proposal ID is missing.");
        }

        $sql = "SELECT jp.idjoin_proposal, m.fname, m.lname, t.name AS team_name, jp.description, jp.status
        FROM join_proposal jp
        JOIN member m ON jp.idmember = m.idmember
        JOIN team t ON jp.idteam = t.idteam WHERE idjoin_proposal = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idjoin_proposal);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($row = $result->fetch_assoc()){
            $fullname = $row['fname'] . " " . $row['lname'];
            $team_name = $row['team_name'];
            $description = $row['description'];
            $status = $row['status'];

        }
        else{
            die("Proposal Not Found");
        }
        
        $conn->close();
    ?>

    <h1>Lihat Proposal</h1>
    <form method="POST" action="lihat_proposal_proses.php">
    <input type="hidden" name="idjoin_proposal" value="<?= $idjoin_proposal ?>">
        <p><label>Member Name:</label>
        <input type="text" name="member_name" value="<?= $fullname ?>" readonly><br></p>
        <p><label>Team Name:</label>
        <input type="text" name="team_name" value="<?= $team_name ?>" readonly><br></p>
        <p><label>Description:</label>
        <textarea name="description" readonly><?= $description ?>"</textarea><br></p>
        <p><label>Status:</label>
        <input type="text" name="status" value="<?= $status ?>" readonly><br></p>
        <button type="submit" name="action" value="approve">Approve</button>
        <button type="submit" name="action" value="reject">Reject</button>
    </form>
</body>
</html>