<?php
require_once "service/koneksi.php";

session_start();

$login_message = "";

if (isset($_POST['btnlogin'])) {
    $username = $_POST['txtusername'];
    $password = $_POST['txtpassword'];

    $sql = "SELECT * FROM member WHERE username=? AND password=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['idmember'] = $row['idmember'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['profile'] = $row['profile'];
        $_SESSION['is_login'] = true;

        if ($row['profile'] == "admin") {
            header("Location: admin/admin_dashboard.php");
        } else {
            header("Location: member/member_dashboard.php");
        }
    } else {
        $login_message = "akun tidak ditemukan";
    }
}

$conn->close();


define("APP_NAME", "E-Sport - Club e-Sport INFORMATICS")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title><?= APP_NAME ?></title>
</head>

<body>
    <div class="container">
        <div class="box form-box">
            <header>Login</header>
            <i><?= $login_message ?></i>
            <form action="login.php" method="POST">
                <div class="field input">
                    <label for="username">Username : </label>
                    <input type="text" name="txtusername" id="username" required>
                </div>

                <div class="field input">
                    <label for="password">Password : </label>
                    <input type="password" name="txtpassword" id="password" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" value="LOGIN" name="btnlogin" id="login">
                </div>

                <div class="links">
                    Don't have an account? <a href="register.php">Sign Up Now</a>
                </div>

            </form>
            <p></p>
        </div>
    </div>

</body>

</html>