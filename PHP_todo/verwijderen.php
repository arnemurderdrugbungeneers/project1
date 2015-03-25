<?php 

$dbusername = 'root'; $dbpassword = 'root' ; $dbname = 'PHP1_todo';
$conn = new PDO("mysql:host=localhost;dbname={$dbname}", $dbusername, $dbpassword);

//Query schrijven

$query= $conn->prepare('DELETE FROM opdrachten where id=:id');

//Query uitvoeren

$data = [
'id'=> $_GET['id']
];
$query->execute($data);

// Gegevens opvagen uit de query

header('location:index.php');

?>