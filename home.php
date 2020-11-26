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
        <div class="picture">
			<label for="message">Bild URL</label>
			<textarea class="picture1" type="text" id="picture" name="picture"></textarea>
		</div>

		<input class="button" type="submit" value="Speichern">
        </div>
	</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$message = trim($_POST['message'] ?? '');
$name = trim($_POST['name'] ?? '');
$link = trim($_POST['picture'] ?? '');

    //insert into database
    $stmt = $pdo->prepare('INSERT INTO posts (name, content, picture, creation_date) 
        VALUES (:name, :message, :picture,  now())');

    $stmt->execute([':name' => $name, ':message' => $message, ':picture' => $link]);
    $stmt = $pdo->query("SELECT * FROM posts");
    foreach($stmt->fetchAll() as $x)
    {
        echo"<ul class='post'>";
        echo"<div>$x[1]</div>";
        echo"<div>$x[2]</div>";
        echo"<img src=$x[3]>";
        echo"<div>$x[4]</div>";
        echo"</ul><hr>";
    }
}
?>


</body>
</html>