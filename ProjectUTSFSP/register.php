<?php
require_once "service/koneksi.php";

$register_message = "";

if (isset($_POST['btnregister'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO member (fname, lname, username, password, profile) 
              VALUES ('$fname', '$lname', '$username', '$password', 'member')";

    if ($conn->query($sql)) {
        // header("Location: login.php");
        $register_message = "Daftar akun berhasil, Silahkan Login";
    } else {
        // echo "Error: " . $query . "<br>" . $conn->error;
        $register_message = "Daftar akun gagal, silahkan ulangi kembali";
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
            <header>Sign Up</header>
            <i><?= $register_message ?></i>
            <form action="" method="POST">
                <div class="field input">
                    <label for="fname">First Name : </label>
                    <input type="text" name="fname" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="lname">Last Name : </label>
                    <input type="text" name="lname" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="username">Username : </label>
                    <input type="text" name="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password : </label>
                    <input type="password" name="password"autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" value="REGISTER" name="btnregister" id="register">
                </div>

                <div class="links">
                    Already have an account? <a href="login.php">Sign In</a>
                </div>

            </form>
            <p></p>
        </div>
    </div>

</body>

</html>