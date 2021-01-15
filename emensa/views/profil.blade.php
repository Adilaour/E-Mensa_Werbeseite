@extends('layouts.main_layout')
@section('main')
    <h1>Willkommne auf deiner Nutzerseite.</h1>
    {{print_r($data)}}
    <br>
    {{$_SESSION['userisadmin']}}


    <h2>Heutige Speiseempfehlung (M6.3.4)</h2>
    <h3>{{$favmeal["name"]}}</h3>
@endsection
