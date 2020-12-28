@extends('layouts.main_layout')
@section('main')
    @yield($msg)
    <h1>E-Mensa Anmeldung</h1>
    <p>Loggen Sie sich hier ein, um die volle Funktionalität der Emensa nutzen zu können.</p>

    <form class="loginformframe" action="anmeldung_verifizieren" method="post">

        <label for="email">E-Mail
            <input class="loginform" id="email" name="email" type="email" required>
        </label>
        <label for="kennwort">Passwort
            <input class="loginform" id="kennwort" name="kennwort" type="text" required>
        </label>
        <input class="loginform" type="submit">

    </form>

@endsection
