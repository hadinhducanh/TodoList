<?php
if (isset($_GET["task_id"])) {
    require_once('connection.php');

    if ($conn->connect_error) {
        die("Connection fail: " . $conn->connect_error);
    }
    $task_id = $_GET["task_id"];
    $sql = "DELETE FROM tasks WHERE task_id = $task_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "ID cannot found.";
}
?>