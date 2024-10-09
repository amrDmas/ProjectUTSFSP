<?php
require_once("../class/event.php");
$event = new event();

// Fungsi untuk menghapus game berdasarkan idgame
if (isset($_GET["delete"])) {
    $delete = $_GET["delete"];
    if ($event->deleteEvent(idEvent: $delete)) {
        echo "Game deleted successfully.";
    } else {
        echo "Failed to delete game.";
    }
} else {
    $delete = "";
}


// Ambil nilai pencarian dari form jika ada
if (isset($_GET["search"])) {
    $search = $_GET["search"];
} else {
    $search = "";
}


$result = $event->getEvent($search);



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
    <button><a href="add_event.php">Add Event +</a></button><br><br>

    <form action="event.php" method="GET">
        <p>
            <label>Cari Event</label>
            <input type="text" name="search" value="<?= $search ?>">
            <input type="submit" name="submit" value="Search">
        </p>
    </form><br>

    <?php

    //PAGING
    $perpage = 5; // berapa data per halaman yang mau ditampilkan
    $totaldata = $result->num_rows;
    $totalpage = ceil($totaldata / $perpage);

    if (isset($_GET["p"])) {
        $page = $_GET["p"];
    } else {
        $page = 1;
    }

    $start = ($page - 1) * $perpage;

    $result = $event->getEventLimit($search, $start, $perpage);
    //PAGING

    //TAMPILKAN PAGING
    echo "<a href = 'event.php?p=1&search=$search'>First </a>";

    if ($page > 1) {
        $prev = $page - 1;
        echo "<a href = 'event.php?p=$prev&search=$search'>Prev </a>";
    }

    for ($i = 1; $i <= $totalpage; $i++) {
        echo "<a href = 'event.php?p=$i&search=$search'>$i </a>";
    }

    if ($page < $totalpage) {
        $next = $page + 1;
        echo "<a href = 'event.php?p=$next&search=$search'>Next </a>";
    }

    echo "<a href = 'event.php?p=$totalpage&search=$search'>Last </a>";

    echo "<br><br>";

    ?>

    <table border="1">
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Description</th>
            <th colspan="2">Action</th>
        </tr>

        <?php
        // Menampilkan hasil query
        while ($row = $result->fetch_assoc()) {
            $idevent = $row['idevent'];
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['date']}</td>
                    <td>{$row['description']}</td>
                    <td><a href='edit_event.php?id=$idevent'>Edit</a></td>
                    <td><a href='event.php?delete=$idevent' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>
                  </tr>";
        }
        ?>
    </table><br>

    <button><a href="admin_dashboard.php">Back to Dashboard</a></button>
</body>

</html>