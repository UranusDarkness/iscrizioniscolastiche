<?php

session_start();
include 'Classes.php';

if(isset($_SESSION["idgenitore"]) && isset($_SESSION["username"]))
{
    echo '<head><script src="jquery-3.5.1.min.js"></script></head><body align="center"><h1> Area personale di '.$_SESSION["username"].'</h1><a href="logout.php"><button>Logout</button></a><br><br>';
    if(file_exists("Database_iscrizioni.json"))
    {
        $Iscrizioni = Leggi("Database_iscrizioni.json");
        
        $keyIscrizione = CheckIscrizione($_SESSION["idgenitore"]);
        if(count($keyIscrizione) > 0)
        {
            echo '<table border="1" align="center"><td>Nome</td><td>Cognome</td><td>Scuola</td><td>Classe</td><td>Sezione</td><td>Indirizzo</td><td>Stato iscrizione</td>';
            for($i = 0; $i < count($keyIscrizione); $i++)
            {
                echo '<tr><td>'.$Iscrizioni[$keyIscrizione[$i]]->nome.'</td><td>'.$Iscrizioni[$keyIscrizione[$i]]->cognome.'</td><td>'.$Iscrizioni[$keyIscrizione[$i]]->scuola.'</td><td>'.$Iscrizioni[$keyIscrizione[$i]]->classe.'</td><td>'.$Iscrizioni[$keyIscrizione[$i]]->sezione.'</td><td>'.$Iscrizioni[$keyIscrizione[$i]]->indirizzo.'</td><td>Iscritto</td></tr>';
            }
            echo '</table><br><br>';    
        }
        else
        {
            $Scuole = GetSchools("Scuole.json");
            echo 'Nessun figlio iscritto<br><br>';
        }
        FormSubscription();
    }
    else
    {
        $Scuole = GetSchools("Scuole.json");
        echo 'Nessun figlio iscritto<br><br>';

        FormSubscription();

    }
    echo '<br><input type="submit" value="Iscrivi"/></form></body>';

}
else
{
    echo '<html><body align="center"><h1>Highschool</h1><a href="Login.php"><button>Login</button></a><br><a href="Register.php"><button>Register</button></a></body></html>';
}
?>