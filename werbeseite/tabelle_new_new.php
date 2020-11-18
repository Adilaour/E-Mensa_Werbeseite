<?php
$link = mysqli_connect("localhost", "root","abc123","emensawerbeseite");
if (!$link) {
    echo "Die Verbindung zur Datenbank ist fehlgeschlagen: ", mysqli_connect_error();
    exit();
}
$sql="SELECT g.name AS Gerichtname, g.preis_intern AS preisintern, g.preis_extern AS preisextern, GROUP_CONCAT(a.code) AS Allergen FROM gericht g, allergen a, gericht_hat_allergen gha WHERE g.id = gha.gericht_id AND a.code = gha.code GROUP BY g.name LIMIT 5;";
$result = mysqli_query($link, $sql);
if(!$result){
    echo "Fehler bei der Abfrage: ", mysqli_error($link);
    exit();
}
while($row = mysqli_fetch_assoc($result)){
    echo '<tr><td><img src="" alt="Speisebild nicht gefunden.">'.'</td><td class="alignleft">'.$row['Gerichtname']." ".$row['Allergen'].'</td><td>'.$row['preisintern'].'</td><td>'.$row['preisextern'].'</td></tr>';
}
mysqli_free_result($result);
mysqli_close($link);