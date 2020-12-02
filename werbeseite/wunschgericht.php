<?php
$gerichtanzahl = 0;
$date = date('Y-m-d H:i:s');
// Variablen werden gesetzt
if(isset($_POST["wunschgericht_name"])){
    $wunschgericht_name = htmlspecialchars($_POST["wunschgericht_name"]);
}
if(isset($_POST["beschreibung"])){
    $beschreibung = htmlspecialchars($_POST["beschreibung"]);
}
if(isset($_POST["name"])){
    $name = htmlspecialchars($_POST["name"]);
} else{
  $name = "Anonym";
}
if(isset($_POST["email"])){
    $email = htmlspecialchars($_POST["email"]);
}
// Datenbank Abfrage
if(isset($_POST["wunschgericht_name"]) && isset($_POST["beschreibung"]) && isset($_POST["email"])){

    // Verbindung zur Datenbank aufbauen und überprüfen
    $link = mysqli_connect("localhost", "root","abc123","emensawerbeseite");
    if (!$link) {
        echo "Die Verbindung zur Datenbank ist fehlgeschlagen: ", mysqli_connect_error();
        exit();
    }
    // Eingabemaskierung
    $email = mysqli_real_escape_string($link, $email);
    $beschreibung = mysqli_real_escape_string($link, $beschreibung);
    $wunschgericht_name= mysqli_real_escape_string($link, $wunschgericht_name);
    $name = mysqli_real_escape_string($link, $name);
    // Statement 1 vorbereiten
    $statement = mysqli_stmt_init($link);
    mysqli_stmt_prepare($statement, "INSERT INTO erstellerInnen (email,name) VALUES (?, ?)");
    mysqli_stmt_bind_param($statement, 'ss', $email, $name);
    // Erstellung ErstellerIn
    mysqli_stmt_execute($statement);
    // Statement 2 vorbereiten
    $statement2 = mysqli_stmt_init($link);
    mysqli_stmt_prepare($statement2, "INSERT INTO wunschgerichte (name, beschreibung, erstellungsdatum, erstellerInnen) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($statement2, 'ssss', $wunschgericht_name, $beschreibung, $date, $email);
    // Erstellung Wunschgericht
    mysqli_stmt_execute($statement2);
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
