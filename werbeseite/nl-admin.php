<?php
/**
 * Praktikum DBWT Autoren:
 * Adil, Aouragh, 3203789
 * Alexander, List, 3126569
 */
const GET_PARAM_SORTIERUNG = 'sortierung';
const GET_PARAM_SUCHTEXT = 'suche';
$zaehler = 1;
$ganzedatei = file("emails.txt");
$sortierarray = [];
$sortierarray2 = [];
$suchergebnis = [];
// Sortiereinstellung abfragen bzw. festlegen
if(empty($_GET[GET_PARAM_SORTIERUNG])){
    $sortafter = "standard";
} elseif($_GET[GET_PARAM_SORTIERUNG]=='Name'){
    $sortafter = "Name";
}elseif ($_GET[GET_PARAM_SORTIERUNG]=='Mail'){
    $sortafter = "Mail";
}
// Sortierung durchführen
if($sortafter=='Name'){
    // Sortierung nach Namen direkt durchführbar
    foreach($ganzedatei as $zeile){
        $zeilenarray = explode(" | ", $zeile);
        array_push($sortierarray, $zeilenarray);
    }
    sort($sortierarray);
}elseif($sortafter=='Mail'){
    // Mail & Name tauschen den Platz im Array. So können wir einfach sort() verwenden! Dann wieder zurücktauschen!
    foreach($ganzedatei as $zeile){
        $zeilenarray = explode(" | ", $zeile);
        $platzhalter = $zeilenarray[0];
        $zeilenarray[0] = $zeilenarray[1];
        $zeilenarray[1] = $platzhalter;
        array_push($sortierarray, $zeilenarray);
    }
    // Sortierung mit sort()
    sort($sortierarray);
    // Zurücktauschen von Mail und Name innerhalb des Arrays
    foreach($sortierarray as $zeile){
        $mailhalter = $zeile[0];
        $zeile[0] = $zeile[1];
        $zeile[1] = $mailhalter;
        array_push($sortierarray2, $zeile);
    }
    $sortierarray = $sortierarray2;
} else {
    // Keine Sortierung durchführen, aber Array erstellen (Reihenfolge aus der Datei)
    foreach($ganzedatei as $zeile){
        $zeilenarray = explode(" | ", $zeile);
        array_push($sortierarray, $zeilenarray);
    }
}
// Suchtext in allen Array suchen und ggf. zu Ausgabe suchen hinzufügen
if(!empty($_GET[GET_PARAM_SUCHTEXT])){
    $suchanfrage = $_GET[GET_PARAM_SUCHTEXT];
    // Schleifenweise Abfrage durch strpos() macht Abfrage wieder case-insensitive
    foreach($sortierarray as $zeile){
        if(strpos(strtolower($zeile[0]),strtolower($suchanfrage)) !== false){
            array_push($suchergebnis, $zeile);
        }
    }
    $sortierarray = $suchergebnis;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter Admin Page</title>
    <style>
        body{
            display:grid;
            grid-template-columns: 1fr 1fr 3fr;
            grid-template-rows: auto 1fr;
        }
        form{
            grid-column: 1 / span 2;
            display: grid;
            grid-template-columns: repeat(2, auto);
        }
        table{
            grid-row-start: 2;
            grid-column: 1 / span 2;

        }
    </style>
</head>
<body>
<!--Such- und Sortierformular-->
<form action="nl-admin.php" method="get">
    <label for="sortierung">
        <select id="sortierung" name="sortierung" size="1">
            <option>Name</option>
            <option>Mail</option>
        </select>
        <button>Sortieren</button>
    </label>
    <label for="suche">
        <!--Logik zur Speicherung der Suchanfrage-->
        <?php
        if(!empty($_GET[GET_PARAM_SUCHTEXT])){
            $suchanfrage = $_GET[GET_PARAM_SUCHTEXT];
            echo '<input id="suche" type="text" name="suche"'."value=\"".htmlspecialchars($suchanfrage)."\"".">";
        } else{
            echo '<input id="suche" type="text" name="suche">';
        }?>
        <button>Suchen</button>
    </label>
</form>
<table>
    <tr>
        <th>Name</th>
        <th>Mail</th>
        <th>Sprache</th>
        <th>Datenschutz</th>
    </tr>
    <!--Ausgabe der Arrayinhalte-->
    <?php
    foreach($sortierarray as $zeile){
        echo "<tr>
                    <td>$zeile[0]</td>
                    <td>$zeile[1]</td>
                    <td>$zeile[2]</td>
                    <td>$zeile[3]</td>
                  </tr>";
    }
    ?>
</table>
</body>
</html>
