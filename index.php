<!DOCTYPE html>
<html>
<head>
    <title>To do list</title>
</head>
<body>

<h2>Add tasks</h2>

<form action="add_task.php" method="post">
    <label for="task_name">Tasks name:</label>
    <input type="text" id="task_name" name="task_name" required>
    <input type="submit" value="Add">
</form>
<h2>Add subtasks</h2>

<form action="add_subtask.php" method="post">
    <label for="task_id">Task:</label>
    <select id="task_id" name="task_id" required>
        <?php
        
        $servername = "localhost"; 
        $username = "root"; 
        $password = ""; 
        $dbname = "task0"; 
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection fail: " . $conn->connect_error);
        }

        $sql = "SELECT task_id, task_name FROM tasks";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["task_id"] . "'>" . $row["task_name"] . "</option>";
            }
        }

        $conn->close();
        ?>
    </select>
    <br>
    <label for="subtask_name">Subtask name:</label>
    <input type="text" id="subtask_name" name="subtask_name" required>
    <br>
    <input type="submit" value="Add">
</form>
<h2>Tasks list</h2>

<?php
require_once('connection.php');

if ($conn->connect_error) {
    die("Connection fail: " . $conn->connect_error);
}

$sql = "SELECT task_id, task_name FROM tasks";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Task</th>";
    echo "<th>Subtask</th>";
    echo "<th>Delete</th>";
    echo "</tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["task_name"] . "</td>";
        echo "<td>";
        $task_id = $row["task_id"];
        $subtask_sql = "SELECT subtask_id, subtask_name FROM subtasks WHERE task_id = $task_id";
        $subtask_result = $conn->query($subtask_sql);
        if ($subtask_result->num_rows > 0) {
            while ($subtask_row = $subtask_result->fetch_assoc()) {
                echo $subtask_row["subtask_name"] . " ";
                echo "<a href='delete_subtask.php?subtask_id=" . $subtask_row["subtask_id"] . "'>Delete</a><br>";
            }
        } else {
            echo "Do not have subtaks.";
        }
    
        echo "</td>";
        echo "<td><a href='delete_task.php?task_id=" . $row["task_id"] . "'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Do not have tasks.";
}

$conn->close();
?>

</body>
</html>