<?php
require_once('../models/bewertungen.php');
require_once('../models/gericht.php');

class BewertungsController
{
    // M6.1.c.1
    public function bewertung(RequestData $request) {
        if(isset($_SESSION['login_ok'])){
            if(isset($_GET['gericht_id'])){
            $preset_mealid = (int) $_GET['gericht_id'];
            } else{
                $preset_mealid = null;
            }

            if($preset_mealid!= null){
                $data = gerichtname_by_id($preset_mealid);
            }
            $data = $data[0] ?? null;
            // Weiterleitung zu Bewertung-Seite, da Nutzer eingeloggt ist. Prüfung auf existierende Formulareingabe & FormularCheck
            if(isset($_POST['formabgeschickt'])){
                // Formular hat Reload ausgelöst. Einträge anpassen und in DB eintragen
                bewertungen_eintragen();
                $msg = $_SESSION['bewertung_result_message'] ?? null;

                return view('bewertung', ['rd' => $request, 'title' => 'Bewertungen', 'msg'=> $msg, 'gericht_id' => $preset_mealid, 'data'=>$data]);
            }else{
                // Normaler Aufruf der Seite
                logger()->info('Bewertung besucht');
                return view('bewertung', ['rd' => $request, 'title' => 'Bewertungen', 'gericht_id' => $preset_mealid, 'data' => $data  ]);
            }
        } else {
            // Weiterleitung zur Anmeldung, wenn der Nutzer nicht eingeloggt ist
            logger()->info('Anmeldung besucht');
            return view('anmeldung', ['rd' => $request, 'title' => 'Anmeldung' ] );
        }
    }
    public function bewertungen(RequestData $request){
        $bewertungen = neuste_bewertungen_abfragen();
        logger()->info('Bewertungen besucht');
        return view('bewertungen', ['rd' => $request, 'title' => 'Übersicht Bewertungen', 'bewertungen' => $bewertungen ]);
    }
    public function meinebewertungen(RequestData $request){
        if(isset($_SESSION['login_ok'])) {
            $bewertungen = meinebewertungen_abfragen();
            if($_SESSION['bewertung_result_message'] != 'Ihre Bewertung wurde gelöscht.'){
                $msg = null;
            } else {
                $msg = $_SESSION['bewertung_result_message'] ?? null;
            }

            logger()->info('Meine Bewertungen besucht');
            return view('meinebewertungen', ['rd' => $request, 'title' => 'Meine Bewertungen', 'bewertungen' => $bewertungen, 'msg'=> $msg ]);
        } else{
            logger()->info('Meine Bewertungen besucht');
            return view('anmeldung', ['rd' => $request, 'title' => 'Anmeldung']);
        }
    }
    public function bewertung_loeschen(RequestData $request){
        $delbewertung_id = (int) $_GET['delbewertung'];
        delete_bewertung($delbewertung_id);
        logger()->warning('Bewertung gelöscht');
        header('Location: /meinebewertungen');

    }
}
