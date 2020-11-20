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

<div class="container">
    <div class="name">
        <textarea class="name1" type="text" id="message" name="message">Name</textarea>
    </div>
    <div class="content">
        <textarea class="content1" type="text" id="message" name="message">Content</textarea>
    </div>
    <input class="post" type="submit" value="Posten">
</div>

<?php 
    $user = 'root';
    $password = '';
    
    $pdo = new PDO('mysql:host=localhost;dbname=blog', $user, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ]);

    $count = $pdo->exec("INSERT INTO `posts` (content) VALUES ('Geschirr abwaschen')");
    
    $stmt = $pdo->query('SELECT * FROM `posts`');
    foreach($stmt->fetchAll() as $x) {
    }

    echo '<ul>';
    foreach ($x as $y)
    {
        echo '<li>' . $y . '</li>';
    }


?>

</body>
</html>