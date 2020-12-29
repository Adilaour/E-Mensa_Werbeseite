<?php
require_once('../models/benutzer.php');

class LoginController
{
    // M5.1.3
    public function adminanlegen(RequestData $request) {
        adminanlegen();
        return view('adminanlegen', ['rd' => $request ]);
    }
    // M5.1.4
    public function anmeldung(RequestData $request) {
        $msg = $_SESSION['login_result_message'] ?? null;
        return view('anmeldung', ['rd' => $request, 'msg' => $msg]);
    }
    public function anmeldung_verifizieren(RequestData $request){

        $email = $_POST['email'];
        $kennwort = $_POST['kennwort'];

        $_SESSION['login_result_message'] = null;

        if(logincheck($email, $kennwort) == true){
            $_SESSION['login_ok'] = true;
            header('Location: /');
        }else{
            $_SESSION['login_result_message'] = 'Benutzer- oder Passwort falsch';
            header('Location: /anmeldung');
        }
    }

}