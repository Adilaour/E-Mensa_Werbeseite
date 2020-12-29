<?php
require_once('../models/benutzer.php');

class LoginController
{
    // M5.1.3
    public function adminanlegen(RequestData $request) {
        adminanlegen();
        return view('adminanlegen', ['rd' => $request, 'title'=>'Adminanlegen']);
    }
    // M5.1.4
    public function anmeldung(RequestData $request) {
        $msg = $_SESSION['login_result_message'] ?? null;
        return view('anmeldung', ['rd' => $request, 'msg' => $msg, 'title'=>'Anmeldung']);
    }
    public function anmeldung_verifizieren(RequestData $request){

        $email = $_POST['email'];
        $kennwort = $_POST['kennwort'];
        $name = explode('@', $email);

        $_SESSION['login_result_message'] = null;

        if(logincheck($email, $kennwort) == true){
            $_SESSION['login_ok'] = true;
            $_SESSION['nutzer'] = $name[0];
            login_success($email);
            header('Location: /');
        }else{
            $_SESSION['login_result_message'] = 'Benutzer- oder Passwort falsch';
            login_failed($email);
            header('Location: /anmeldung');
        }
    }
    // M5.1.8
    public function profil(RequestData $request){
        return view('profil', ['rd' => $request, 'title'=>'Mein Profil']);

    }
    // M5.1.10
    public function abmeldung(RequestData $request){
        $_SESSION['login_ok'] = false;
        $_SESSION['nutzer'] = null;
        session_destroy();
        header('Location: /');
    }

}