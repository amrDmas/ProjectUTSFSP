<?php
require_once "../service/koneksi.php";

if (isset($_GET['delete'])) {
    $idjoin_proposal = $_GET['delete'];

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Mengambil detail idmember dan idteam dari join_proposal dengan INNER JOIN
        $sql_select = "
            SELECT jp.idmember, jp.idteam
            FROM join_proposal jp
            INNER JOIN member m ON jp.idmember = m.idmember
            INNER JOIN team t ON jp.idteam = t.idteam
            WHERE jp.idjoin_proposal = ?";
        $stmt_select = $conn->prepare($sql_select);
        $stmt_select->bind_param("i", $idjoin_proposal);
        $stmt_select->execute();
        $result_select = $stmt_select->get_result();

        if ($row = $result_select->fetch_assoc()) {
            $idmember = $row['idmember'];
            $idteam = $row['idteam'];

            // Hapus dari tabel join_proposal
            $sql_delete_proposal = "DELETE FROM join_proposal WHERE idjoin_proposal=?";
            $stmt_delete_proposal = $conn->prepare($sql_delete_proposal);
            $stmt_delete_proposal->bind_param("i", $idjoin_proposal);
            $stmt_delete_proposal->execute();

            if ($stmt_delete_proposal->affected_rows === 0) {
                throw new Exception("Proposal not found or already deleted.");
            }
            $stmt_delete_proposal->close();

            // Hapus dari tabel team_members
            $sql_delete_team_member = "DELETE FROM team_members WHERE idmember=? AND idteam=?";
            $stmt_delete_team_member = $conn->prepare($sql_delete_team_member);
            $stmt_delete_team_member->bind_param("ii", $idmember, $idteam);
            $stmt_delete_team_member->execute();

            if ($stmt_delete_team_member->affected_rows === 0) {
                throw new Exception("Member not found in team_members.");
            }
            $stmt_delete_team_member->close();

            // Komit transaksi
            $conn->commit();
            echo "Delete Success";
        } else {
            throw new Exception("Failed to retrieve member and team details.");
        }

        $stmt_select->close();
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollback();
        echo "Delete Failed: " . $e->getMessage();
    }

}


$sql = "
    SELECT jp.idjoin_proposal, m.fname, m.lname, t.name AS team_name, jp.description, jp.status
    FROM join_proposal jp
    JOIN member m ON jp.idmember = m.idmember
    JOIN team t ON jp.idteam = t.idteam";
$result = $conn->query($sql);


echo "<h1>Proposals Team Member</h1>";
echo "<p><a href='manage_proposal.php'>Manage Join Proposals</a></p>";
echo "<table border='1'>
        <tr>
            <th>Member Name</th>
            <th>Team Name</th>
            <th>Description</th>
            <th>Status</th>
            <th colspan='2'>Action</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    $idjoin_proposal = $row['idjoin_proposal']; 
    echo "<tr>
            <td>{$row['fname']} {$row['lname']}</td>
            <td>{$row['team_name']}</td>
            <td>{$row['description']}</td>
            <td>{$row['status']}</td>
            <td><a href='proposal.php?delete=$idjoin_proposal' onclick=\"return confirm('Are you sure you want to delete this proposal?');\">Delete</a></td>
          </tr>";
}

echo "</table>";

echo "<p><a href='admin_dashboard.php'>Back to Dashboard</a></p>";

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Join Proposals</title>
</head>
<body>
</body>
</html>
