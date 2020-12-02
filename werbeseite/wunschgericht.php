<?php
$gerichtanzahl = 0;
// Variablen werden gesetzt
if(isset($_POST["wunschgericht_name"])){
    $wunschgericht_name = $_POST["wunschgericht_name"];
}
if(isset($_POST["beschreibung"])){
    $beschreibung = $_POST["beschreibung"];
}
if(isset($_POST["name"])){
    $name = $_POST["name"];
}else{
    $name= "";
}
if(isset($_POST["email"])){
    $email = $_POST["email"];
}

// Datenbank Abfrage
if(isset($_POST["wunschgericht_name"]) && isset($_POST["beschreibung"]) && isset($_POST["email"])){
    // SQL Statement zusammenbasteln
    $sql = "INSERT INTO wunschgerichte (name, beschreibung, erstellungsdatum, erstellerInnen) VALUE '$wunschgericht_name', '$beschreibung', '$name','$email'";









    // Verbindung zur Datenbank aufbauen und überprüfen
    $link = mysqli_connect("localhost", "root","abc123","emensawerbeseite");
    if (!$link) {
        echo "Die Verbindung zur Datenbank ist fehlgeschlagen: ", mysqli_connect_error();
        exit();
    }
    // Datenbank abfragen & Ergebnis prüfen
    $result = mysqli_query($link,$sql);
    if(!$result){
        echo "Fehler bei der Abfrage: ", mysqli_error($link);
        exit();
    }
    // Datenbankverbindung wird geschlossen
    mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>Wunschgericht Formular</title>
</head>
<body>
<form action="wunschgericht.php" method="post">
    <label>Wunschgericht:
        <input type="text" name="wunschgericht_name" id="wunschgericht_name" required>
    </label>
    <label>Beschreibung:
        <textarea name="beschreibung" id="beschreibung" required></textarea>
    </label>
    <label>Name:
        <input type="text" name="name" id="name">
    </label>
    <label>E-Mail:
            <input type="email" name="email" id="email" required>
    </label>
    <input type="submit" value="speichern">
</form>

</body>
</html>
