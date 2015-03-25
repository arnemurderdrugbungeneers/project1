<?php 

$dbUsername='root';
$dbPassword='root';
$dbName='PHP1_todo';
$conn = new PDO("mysql:host=localhost;dbname={$dbName}", $dbUsername, $dbPassword);

  $query = $conn->prepare('SELECT * FROM opdrachten');
  $query->execute();
  $opdrachten = $query->fetchAll();
  // Als het formulier verzonden is
if($_POST){

  

  // Stap 2: Query schrijven: INSERT INTO
  // Insert into leraren ( voornaam, achternaam,geboortejaar,geslacht,bio,vak_id) VALUES ( ...);

  $query= $conn->prepare('INSERT INTO opdrachten (opdracht,dag) VALUES
   (:opdracht, :dag)');


  // Stap 3: Query uitvoeren met gegevens uit formulier

  $data= [
  'opdracht' => $_POST['opdracht'],
  'dag' => $_POST['dag'],
  ];


  $query->execute($data);

  // Stap 4: Als de query gelukt --> doorsturen naar lijst
  //         anders formulier opnieuw tonen
  // 0 - geen rijen aangepast = false/ niets uitvoeren
  // 1 - rij toegevoegt= true / doorsturen

  if ($query->rowCount()) {
    // doorsturen naar lijst

    header('location: index.php');
  }

}
 ?>


 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
 <head>
 	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"  />
 	<title>Document</title>
 	<link rel="stylesheet" href="css/styler.css" type="text/css" />
 </head>
 <body>

<div id="content">
			<div id="navigation">
				<ul>
					<li><a href="index.php"> Home </a> </li>
					<li><a href="toevoegen.php"> Toevoegen </a></li>
				</ul>	
			</div>
	
			<form action="<?php print htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
			<label for="opdracht"> Specifieer de opdracht</label> <br/>
  			<input type="text" name="opdracht" length="50"/><br/><br/>
  			<label for="dag">Specifieer de dag</label><br/>
  			<input type="text" name="dag"  /><br/><br/>
   			<input type="submit" value="Toevoegen">
  			</form>
</div>
 	
 </body>
 </html>