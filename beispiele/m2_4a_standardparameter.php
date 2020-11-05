<?php
/**
 * Praktikum DBWT Autoren:
 * Adil, Aouragh, 3203789
 * Alexander, List, 3126569
 * @param $a
 * @param int $b
 * @return int|mixed
 */
// Rechenfunktion formulieren & $b einen default-Wert geben.
function addieren($a, $b = 0){
    return $a + $b;
}
// Rechengrößen deklarieren
$summant = 42;
$summant2 = 42;
// Random Arten Rechenfunktion aufzurufen (und auszugeben)
echo addieren($summant)."<br>";
echo addieren($summant, $summant2)."<br>";
echo addieren(5);