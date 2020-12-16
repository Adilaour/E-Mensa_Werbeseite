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
    $name = trim($_POST["name"]);
    $name = htmlspecialchars($name);
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
    $wunschgericht_name = mysqli_real_escape_string($link, $wunschgericht_name);

    // Statement 1 vorbereiten
    $statement = mysqli_stmt_init($link);
    mysqli_stmt_prepare($statement, "INSERT INTO erstellerInnen (email) VALUES (?)");
    mysqli_stmt_bind_param($statement, 's', $email);
    // Erstellung ErstellerIn
    mysqli_stmt_execute($statement);
    // Abfrage, der soeben erstellen ID
    $idabfrage = mysqli_stmt_init($link);
    mysqli_stmt_prepare($idabfrage, "SELECT erstellerInnen_id FROM erstellerInnen WHERE email = ?");
    mysqli_stmt_bind_param($idabfrage, 's', $email);
    mysqli_stmt_execute($idabfrage);
    mysqli_stmt_bind_result($idabfrage, $erstid);
    mysqli_stmt_fetch($idabfrage);
    mysqli_stmt_close($idabfrage);

    // Statement 2 vorbereiten
    $statement2 = mysqli_stmt_init($link);
    mysqli_stmt_prepare($statement2, "INSERT INTO wunschgerichte ( bezeichnung, beschreibung, erstellungsdatum, erstellerIn) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($statement2, 'sssi', $wunschgericht_name, $beschreibung, $date, $erstid);
    // Erstellung Wunschgericht
    mysqli_stmt_execute($statement2);

    // Nachträgliches Einfügen des Namens
    if($name != ""){
        $statement3 = mysqli_stmt_init($link);
        $name = mysqli_real_escape_string($link, $name);
        mysqli_stmt_prepare($statement3, "UPDATE erstellerInnen SET name = ? WHERE email = ?;");
        mysqli_stmt_bind_param($statement3, 'ss', $name, $email);
        mysqli_stmt_execute($statement3);
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
