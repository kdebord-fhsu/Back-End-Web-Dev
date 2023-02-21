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

if (isset($_GET['remove'])) {
    $itemNum = $_GET['remove'];
    $sql = "DELETE FROM todoitems WHERE ItemNum=$itemNum";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error deleting item: " . $conn->error;
    }
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $sql = "INSERT INTO todoitems (Title, Description) VALUES ('$title', '$description')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error adding item: " . $conn->error;
    }
}

$sql = "SELECT * FROM todoitems";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
	<title>ToDo List</title>
</head>
<body>
	<h1>ToDo List</h1>

	<?php if ($result->num_rows > 0) : ?>
		<ul>
			<?php while ($row = $result->fetch_assoc()) : ?>
				<li>
					<?= $row['Title'] ?> - <?= $row['Description'] ?>
					<form method="POST" action="">
						<input type="hidden" name="remove" value="<?= $row['ItemNum'] ?>">
						<button type="submit">Remove</button>
					</form>
				</li>
			<?php endwhile; ?>
		</ul>
	<?php else : ?>
		<p>No to-do list items exist yet.</p>
	<?php endif; ?>

	<h2>Add Item</h2>
	<form method="POST" action="">
		<label for="title">Title:</label>
		<input type="text" id="title" name="title">
		<label for="description">Description:</label>
		<input type="text" id="description" name="description">
		<button type="submit" name="submit">Add</button>
	</form>

	<?php $conn->close(); ?>
</body>
</html>
