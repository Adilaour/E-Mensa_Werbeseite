<?php

$link=mysqli_connect("localhost",      // Host der Datenbank
    "root",                            // Benutzername zur Anmeldung
    "abc123",                      // Passwort
    "emensawerbeseite"            // Auswahl der Datenbanken (bzw. des Schemas)
// optional port der Datenbank
);
if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}
$sql = "SELECT id, name, beschreibung FROM gericht ORDER BY name LIMIT 5;";
$result = mysqli_query($link,$sql);
if(!$result){
    echo "Fehler bei der Abfrage: ", mysqli_error($link);
    exit();
}
echo '<ul>';
while($row = mysqli_fetch_assoc($result)){
    echo '<li>','<a href="rezept.php?id='.$row['id'].'">',$row['name'],'</a>',' - ',$row['beschreibung'],'</li>';
    // var_dump($row);
}
echo '</ul>';
mysqli_free_result($result);
mysqli_close($link);

$link = mysqli_connect("localhost","root", "DBwt", "emensawerbeseite");
if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}
$sql = "SELECT a.name AS Allergen, GROUP_CONCAT(g.name) AS Gerichtname FROM gericht g LEFT JOIN gericht_hat_allergen gha ON gha.gericht_id = g.id RIGHT JOIN allergen a ON gha.code = a.code GROUP BY a.name;";
$result = mysqli_query($link, $sql);
if(!$result){
    echo "Fehler bei der Abfrage: ", mysqli_error($link);
    exit();
}
echo '<h5>OBEN: Übung</h5><h1>UNTEN: Aufgabe 6</h1>';
echo '<p>Abgabe enthält Liste mit Allergenen und Gerichten</p>';
/*
echo '<ul>';
while($row = mysqli_fetch_assoc($result)){
    echo '<li>'.$row['Allergen'].'<br>'.$row['Gerichtname'].'</li>';
}
echo '</ul>';
*/

echo '<h2>Aufgabe 6 korrigiert, als Tabelle</h2>';
echo '<table><tr><th>Allergen</th><th>Gerichtname</th></tr>';
while($row = mysqli_fetch_assoc($result)){
    echo '<tr><td>'.$row['Allergen'].'</td><td>'.$row['Gerichtname'].'</td></tr>';
}
echo '</table>';

mysqli_free_result($result);
mysqli_close($link);


// connect_example.php
/*
$link = mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "abc123",               // Passwort
    "emensawerbeseite",     // Auswahl der Datenbanken (bzw. des Schemas)
    "3306"                 // optional port der Datenbank
);

if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

$sql = "SELECT id, name, beschreibung FROM gericht";

$result = mysqli_query($link, $sql);
if (!$result) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}

while ($row = mysqli_fetch_assoc($result)) {
    echo '<li>', $row['id'], ':', $row['name'], '</li>';
}

mysqli_free_result($result);
mysqli_close($link);
*/