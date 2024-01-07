
<?php
require 'config.php';

if (!empty($_SESSION["id"])) {
    header("Location: index.php");
}

if (isset($_POST["submit"])) {
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$usernameemail' OR email = '$usernameemail'");
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        if (password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: index.php");
        } else {
            echo "<script> alert('Wrong password'); </script>";
        }
    } else {
        echo "<script> alert('User not registered'); </script>";
    }
}
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="../static/style.css">
    </head>
    <body>
        <header class="head">
            <div class="header-content">
                <h1>Chat</h1>
            </div>
        </header>
        <div class="registration-container">
            <h2>Login</h2>
        </div>
        <form class="" action="" method="post" autocomplete="off">
            <label for="usernameemail">Username or email: </label>
            <input type="text" name="usernameemail" id="usernameemail" required value=""> <br>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" required value=""> <br>

            <button type="submit" name="submit">Login</button>
        </form>
        <div class="div_but">
            <button id="reg_but" onclick="location.href='registration.php'">Registration</button>
        </div>
    </body>
</html>
