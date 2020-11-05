<?php
/**
 * Praktikum DBWT Autoren:
 * Adil, Aouragh, 3203789
 * Alexander, List, 3126569
 */

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
<h1>Rechenspaß: Addieren & Multiplizieren</h1>
<form method="post">
    <label for="summant1">Erster Summant:</label>
    <input id="summant1" type="number" name="a">
    <br>
    <label for="summant2">Zweiter Summant:</label>
    <input id="summant2" type="number" name="b">
    <br>
    <input type="submit" value="addieren" name="button">
    <input type="submit" value="multiplizieren" name="button">
</form>
<br><br>
<?php
if(isset($_POST['a']) && isset($_POST['b']) && isset($_POST['button'])) {
    echo "Das Ergebnis ist: ".berechnen($_POST['a'], $_POST['b'], $_POST['button']);
}
?>
</body>
</html>