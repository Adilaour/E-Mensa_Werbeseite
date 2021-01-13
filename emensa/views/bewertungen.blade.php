@extends('layouts.main_layout')
@section('main')
    <h2>Übersicht über die aktuellsten Bewertungen</h2>
    <table>
        <tr>
            <th>Speise</th>
            <th>Sterne</th>
            <th>Bemerkung</th>
            <th>Nutzer</th>
            <th>Wichtig</th>
            <th>Bewertungszeitpunkt</th>
            <th>Manuell hervorheben</th>
        </tr>
        @foreach($bewertungen as $bewertung)
            <tr>
                <!-- Speise -->
                <td>{{$bewertung[0]}}</td>
                <!-- Sterne -->
                <td>{{$bewertung[1]}}</td>
                <!-- Bemerkung -->
                <td>{{$bewertung[2]}}</td>
                <!-- Nutzer -->
                <td>{{$bewertung[3]}}</td>
                <!-- Wichtig -->
                @if($bewertung[4] == 1)
                    <td><input type="checkbox" name="hervorheben" id="hervorheben" checked disabled></td>
                @elseif($bewertung[4] == 0)
                    <td><input type="checkbox" name="hervorheben" id="hervorheben" disabled></td>
                @endif
                <!-- Bewertungszeitpunkt -->
                <td>{{$bewertung[5]}}</td>
                <!-- Manuell hervorheben -->
                @if($bewertung[4] == 1)
                    <td><a href="bewertung_manuell_abwaehlen">Bewertung abwählen</a></td>
                @elseif($bewertung[4] == 0)
                    <td><a href="bewertung_manuell_hervorheben">Bewertung hervorheben</a></td>
                @endif




            </tr>
        @endforeach
    </table>

@endsection







