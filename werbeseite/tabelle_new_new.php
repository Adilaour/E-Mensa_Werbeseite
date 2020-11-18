<?php
$link = mysqli_connect("localhost", "root","abc123","emensawerbeseite");
if (!$link) {
    echo "Die Verbindung zur Datenbank ist fehlgeschlagen: ", mysqli_connect_error();
    exit();
}
$sql="SELECT name, preis_intern, preis_extern FROM gericht ORDER BY name LIMIT 5";
$result = mysqli_query($link, $sql);
if(!$result){
    echo "Fehler bei der Abfrage: ", mysqli_error($link);
    exit();
}
while($row = mysqli_fetch_assoc($result)){
    echo '<tr><li><img src="" alt="Speisebild nicht gefunden.">'.'</td><td class="alignleft">'.$row['name'].'</td><td>'.$row['preis_intern'].'</td><td>'.$row['preis_extern'].'</td></tr>';
}
mysqli_free_result($result);
mysqli_close($link);