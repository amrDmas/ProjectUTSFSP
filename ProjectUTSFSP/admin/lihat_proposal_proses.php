<?php
require_once "../service/koneksi.php";

if (isset($_POST['action'])) {
    $idjoin_proposal = $_POST['idjoin_proposal'];
    $status = $_POST['status'];
    $action = $_POST['action'];

        if ($action === 'approve') {
            $status = 'approved';

            // Mengambil detail join_proposal berdasarkan idjoin_proposal
            $sql = "SELECT * FROM join_proposal WHERE idjoin_proposal = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idjoin_proposal);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                $idmember = $row['idmember'];
                $idteam = $row['idteam'];
                $description = $row['description'];

                // Periksa apakah tim tersebut ada sebelum menambahkan anggota
                $sql_check = "SELECT idteam FROM team WHERE idteam = ?";
                $stmt_check = $conn->prepare($sql_check);
                $stmt_check->bind_param("i", $idteam);
                $stmt_check->execute();
                $stmt_check->store_result();

                if ($stmt_check->num_rows > 0) {
                    // Insert ke tabel team_members
                    $sql2 = "INSERT INTO team_members(idteam, idmember, description) VALUES (?, ?, ?)";
                    $stmt2 = $conn->prepare($sql2);
                    $stmt2->bind_param("iis", $idteam, $idmember, $description);

                    try {
                        $stmt2->execute();
                        if ($stmt2->affected_rows > 0) {
                            echo "Member has been approved and added to the team.";
                        } else {
                            echo "Error adding member to the team.";
                        }
                    } catch (mysqli_sql_exception $e) {
                        if ($e->getCode() == 1062) { // Duplicate entry
                            echo "This member is already part of the team.";
                        } else {
                            echo "Error: " . $e->getMessage();
                        }
                        // Exit to prevent further execution
                        exit();
                    }
                    $stmt2->close();
                } else {
                    echo "The selected team does not exist. Cannot add member to the team.";
                    // Exit to prevent further execution
                    exit();
                }
            $stmt_check->close();
        } else {
            echo "Proposal not found.";
            // Exit to prevent further execution
            exit();
        }
    } elseif ($action === 'reject') {
        $status = 'rejected';
    } else {
        die("Invalid action");
    }

    // Update status join_proposal only if no errors occurred above
    $sql = "UPDATE join_proposal SET status = ? WHERE idjoin_proposal = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $idjoin_proposal);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        if ($action === 'approve') {
            header("Location: proposal.php");
        } else {
            header("Location: lihat_proposal.php");
        }
        exit();
    } else {
        echo "Error updating proposal.";
    }

    $stmt->close();
    $conn->close();
}
?>
