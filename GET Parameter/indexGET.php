<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GET Parameter-KD</title>
</head>
<body>
    
<?php
//fetching $firstname, $lastname, and $age from the browser's url directly
$firstname=filter_input(INPUT_GET, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
$lastname=filter_input(INPUT_GET, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
$age=filter_input(INPUT_GET, 'age', FILTER_SANITIZE_NUMBER_INT);

//displays the string 
echo "Hello, my name is $firstname $lastname.<br/>";

//displays string based on $age
if($age>=18)
{
echo "I am $age years old and I am old enough to vote in the United States.<br/>";
} else{
echo "I am $age years old and I am not old enough to vote in the United States.<br/>";
}

//calculating number of days from age
$numbofdays = $age  * 365;
echo "Number of days from the age is $numbofdays <br/>";

//displays current date
$date = date('Y-m-d H:i:s');
echo $date;
?>

</body>
</html>