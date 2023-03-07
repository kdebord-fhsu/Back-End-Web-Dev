
<?php
$dsn = "mysql:host=localhost; dbname=assignment_tracker";
$username = 'root';


try {
$db = new PDO($dsn, $username);

} catch (PDOException) {
$error_message = "Database Error: ";
$error_message .= $e->getMessage();
include('View/error.php')
exit();
}
?>