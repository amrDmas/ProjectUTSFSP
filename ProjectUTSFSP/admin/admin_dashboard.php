<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
        }
        .sidebar {
            width: 200px;
            background-color: #f0ad4e;
            padding: 15px;
            height: 100vh;
        }
        .sidebar ul {
            list-style-type: none;
        }
        .sidebar ul li {
            margin: 15px 0;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: black;
            font-size: 18px;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }
        .sidebar ul li a:hover {
            background-color: #ffdd88;
            color: white;
        }
        .content {
            flex-grow: 1;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Menu</h2>
        <ul>
            <li><a href="#" onclick="loadContent('game.php')">Game</a></li>
            <li><a href="#" onclick="loadContent('event.php')">Event</a></li>
            <li><a href="#" onclick="loadContent('event_team.php')">Event-Team</a></li>
            <li><a href="#" onclick="loadContent('team.php')">Team</a></li>
            <li><a href="#" onclick="loadContent('team_member.php')">Team-Member</a></li>
            <li><a href="#" onclick="loadContent('proposal.php')">Proposal</a></li>
            <li><a href="#" onclick="loadContent('achievment.php')">Achievement</a></li>
            <li><a href="#" onclick="loadContent('logout.php')">Logout</a></li>
        </ul>
    </div>

    <div class="content" id="content-area">
        <h1>Admin Dashboard</h1>
        <p>Selamat Datang admin</p>
    </div>

    <script>
        function loadContent(page) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', page, true);
            xhr.onload = function () {
                if (xhr.status == 200) {
                    document.getElementById('content-area').innerHTML = xhr.responseText;
                } else {
                    document.getElementById('content-area').innerHTML = '<h1>Page not found</h1>';
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>
