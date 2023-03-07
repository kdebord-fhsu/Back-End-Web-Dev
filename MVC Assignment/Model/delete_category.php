<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todolist";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$itemNum = $_GET['itemNum'];

$sql = "DELETE FROM todoitems WHERE ItemNum=$itemNum";
if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error deleting item: " . $conn->error;
}
