<?php

require 'config.php';  

if (empty($_SESSION["id"])) {
    // Return an error or handle unauthorized access
    http_response_code(401); // Unauthorized
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['message'])) {
        $message = $_POST['message'];
        $username = $_POST['username'];
        $id = $_SESSION["id"];
        $result = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
        $row = mysqli_fetch_assoc($result);
        

        // Process and store the message in the database
        // You should use prepared statements to prevent SQL injection
        mysqli_query($conn, "INSERT INTO chat_messages (user_name, message) VALUES ('$username', '$message')");

        exit();
    }
}

// Get messages from the database in ascending order based on id
$result = mysqli_query($conn, "SELECT * FROM chat_messages ORDER BY id ASC LIMIT 10");
$messages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row['user_name'] . ': ' . $row['message'];
}
echo implode("<br>", $messages);

// Endpoint to get all messages from all chat rooms
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['all_messages'])) {
    $result = mysqli_query($conn, "SELECT * FROM chat_messages ORDER BY id ASC");
    $messages = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = $row['user_name'] . ': ' . $row['message'];
    }
    echo implode("<br>", $messages);
    exit();
}

// Endpoint to get all messages from a selected user
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user_messages'])) {
    $userId = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM chat_messages WHERE id = $userId ORDER BY id ASC");
    $messages = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = $row['user_name'] . ': ' . $row['message'];
    }
    echo implode("<br>", $messages);
    exit();
}


// Endpoint to get all messages containing a specific word
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search_word'])) {
    $searchWord = mysqli_real_escape_string($conn, $_GET['search_word']);
    $result = mysqli_query($conn, "SELECT * FROM chat_messages WHERE message LIKE '%$searchWord%' ORDER BY id ASC");
    $messages = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = $row['user_name'] . ': ' . $row['message'];
    }
    echo implode("<br>", $messages);
    exit();
}

?>

