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
    protected $primaryKey = 'id';
    protected $table = 'gericht';
    public $timestamps = false;

    protected $attributes = [];

    // M6.3.5
    function get_preisIntern() {
        return number_format($this->attributes['preis_intern'], 2, ',', '.')." &euro;";
    }
    function get_preis_extern() {
        return number_format($this->attributes['preis_extern'], 2, ',', '.')." &euro;";
    }

    // M6.3.6
    function set_vegan($value)
    {
        $value = str_replace(' ', '', strtolower(trim($value)));
        if ($value == 'yes' || $value == 'ja') {
            $this->attributes['vegan'] = true;
        } else if ($value == 'no' || $value == 'nein') {
            $this->attributes['vegan'] = false;
        }
    }

    function set_vegetarisch($value)
    {
        $value = str_replace(' ', '', strtolower(trim($value)));
        if ($value == 'yes' || $value == 'ja') {
            $this->attributes['vegetarisch'] = true;
        } else if ($value == 'no' || $value == 'nein') {
            $this->attributes['vegetarisch'] = false;
        }
    }


}
function gerichtname_by_id_ar($gericht_id){
    $result = gerichtAR::query()->find($gericht_id);
    return $result;
}
// M6.3.4
function lieblingsspeise(){
    $favmeal = gerichtAR::query()->find(rand(1,21));
    return $favmeal;
}
function db_gericht_select_all_ar(){
    $data = gerichtAR::select('id','name','beschreibung', 'preis_intern')->where('preis_intern','>=', 2)->orderBy('name')->get();
    return $data;
}
function meals_home(){

    $homemeals = gerichtAR::query() ->selectraw('g.id AS Gerichtid, g.name AS Gerichtname, g.preis_intern AS preisintern, g.preis_extern AS preisextern, GROUP_CONCAT(a.code) AS Allergen, g.bildname AS Gerichtbild FROM gericht g, allergen a, gericht_hat_allergen gha')
        ->where('gericht(id) = gericht_hat_allergen(gericht_id) AND allergen(code) = gericht_hat_allergen(code)')
        ->groupBy('gericht(name)')
        ->limit(5)
        ->get();


    return $homemeals;
}
function allergene_home(){

    $homeallergene = gerichtAR::query() -> select("SELECT DISTINCT a.name AS Allergene, a.code AS Allergencode FROM allergen a, gericht g, gericht_hat_allergen gha WHERE g.id = gha.gericht_id AND a.code = gha.code")->get();


    return $homeallergene;
}


