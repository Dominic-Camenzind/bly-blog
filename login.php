<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrieren</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

<?php 
    include "header.php";
?>



 
<?php
$showFormular = true;
 
if(isset($_GET['register'])) {
    $error = false;
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
  
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }
    if(strlen($vorname) == 0) {
        echo 'Bitte einen Vornamen angeben<br>';
        $error = true;
    }   
    if(strlen($nachname) == 0) {
        echo 'Bitte einen Nachname angeben<br>';
        $error = true;
    }   
    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }
    
    if(!$error) { 
        $statement = $pdo->prepare("SELECT * FROM register WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();
        
        if($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }    
    }
    
    if(!$error) {    
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        $statement = $pdo->prepare("INSERT INTO register (email, vorname, nachname,  passwort) VALUES (:email, :vorname, :nachname, :passwort)");
        $result = $statement->execute(array('email' => $email, 'vorname' => $vorname, 'nachname' => $nachname, 'passwort' => $passwort_hash));
        
        if($result) {        
            echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    } 
}
 
if($showFormular) {
?>
 
<form action="?register=1" method="post">
E-Mail:<br>
<input type="email" size="40" maxlength="250" name="email"><br><br>

Vorname:<br>
<input type="text" size="40"  maxlength="250" name="vorname"><br>

Nachname:<br>
<input type="text" size="40"  maxlength="250" name="nachname"><br><br>
 
Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="passwort"><br>
 
Passwort wiederholen:<br>
<input type="password" size="40" maxlength="250" name="passwort2"><br><br>
 
<input type="submit" value="Abschicken">
</form>
 
<?php
} 
?>
 
</body>
</html>





</body>
</html>



