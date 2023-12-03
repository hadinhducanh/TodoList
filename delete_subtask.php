<?php

if (isset($_GET["subtask_id"])) {

    require_once('connection.php');

    if ($conn->connect_error) {
        die("Connection fail: " . $conn->connect_error);
    }

   
    $subtask_id = $_GET["subtask_id"];

   
    $sql = "DELETE FROM subtasks WHERE subtask_id = $subtask_id";

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