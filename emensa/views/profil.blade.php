@extends('layouts.main_layout')
@section('main')
    <h1>Willkommne auf deiner Nutzerseite.</h1>
    {{print_r($data)}}
    <br>
    {{$_SESSION['userisadmin']}}
@endsection
