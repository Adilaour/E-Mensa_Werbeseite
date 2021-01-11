@extends('layouts.main_layout')
@section('main')
    <h1>Speisen Bewertung</h1>
    <form action="bewertung" method="post" autocomplete="on" id="bewertungsform" name="bewertungsform">
        <label for="gericht_id">Gericht:
            <!-- Maximalwert aus DB abfragen. siehe: höchste gerichte(id) -->
            <input type="number" id="gerich_id" name="gericht_id" min="1" max="100" required>
        </label>
        <label for="sterne">Sterne:
            <input type="range" min="0" max="4" value="4" id="sterne" name="sterne" required>
        </label>
        <label for="bemerkung">Bemerkung:
            <textarea id="bemerkung" name="bemerkung" minlength="5" maxlength="500" placeholder="Schreiben Sie Ihre Bemerkung zu diesem Gericht in dieses Feld." required></textarea>
        </label>
        <label for="wichtig">Hervorheben:
            <input type="checkbox" id="wichtig" name="wichtig" value="true">
        </label>
        <label>
            <input type="submit">
        </label>
    </form>
    @if (isset($msg))
        <p>{{$msg}}</p>
    @else
        <p></p>
    @endif

@endsection
