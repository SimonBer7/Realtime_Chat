
<?php
require 'config.php';

if (!empty($_SESSION["id"])) {
    header("Location: php/index.php");
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    $duplicate = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' OR email = '$email'");

    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script> alert('Username or Email has Already Taken'); </script>";
    } else {
        if ($password == $confirmpassword) {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO user(name, username, email, password) VALUES('$name', '$username', '$email', '$hashedPassword')";
            mysqli_query($conn, $query);
            echo "<script> alert('Registration successful'); </script>";
        } else {
            echo "<script> alert('Password does not match'); </script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Registration</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header class="head">
            <div class="header-content">
                <h1>Chat</h1>
            </div>
        </header>
        <h2>Registration</h2>
        <form class="" action="" method="post" autocomplete="off">
            <label for="name">Name: </label>
            <input type="text" name="name" id="name" required value=""> <br>
            <label for="username">Username: </label>
            <input type="text" name="username" id="username" required value=""> <br>
            <label for="email">Email: </label>
            <input type="text" name="email" id="email" required value=""> <br>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" required value=""> <br>
            <label for="confirmpassword">Confirm Password: </label>
            <input type="password" name="confirmpassword" id="confirmpassword" required value=""> <br>

            <button type="submit" name="submit">Register</button>
        </form>
        <div class="div_but">
            <button id="reg_but" onclick="location.href='login.php'">Login</button>
        </div>


    </body>
</html>
