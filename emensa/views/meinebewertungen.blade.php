@extends('layouts.main_layout')
@section('main')
    <h2>Übersicht über meine aktuellsten Bewertungen</h2>
    <table>
        <tr>
            <th>Speise</th>
            <th>Sterne</th>
            <th>Bemerkung</th>
            <th>Hervorgehoben</th>
            <th>Erstellungszeitpunkt</th>
            <th></th>
        </tr>
        @foreach($bewertungen as $bewertung)
            <tr>
                <td>{{$bewertung[6]}}</td>
                <td>{{$bewertung[3]}}</td>
                <td>{{$bewertung[4]}}</td>

                <td>{{$bewertung[1]}}</td>
                <td>{{$bewertung[2]}}</td>
                <td><a href="bewertung_loeschen?delbewertung={{$bewertung[0]}}">Bewertung löschen</a></td>
            </tr>
        @endforeach
    </table>
    @if (isset($msg))
        <p>{{$msg}}</p>
    @else
        <p></p>
    @endif
@endsection

