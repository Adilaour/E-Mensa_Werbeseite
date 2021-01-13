<?php
require_once('../models/gericht.php');
require_once('../models/bewertungen.php');

/* Datei: controllers/HomeController.php */
class HomeController
{
    public function index(RequestData $request) {
        $ausgabe = bewertungen_startseite();
        $bewertungen = $ausgabe[0];
        $speisenamen = $ausgabe[1];



        logger()->info('Home besucht');
        return view('home', ['rd' => $request, 'title' => 'Home', 'bewertungen' => $bewertungen, 'speisenamen'=>$speisenamen, 'i' => 0]);
    }
    public function rechte_fehlen(RequestData $request){
        logger()->warning('Es wurde versucht nicht vorhandene Rechte zu verwenden.');
        return view('rechte_fehlen', ['rd' => $request, 'title' => 'Ihnen fehlen die erforderlichen Rechte']);
    }
}