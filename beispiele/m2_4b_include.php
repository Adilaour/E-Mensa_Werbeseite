<?php
/**
 * Praktikum DBWT Autoren:
 * Adil, Aouragh, 3203789
 * Alexander, List, 3126569
 */
include 'm2_4a_standardparameter.php';
$summant3 = 100;
$summant4 = 1000;
$summant5 = 10000;
echo addieren($summant4,$summant5).'<br>';
echo addieren(5, $summant3).'<br>';
echo addieren($summant3, 976).'<br>';
$a=0;
while($a<=5){
    echo addieren($a,2)."<br>";
    $a++;
}
echo "<br>Hier enden die Berechnungen aus m2_4b_include.php<br><hr>";