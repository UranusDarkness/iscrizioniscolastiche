<?php

session_start();
include 'Classes.php';

if(isset($_POST["nomefiglio"]) && isset($_POST["cognomefiglio"]) && isset($_POST["scuola"]) && isset($_POST["classe"]) && isset($_POST["indirizzo"]) &&
!empty($_POST["nomefiglio"]) && !empty($_POST["cognomefiglio"]))
{
    if(file_exists("Database_iscrizioni.json"))
    {
        $Iscrizioni = Leggi("Database_iscrizioni.json");
    }
    else
    {
        $Iscrizioni = Array();
    }

    $newIscrizione = new Iscrizione($_POST["nomefiglio"], $_POST["cognomefiglio"], $_POST["scuola"], $_POST["classe"], $_POST["sezione"], $_POST["indirizzo"], (count($Iscrizioni)+1), $_SESSION["idgenitore"]);
    $Iscrizioni[] = $newIscrizione;
    Scrivi($Iscrizioni, "Database_iscrizioni.json");
    echo '<script type="text/javascript">alert("Figlio iscritto");document.location="Homepage.php"</script>'; 
}
?>