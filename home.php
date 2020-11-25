<!DOCTYPE html>
<html>
<head>
    <title>Dominics Blog</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

<?php 
    include "header.php";
?>
    <img src="https://en.wikipedia.org/wiki/Photographic_mosaic#/media/File:Mosaicr_seagull.jpg" alt="test">
<?php 
    $user = 'root';
    $password = '';
    
    $pdo = new PDO('mysql:host=localhost;dbname=blog', $user, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ]);
?>

<form action="home.php" method="POST">

        <div class="container">
		<h3>Neuen Post erstellen</h3>
		
		<div class="name">
			<label for="name">Name</label>
			<input class="name1" type="text" id="name" name="name">
		</div>
		<div class="content">
			<label for="message">Nachricht</label>
			<textarea class="content1" type="text" id="message" name="message"></textarea>
        </div>
        <div class="c">
			<label for="message">Nachricht</label>
			<textarea class="content1" type="text" id="message" name="message"></textarea>
		</div>

		<input class="button" type="submit" value="Speichern">
        </div>
	</form>

<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $message = '';
        $name = '';

        if(isset($_POST['name'])) {
            $name =$_POST['name'];
        }
        if(isset($_POST['message'])) {
            $message = $_POST['message'];
        }
    $count = $pdo->exec("INSERT INTO `posts` (content) VALUES ('$name')");
    $count = $pdo->exec("INSERT INTO `posts` (content) VALUES ('$message')");
 
    $stmt = $pdo->query('SELECT * FROM `posts`'); ?>
    
    <?php
    foreach($stmt->fetchAll() as $x) { ?>

        <div class="container2">
            <h1 class="title"><?= $x['name'] ?></h1>
		    <div class="post"><?= $x['content'] ?></div>
        </div>

    <?php }
    }?>


</body>
</html>