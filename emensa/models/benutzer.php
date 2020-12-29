<?php
// M5.1.3   | Admin anlegen
function adminanlegen(){
    if(isset($_POST['kennwort'])){
        // Kennwort Datenbank-ready machen
        $salt = "DatenbankenPraktikum";
        $kennwort = htmlspecialchars($_POST['kennwort']);
        $passwort = sha1($salt.$kennwort);
        // Datenbankverbindung aufbauen und Prepared Statement abschicken
        $link = connectdb();
        $passwort =  mysqli_real_escape_string($link, $passwort);
        $statement = mysqli_stmt_init($link);
        mysqli_stmt_prepare($statement, "INSERT INTO benutzer (email,passwort,admin) VALUES ('admin@emensa.example', ?, TRUE)");
        mysqli_stmt_bind_param($statement, 's', $passwort); // adminkennwort
        mysqli_stmt_execute($statement);
        mysqli_close($link);
    }
}
// M.5.1.4  | Anmeldung
function logincheck($user, $code){
    $salt = "DatenbankenPraktikum";
    $dbrpw = sha1($salt.$code);
    $link = connectdb();
    $query = "SELECT count(*) FROM benutzer WHERE email = ? AND passwort = ?";
    if ($stmt = $link->prepare($query))
    {
        $stmt->bind_param("ss", $user, $dbrpw);
        $stmt->execute();
        $stmt->bind_result($count);
        if($stmt->fetch()) {
            return $count > 0;
        }
        $stmt->close();
    }
    mysqli_close($link);
    return false;
}
