<?php
require_once('../models/bewertungen.php');

class BewertungsController
{
    // M6.1.c.1
    public function bewertung(RequestData $request) {
        if(isset($_SESSION['login_ok'])){
            if(isset($_POST['bewertungsform'])){
                // Unnormaler Aufruf der Seite. Formular hat Reload ausgelöst
                // Formularüberprüfung und Maskierung für Datenbank usw. anschließend normal auf Seite weiterleiten
                formcheck();

                $msg = $_SESSION['bewertung_result_message'] ?? null;
                return view('bewertung', ['rd' => $request, 'title' => 'Bewertungen', 'msg'=> $msg ]);
            }else{
                // Normaler Aufruf der Seite
                logger()->info('Bewertung besucht');
                return view('bewertung', ['rd' => $request, 'title' => 'Bewertungen' ]);
            }
        } else {
            logger()->info('Anmeldung besucht');
            return view('anmeldung', ['rd' => $request, 'title' => 'Anmeldung' ] );
        }
    }
}