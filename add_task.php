<?php
require_once('connection.php');

if ($conn->connect_error) {
    die("Connection fail: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_name = $_POST["task_name"];

    $sql = "INSERT INTO tasks (task_name) VALUES ('$task_name')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>






