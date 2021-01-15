<?php
// M6.1.c.1
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
// M6.1.c.6
function neuste_bewertungen_abfragen(){
    $link = connectdb();
    $sql= "SELECT * FROM bewertungen ORDER BY bewertungszeitpunkt DESC LIMIT 30";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);
    return $data;
}
// M6.1.c.7
function meinebewertungen_abfragen(){
    $link = connectdb();
    $sql= "SELECT * FROM bewertungen WHERE benutzer_id = ".$_SESSION['nutzerid']." ORDER BY bewertungszeitpunkt DESC";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);
    return $data;
}
// M6.1.c.8
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
// M6.2.1
function bewertung_hervorheben(){
    $idbewertung = (int) $_GET['bewertung'];
    $link = connectdb();
    $flagging = mysqli_stmt_init($link);
    mysqli_stmt_prepare($flagging, "UPDATE bewertungen SET wichtig = 1 WHERE id = ?");
    mysqli_stmt_bind_param($flagging, 'i',$idbewertung);
    mysqli_stmt_execute($flagging);
    mysqli_close($link);
    $_SESSION['bewertung_result_message'] = 'Bewertung wurde hervorgehoben.';
}
// M6.2.2
function bewertung_abwaehlen(){
    $idbewertung = (int) $_GET['bewertung'];
    $link = connectdb();
    $flagging = mysqli_stmt_init($link);
    mysqli_stmt_prepare($flagging, "UPDATE bewertungen SET wichtig = 0 WHERE id = ?");
    mysqli_stmt_bind_param($flagging, 'i',$idbewertung);
    mysqli_stmt_execute($flagging);
    mysqli_close($link);
    $_SESSION['bewertung_result_message'] = 'Bewertung wurde abgewählt.';
}
// M6.2.3
function bewertungen_startseite(){
    $speisen = [];
    $speisenamen = [];
    $link = connectdb();
    $sql= "SELECT * FROM bewertungen WHERE wichtig = 1 ORDER BY bewertungszeitpunkt DESC LIMIT 10";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);
    foreach($data as $bewertung){
        array_push($speisen, (int) $bewertung[6]);
    }
    foreach($speisen as $speiseid){
        $link2 = connectdb();
        $sql2 = "SELECT name FROM gericht WHERE id = "."$speiseid";
        $result2 = mysqli_query($link2, $sql2);
        $speisename = mysqli_fetch_all($result2, MYSQLI_BOTH);
        array_push($speisenamen, $speisename[0][0]);
    }
    $ausgabe = [];
    array_push($ausgabe, $data);
    array_push($ausgabe, $speisenamen);
    return $ausgabe;
}


// M6.3.

class bewertungAR extends \Illuminate\Database\Eloquent\Model
{
    public $table ='bewertungen';
    public $primaryKey = 'id';
    public $timestamps = false;
}
function pinnedAR(){
    $idbewertung = (int) $_GET['bewertung'];
    $bewertungsresult = bewertungAR::query()->find($idbewertung);
    $bewertungsresult->wichtig = 1;
    $bewertungsresult->save();
}
function unpinnedAR(){
    $idbewertung = (int) $_GET['bewertung'];
    $bewertungsresult = bewertungAR::query()->find($idbewertung);
    $bewertungsresult->wichtig = 0;
    $bewertungsresult->save();
}

function deleteBewerbung($id){
    bewertungAR::destroy($id);
}