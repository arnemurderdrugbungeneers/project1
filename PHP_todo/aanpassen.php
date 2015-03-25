<?php 
//connecteren met database
 $dbusername = 'root';
  $dbpasword = 'root';
  $dbname = 'PHP1_todo';
  $conn = new PDO("mysql:host=localhost;dbname={$dbname}", $dbusername, $dbpasword);

  //opdrachten ophalen uit de database
  $query = $conn->prepare('SELECT * FROM opdrachten');
  $query->execute();
  $vakken = $query->fetchAll();


  //Opdrachten opzoeken

  $query = $conn->prepare('SELECT * FROM opdrachten WHERE id=:id');
  $data = ['id' => $_GET['id']];
  $query->execute($data);
  $opdrachten = $query->fetch();

  //verwerken als formulier verzonden is

  if($_POST){

  	$query = $conn->prepare('UPDATE opdrachten SET opdracht=:opdracht, dag=:dag where id=:id');
  	$data = [
  	'opdracht' => $_POST['opdracht'],
  	'dag' => $_POST['dag'],
  	'id' => $_GET['id']
  	];
  	$query->execute($data);

  	if($query->rowcount()){
  		header('location: index.php');
  	}

  }


 ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Leraar aanpassen</title>
  <link rel="stylesheet" href="css/styler.css" type="text/css">
</head>

<div id="content">
      <div id="navigation">
        <ul>
          <li><a href="index.php"> Home </a> </li>
          <li><a href="toevoegen.php"> Toevoegen </a></li>
        </ul> 
      </div>
  
      <form action="<?php print htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$_GET['id'] ?>" method="post">
      <label for="opdracht"> Specifieer de opdracht</label> <br/>
        <input type="text" name="opdracht" value="<?= (isset($opdrachten)) ? $opdrachten['opdracht'] : ' ' ?>"/><br/><br/>
        <label for="dag">Specifieer de dag</label><br/>
        <input type="text" name="dag"  value="<?= (isset($opdrachten)) ? $opdrachten['dag'] : ' ' ?>"/><br/><br/>
        <input type="submit" value="Aanpassen">
        </form>
</div>


</body>
</html>