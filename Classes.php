<?php
Class Genitore
{
    public $nome;
    public $cognome;
    public $username;
    public $password;
    public $id_genitore;

    public function __construct($n, $c, $u, $p, $id)
    {
        $this->nome = $n;
        $this->cognome = $c;
        $this->username = $u;
        $this->password = $p;
        $this->id_genitore = $id;
    }
}

Class Iscrizione
{
    public $nome;
    public $cognome;
    public $scuola;
    public $classe;
    public $sezione;
    public $indirizzo;
    public $id_figlio;
    public $id_genitore;

    public function __construct($n, $c, $s, $cl, $se, $i, $idf, $idg)
    {
        $this->nome = $n;
        $this->cognome = $c;
        $this->scuola = $s;
        $this->classe = $cl;
        $this->sezione = $se;
        $this->indirizzo = $i;
        $this->id_figlio = $idf;
        $this->id_genitore = $idg;
    }
}

function Leggi($path)
{
    if(file_exists("Database.json"))
    {
        return json_decode(file_get_contents($path));
    }
    else
    {
        return Array();
    }
}

function Scrivi($dati, $path)
{
    file_put_contents($path, json_encode($dati));
}

function GetIDFromUser($user, $pass)
{
    $dati = Leggi("Database.json");

    for($i = 0; $i < count($dati); $i++)
    {
        if($dati[$i]->username == $user && $dati[$i]->password == $pass)
        {
            return $dati[$i]->id_genitore;
        }
    }
    return false;

}

function GetUserFromID($id)
{
    $dati = Leggi("Database.json");

    for($i = 0; $i < count($dati); $i++)
    {
        if($dati[$i]->id_genitore == $id)
        {
            return $dati[$i]->username;
        }
    }
    return false;

}

function CheckIscrizione($id_genitore)
{
    $Figli = Array();
    $Iscrizioni = Leggi("Database_iscrizioni.json");
    for($i = 0; $i < count($Iscrizioni); $i++)
    {
        if($Iscrizioni[$i]->id_genitore == $id_genitore)
        {
            $Figli[] = $i;
        }
    }
    return $Figli;
}

function GetSchools($path)
{
    return json_decode(file_get_contents($path));
}

function FormSubscription()
{
    $Scuole = Leggi("Scuole.json");
    echo '<h3>Registra un figlio</h3><form method="POST" action="iscrivifiglio.php"><br>Nome <input type="text" name="nomefiglio"/><br>Cognome <input type="text" name="cognomefiglio"/><br>Scuola ';
    echo '<select id="scuola" name="scuola">';
        echo "<option value=''>seleziona una scuola</option>";
        for($i = 0; $i<count($Scuole); $i++)
        {
            echo "<option value='".$Scuole[$i]->nome."'>".$Scuole[$i]->nome."</option>";
        }
    echo '</select><br>';

    echo 'Classe <select name="classe">';
    echo "<option value=''>seleziona un anno</option>";
            for($j = 0; $j < 5; $j++)
            {
                echo "<option value='".($j+1)."'>".($j+1)."</option>";
            }
    echo '</select><br>';

    echo 'Sezione <select name="sezione">';
    $sezioni = ["A", "B", "C", "D"];
    echo "<option value=''>seleziona una sezione</option>";
            for($j = 0; $j < count($sezioni); $j++)
            {
                echo "<option value='".$sezioni[$j]."'>".$sezioni[$j]."</option>";
            }
    echo '</select><br>';

    echo 'Indirizzo <select id="indirizzo" name="indirizzo"><option value="">seleziona un indirizzo</option></select><br>';

    echo '<script type="text/javascript">';
        echo '$(document).ready(function() {
            $("#scuola").change(function() {
                var val = $(this).val();';
                for($i = 0; $i < count($Scuole); $i++)
                {
                    echo 'if (val == "'.$Scuole[$i]->nome.'") {
                        $("#indirizzo").html("';
                    for($j = 0; $j < count($Scuole[$i]->indirizzo); $j++)
                    {
                        echo "<option value='".$Scuole[$i]->indirizzo[$j]->tagindirizzo."'>".$Scuole[$i]->indirizzo[$j]->tagindirizzo."</option>";
                    }
                echo '");}';
                }                               
            echo '});
        });';
        echo '</script>';
}
?>