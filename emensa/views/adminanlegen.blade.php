@extends('layouts.main_layout')
@section('main')
    <h1>Adminregistrierung</h1>
    <p><b>Auf dieser Seite haben Sie die Möglichkeit super sicher, super viele Rechte zu erhalten!</b></p>
    <form action="adminanlegen" method="post" style="margin-bottom: 5px;">
        <label for="kennwort">Admin-Kennwort eingeben:
            <input class="loginform"  id="kennwort" name="kennwort" type="text" required>
        </label>
        <input class="loginform"  type="submit">
    </form>
@endsection
