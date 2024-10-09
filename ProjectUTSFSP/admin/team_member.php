<?php
require_once "../service/koneksi.php";

// SQL query to get the member and team information
$sql = "SELECT m.fname AS member_firstname, m.lname AS member_lastname, t.name AS team_name,
    jp.description AS proposal_description, jp.status AS proposal_status
FROM team_members tm
INNER JOIN member m ON tm.idmember = m.idmember
INNER JOIN team t ON tm.idteam = t.idteam
INNER JOIN join_proposal jp ON tm.idmember = jp.idmember AND tm.idteam = jp.idteam";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

echo "<table border=1>";
echo "<tr>
                <th>Member Name</th>
                <th>Team Name</th>
                <th>Description</th>
              </tr>";

while ($row = $result->fetch_assoc()) {
    $member_name = $row['member_firstname'] . " " . $row['member_lastname'];
    echo "<tr>
                    <td>$member_name</td>
                    <td>$row[team_name]</td>
                    <td>$row[proposal_description]</td>
            </tr>";
}

echo "</table><br>";

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