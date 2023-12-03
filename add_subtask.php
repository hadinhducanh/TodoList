<?php
// Kết nối đến cơ sở dữ liệu
require_once('connection.php');

if ($conn->connect_error) {
    die("Connection fail: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_id = $_POST["task_id"];
    $subtask_name = $_POST["subtask_name"];

    $sql = "INSERT INTO subtasks (task_id, subtask_name) VALUES ('$task_id', '$subtask_name')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>