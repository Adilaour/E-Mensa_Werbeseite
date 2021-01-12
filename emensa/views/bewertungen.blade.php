@extends('layouts.main_layout')
@section('main')
    <h2>Übersicht über die aktuellsten Bewertungen</h2>
    <table>
        <tr>
            <th>Speise</th>
            <th>Sterne</th>
            <th>Bemerkung</th>
            <th>Nutzer</th>
            <th>Hervorgehoben</th>
            <th>Erstellungszeitpunkt</th>
        </tr>
        @foreach($bewertungen as $bewertung)
            <tr>
                <td>{{$bewertung[0]}}</td>
                <td>{{$bewertung[1]}}</td>
                <td>{{$bewertung[2]}}</td>
                <td>{{$bewertung[3]}}</td>



                <!--1/0 true/false zu checked oder unchecked übersetzen-->
                <td>{{$bewertung[4]}}</td>


                <td>{{$bewertung[5]}}</td>
            </tr>
        @endforeach
    </table>

@endsection
