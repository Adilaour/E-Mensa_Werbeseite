<?php
/**
 * Praktikum DBWT Autoren:
 * Adil, Aouragh, 3203789
 * Alexander, List, 3126569
 */
// Rechenfunktion, die auf den geklickten Button guckt & dementsprechend rechnet, definieren.
function berechnen($a, $b, $c){
    $result = "Solange nichts gerechnet wird, steht hier auch nichts.";
    if($c == 'addieren'){
        $result=(int)$a +(int)$b;
    }else if($c=='multiplizieren'){
        $result=(int)$a*(int)$b;
    }
    return $result;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>Rechenspaß</title>
</head>
<body>
<h1>Addieren & Multiplizieren</h1>
<form method="post">
    <!-- Zahlen im Formular abfragen und Werte über das name-Attribut mit POST übermitteln. -->
    <label for="zahl1">Erste Zahl:</label>
    <input id="zahl1" type="number" name="a">
    <br>
    <label for="zahl2">Zweite Zahl:</label>
    <input id="zahl2" type="number" name="b">
    <br>
    <!-- Button können gleichen name-Attribut haben. Value wird mitgegeben und in PHP ausgewertet. -->
    <input type="submit" value="addieren" name="button">
    <input type="submit" value="multiplizieren" name="button">
</form>
<br><br>
<?php
// Zurück in den PHP-Modus und Berechnung ausführen. ABER: Nur wenn das Formular bereits ausgefüllt wurde (isset-Funktion) und nicht schon bei Aufruf der Seite.
if(isset($_POST['a']) && isset($_POST['b']) && isset($_POST['button'])) {
    echo "<h2>Das Ergebnis ist: ".berechnen($_POST['a'], $_POST['b'], $_POST['button'])."</h2>";
}
?>
</body>
</html>