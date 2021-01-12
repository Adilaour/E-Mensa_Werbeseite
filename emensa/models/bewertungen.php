<?php
function bewertungen_eintragen(){
    $link = connectdb();
    // Werte vorbereiten & ggf. maskieren
    $bemerkung = trim($_POST['bemerkung']);
    $bemerkung = htmlspecialchars($bemerkung);
    if(isset($_POST['wichtig'])){
        $wichtig = 1;
    }else{
        $wichtig = 0;
    }
    $rating =  mysqli_real_escape_string($link, $bemerkung);
    $userid = (int) $_SESSION['nutzerid'];
    $mealid = (int) $_POST['gericht_id'];
    // Statement vorbereiten und ausführen
    $statement = mysqli_stmt_init($link);
    mysqli_stmt_prepare($statement, "INSERT INTO bewertungen (wichtig, sterne, bemerkung, benutzer_id, gericht_id) VALUES (?,?,?,?,?)");
    mysqli_stmt_bind_param($statement, 'iisii', $wichtig,$_POST['sterne'], $rating, $userid, $mealid);
    mysqli_stmt_execute($statement);
    mysqli_close($link);
    // Erfolgsnachricht speichern
    $_SESSION['bewertung_result_message'] = 'Ihre Bewertung wurde gespeichert.';
}
function neuste_bewertungen_abfragen(){
    $link = connectdb();
    $sql= "SELECT gericht_id, sterne, bemerkung, benutzer_id, wichtig, bewertungszeitpunkt FROM bewertungen ORDER BY bewertungszeitpunkt DESC LIMIT 30";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);
    return $data;
}
function meinebewertungen_abfragen(){
    $link = connectdb();
    $sql= "SELECT * FROM bewertungen WHERE benutzer_id = ".$_SESSION['nutzerid']." ORDER BY bewertungszeitpunkt DESC";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);
    return $data;
}
function delete_bewertung($delbewertung_id){
    $link = connectdb();
    $loeschung = mysqli_stmt_init($link);
    $userid = (int) $_SESSION['nutzerid'];
    mysqli_stmt_prepare($loeschung, "DELETE FROM bewertungen WHERE id = ? AND benutzer_id = ?");
    mysqli_stmt_bind_param($loeschung, 'ii', $delbewertung_id, $userid);
    mysqli_stmt_execute($loeschung);
    mysqli_close($link);
    $_SESSION['bewertung_result_message'] = 'Ihre Bewertung wurde gelöscht.';
}