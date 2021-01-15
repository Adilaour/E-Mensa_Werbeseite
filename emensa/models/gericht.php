<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */
function db_gericht_select_all() {
    $link = connectdb();

    $sql = "SELECT id, name, beschreibung, preis_intern FROM gericht WHERE preis_intern >= 2 ORDER BY name";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}
// M6.2.4
function gerichtname_by_id($gericht_id){
    $link = connectdb();
    $sql= "SELECT name AS Gerichtname, bildname AS Bildname FROM gericht WHERE id = "."$gericht_id";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);
    return $data;
}
// M6.3
use Illuminate\Database\Eloquent\Model;
class gerichtAR extends Model
{
    public $table = 'gericht';
    public $primaryKey = 'id';
    public $timestamps = false;
}
function gerichtname_by_id_ar($gericht_id){
    $result = gerichtAR::query()->find($gericht_id);
    return $result;
}
function lieblingsspeise(){
    $favmeal = gerichtAR::query()->find(rand(1,21));
    return $favmeal;
}


