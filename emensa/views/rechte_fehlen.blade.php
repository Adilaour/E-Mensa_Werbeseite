@extends('layouts.main_layout')
@section('main')
<h2>Ihnen fehlen die erforderlichen Rechte für die Anfrage.</h2>
    {{print_r($_SESSION['userisadmin'])}}

@endsection
