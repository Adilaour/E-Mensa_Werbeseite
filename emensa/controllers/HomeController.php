<?php
require_once('../models/gericht.php');

/* Datei: controllers/HomeController.php */
class HomeController
{
    public function index(RequestData $request) {


        logger()->info('Home besucht');
        return view('home', ['rd' => $request, 'title' => 'Home' ]);
    }
    public function rechte_fehlen(RequestData $request){
        logger()->warning('Es wurde versucht nicht vorhandene Rechte zu verwenden.');
        return view('rechte_fehlen', ['rd' => $request, 'title' => 'Ihnen fehlen die erforderlichen Rechte']);
    }
}