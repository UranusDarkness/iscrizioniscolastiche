<?php

include 'Classes.php';

if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["nome"]) && isset($_POST["cognome"]) && 
!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["nome"]) && !empty($_POST["cognome"]))
{
    $registeredUsers = Leggi("Database.json");
    if(file_exists("Database.json"))
    {    
        $Seek = GetIDFromUser($_POST["username"], $_POST["password"]);
        if(!$Seek)
        {
            $newUser = new Genitore($_POST["nome"], $_POST["cognome"], $_POST["username"], $_POST["password"], (count($registeredUsers)+1));
            $registeredUsers[] = $newUser;
            Scrivi($registeredUsers, "Database.json");
            echo '<script type="text/javascript">alert("Registrazione effettuata con successo");document.location="Homepage.php"</script>'; 
        }
        else
        {
            echo '<script type="text/javascript">alert("Utente già registrato");document.location="Homepage.php"</script>';    
        }
    }
    else
    {
        $newUser = new Genitore($_POST["nome"], $_POST["cognome"], $_POST["username"], $_POST["password"], (count($registeredUsers)+1));
        $registeredUsers[] = $newUser;
        Scrivi($registeredUsers, "Database.json");
        echo '<script type="text/javascript">alert("Registrazione effettuata con successo");document.location="Homepage.php"</script>'; 
    }
    
}
?>


<html>
    <body align="center">
        <h1>Insert your data</h1>
        <form method="POST">
        <br>Username <input type="text" name="username"/><br>
            Password <input type="password" name="password"/><br>
            Nome <input type="text" name="nome"/><br>
            Cognome <input type="text" name="cognome"/><br><br>
            <input type="submit" value="Register"/>
        </form>
    </body>
</html>