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
            @if($bewertung[1] == 1)
                <tr style=" color:red;" >
                    <!-- Speise -->
                    <td>{{$bewertung[6]}}</td>
                    <!-- Sterne -->
                    <td>{{$bewertung[3]}}</td>
                    <!-- Bemerkung -->
                    <td>{{$bewertung[4]}}</td>
                    <!-- Nutzer -->
                    <td>{{$bewertung[5]}}</td>
                    <!-- Wichtig -->
                    <td><input type="checkbox" name="hervorheben" id="hervorheben" checked disabled></td>
                    <!-- Bewertungszeitpunkt -->
                    <td>{{$bewertung[2]}}</td>
                    <!-- Manuell hervorheben -->
                    <td><a href="bewertung_manuell_abwaehlen?bewertung={{$bewertung[0]}}">Bewertung abwählen</a></td>
                </tr>
            @elseif($bewertung[1] == 0)
                <tr>
                    <!-- Speise -->
                    <td>{{$bewertung[6]}}</td>
                    <!-- Sterne -->
                    <td>{{$bewertung[3]}}</td>
                    <!-- Bemerkung -->
                    <td>{{$bewertung[4]}}</td>
                    <!-- Nutzer -->
                    <td>{{$bewertung[5]}}</td>
                    <!-- Wichtig -->
                    <td><input type="checkbox" name="hervorheben" id="hervorheben" disabled></td>
                    <!-- Bewertungszeitpunkt -->
                    <td>{{$bewertung[2]}}</td>
                    <!-- Manuell hervorheben -->
                    <td><a href="bewertung_manuell_hervorheben?bewertung={{$bewertung[0]}}">Bewertung hervorheben</a></td>
                </tr>
            @endif
        @endforeach
    </table>


@endsection









