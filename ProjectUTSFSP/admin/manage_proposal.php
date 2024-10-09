<?php
require_once "../service/koneksi.php";


// Query untuk mendapatkan semua join proposal yang statusnya 'waiting'
$sql = "
    SELECT jp.idjoin_proposal, m.fname, m.lname, t.name AS team_name, jp.description, jp.status
    FROM join_proposal jp
    INNER JOIN member m ON jp.idmember = m.idmember
    INNER JOIN team t ON jp.idteam = t.idteam
    WHERE jp.status = 'waiting'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

echo "<table border=1>";
echo "<tr>
            <th>Member Name</th>
            <th>Team Name</th>
            <th>Description</th>
            <th>Status</th>
            <th colspan=2>Action</th>
          </tr>";

// Loop untuk menampilkan semua join proposal
while ($row = $result->fetch_assoc()) {
    $idjoin_proposal = $row['idjoin_proposal'];

    echo "<p>Debug ID: " . htmlspecialchars($idjoin_proposal) . "</p>";
    
    $fullname = $row['fname'] . ' ' . $row['lname'];
    echo "<tr>
                <td>$fullname</td>
                <td>$row[team_name]</td>
                <td>$row[description]</td>
                <td>$row[status]</td>
                <td><a href='lihat_proposal.php?id=$idjoin_proposal'>Lihat Proposal</a></td>
            </tr>";


}

echo "</table><br>";

// Tombol kembali ke dashboard admin
echo "<button><a href='admin_dashboard.php'>Back to Dashboard</a></button>";

define("APP_NAME", "E-Sport - Club e-Sport INFORMATICS");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
</head>

<body>

</body>

</html>