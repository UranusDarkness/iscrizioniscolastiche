<?php

session_start();
include 'Classes.php';

if(isset($_POST["username"]) && isset($_POST["password"]) && 
!empty($_POST["username"]) && !empty($_POST["password"]))
{
    $registeredUsers = Leggi("Database.json");
    if(file_exists("Database.json"))
    {     
        $Seek = GetIDFromUser($_POST["username"], $_POST["password"]);
        if(!$Seek)
        {
            echo '<script type="text/javascript">alert("Credenziali errate");document.location="Homepage.php"</script>'; 
        }
        else
        {
            $User = GetUserFromID($Seek);
            $_SESSION["username"] = $User;
            $_SESSION["idgenitore"] = $Seek;
            echo '<script type="text/javascript">alert("Accesso effettuato");document.location="Homepage.php"</script>'; 
        }
    }
    else
    {
        echo '<script type="text/javascript">alert("Nessun utente registrato");document.location="Homepage.php"</script>';
    }
    
}
?>

<html>
    <body align="center">
        <h1>Login</h1>
        <form method="POST">
            <br>Username <input type="text" name="username"/><br>
            Password <input type="password" name="password"/><br><br>
            <input type="submit" value="Login"/>
        </form>
    </body>
</html>