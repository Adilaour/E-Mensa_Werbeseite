<?php
$gerichtanzahl = 0;
$link = mysqli_connect("localhost", "root","DBwt","emensawerbeseite");

if (!$link) {
    echo "Die Verbindung zur Datenbank ist fehlgeschlagen: ", mysqli_connect_error();
    exit();
}
$wunschgericht_name = $_POST["wunschgericht_name"];
$beschreibung = $_POST["beschreibung"];
$name = $_POST["name"];
$email = $_POST["email"];

$sql = "INSERT INTO wunschgerichte (name, beschreibung, erstellungsdatum, erstellerInnen) VALUE '$wunschgericht_name', '$beschreibung', '$name','$email'";

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title></title>
</head>
<body>

<form action="" method="post">
    <label>Wunschgericht:
        <input type="text" name="wunschgericht_name" id="wunschgericht_name">
    </label>
    <label>Beschreibung:
        <textarea name="beschreibung" id="beschreibung"></textarea>
    </label>
    <label>Name ErstellerIn:
        <input type="text" name="name" id="name">
        <label>E-Mail:
            <input type="email" name="email" id="email">
    </label>
    <input type="submit" value="speichern">
</form>

</body>
</html>
