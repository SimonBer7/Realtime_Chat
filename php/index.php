<?php
require 'config.php';
require 'logger.php';

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
            logError('Wrong password', 'login endpoint');
            echo "<script> alert('Wrong password'); </script>";
        }
    } else {
        logError('User not registered', 'login endpoint');
        echo "<script> alert('User not registered'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Realtime CHAT</title>
    <link rel="stylesheet" href="../static/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<header class="head">
    <div class="header-content">
        <h1>Chat</h1>
        <button id="reg_but" onclick="location.href='logout.php'">Logout</button>
    </div>
</header>
<h2>Welcome <?php echo $row["name"]; ?></h2>

<div id="chat">
    <div id="messages"></div>
    <input type="text" id="messageInput" placeholder="Type your message...">
    <button onclick="sendMessage()">Send</button>
</div>

<script>
    function sendMessage() {
        var message = $('#messageInput').val();
        var username = '<?php echo $row["name"]; ?>';
        $.post('process.php', { message: message, username: username}, function (response) {
            // handle response if needed
        });
        $('#messageInput').val('');
    }

    function getMessages() {
        $.get('process.php', function (data) {
            $('#messages').html(data);
        });
    }

    // Poll for new messages every 2 seconds
    setInterval(getMessages, 2000);
</script>

</body>
</html>
