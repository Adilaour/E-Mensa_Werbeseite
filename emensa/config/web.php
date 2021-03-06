<?php
/**
 * Mapping of paths to controlls.
 * Note, that the path only support 1 level of directory depth:
 *     /demo is ok,
 *     /demo/subpage will not work as aspected
 */
return array(
    '/'            => 'HomeController@index',
    '/demo'        => 'DemoController@demo',
    '/dbconnect'   => 'DemoController@dbconnect',

    // Meilenstein 4 | Erstes Beispiel:
    '/m4_6a_queryparameter' => 'ExampleController@m4_6a_queryparameter',
    '/m4_6b_kategorie' => 'ExampleController@m4_6b_kategorie',
    '/m4_6c_gerichte' => 'ExampleController@m4_6c_gerichte',
    '/m4_6d_layout' => 'ExampleController@m4_6d_layout',
    '/m4_6d_page_1' => 'ExampleController@m4_6d_page_1',
    '/m4_6d_page_2' => 'ExampleController@m4_6d_page_2',

    // Meilenstein 5 | Nutzerverwaltung
    '/adminanlegen' => 'LoginController@adminanlegen',
    '/anmeldung' => 'LoginController@anmeldung',
    '/anmeldung_verifizieren' => 'LoginController@anmeldung_verifizieren',
    '/profil' => 'LoginController@profil',
    '/abmeldung' => 'LoginController@abmeldung',

    // Meilenstein 6 | Bewertungen
    '/bewertung' => 'BewertungsController@bewertung',
    '/bewertungen' => 'BewertungsController@bewertungen',
    '/meinebewertungen' => 'BewertungsController@meinebewertungen',
    '/bewertung_loeschen' => 'BewertungsController@bewertung_loeschen',
    '/bewertung_manuell_hervorheben' => 'BewertungsController@bewertung_manuell_hervorheben',
    '/bewertung_manuell_abwaehlen' => 'BewertungsController@bewertung_manuell_abwaehlen',
    '/gericht_hinzufuegen' => 'HomeController@gericht_hinzufuegen',

    // MISC
    '/rechte_fehlen'=>'HomeController@rechte_fehlen',
    '/test' => 'BewertungsController@test'
);