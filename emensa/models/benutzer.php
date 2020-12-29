<?php
function login_success($user){
    // Datenbankeinträge aktualisieren
    $link = connectdb();
    mysqli_begin_transaction($link, MYSQLI_TRANS_START_READ_WRITE);

    $idabfrage = mysqli_prepare($link, "SELECT id FROM benutzer WHERE email = ?");
    mysqli_stmt_bind_param($idabfrage, 's', $user);
    mysqli_stmt_execute($idabfrage);
    mysqli_stmt_bind_result($idabfrage, $userid);
    mysqli_stmt_fetch($idabfrage);
    mysqli_stmt_close($idabfrage);


    $stmt = mysqli_prepare($link, 'CALL anmeldecounter(?);');
    mysqli_stmt_bind_param($stmt, 'i', $userid);
    mysqli_stmt_execute($stmt);

    $stmt2 = mysqli_prepare($link, 'UPDATE benutzer SET letzteanmeldung = current_timestamp() WHERE email = ?');
    mysqli_stmt_bind_param($stmt2, 's', $user);
    mysqli_stmt_execute($stmt2);


    mysqli_commit($link);
    mysqli_close($link);
}
function login_failed($user){
    $link = connectdb();
    mysqli_begin_transaction($link, MYSQLI_TRANS_START_READ_WRITE);

    $stmt3 = mysqli_prepare($link, 'UPDATE benutzer SET letzterfehler = current_timestamp() WHERE email = ?');
    mysqli_stmt_bind_param($stmt3, 's', $user);
    mysqli_stmt_execute($stmt3);

    $stmt4 = mysqli_prepare($link, 'UPDATE benutzer SET anzahlfehler = anzahlfehler +1 WHERE email = ?');
    mysqli_stmt_bind_param($stmt4, 's', $user);
    mysqli_stmt_execute($stmt4);


    mysqli_commit($link);
    mysqli_close($link);

}
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
            mysqli_close($link);
            return $count > 0;
        }
        $stmt->close();

    }

    mysqli_close($link);
    return false;
}

