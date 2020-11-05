<?php
/**
 * Praktikum DBWT Autoren:
 * Adil, Aouragh, 3203789
 * Alexander, List, 3126569
 * @param $a
 * @param int $b
 * @return int|mixed
 */

function addieren($a, $b = 0){
    return $a + $b;
}
$summant = 42;
$summant2 = 42;
echo addieren($summant)."<br>";
echo addieren($summant, $summant2)."<br>";
echo addieren(5);
echo "<br>Hier enden die Berechnungen aus m2_4a_standardparameter.php<br><hr>";

