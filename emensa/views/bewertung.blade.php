@extends('layouts.main_layout')
@section('main')
    <h1>Speisen Bewertung</h1>

    @if (isset($data))
        @if($result["bildname"]==null)
            <img src="img/gerichte/00_image_missing.jpg" style="height: 100px; width:100px;">
        @else
            <img src="img/gerichte/{{$result["bildname"]}}" style="height: 100px; width:100px;">
        @endif
        <h2>Ihre ausgewählte Speise: {{$result["name"]}}</h2>
    @endif

    <form action="bewertung" method="post" autocomplete="on" id="bewertungsform" name="bewertungsform" class="loginformframe" style="margin-top:10px;">
        @if (isset($data))

        @elseif(!isset($data))
            <label for="gericht_id">Gericht:
                <input class="loginform" type="number" id="gericht_id" name="gericht_id" min="1" max="21" value="{{$gericht_id}}" required style="width:50px">
            </label>
        @endif

        <label for="sterne">Sterne:
            <input class="loginform" type="number" min="0" max="5"  id="sterne" name="sterne" required>
        </label>
        <label for="bemerkung">Bemerkung:
            <textarea class="loginform" id="bemerkung" name="bemerkung" minlength="5" maxlength="500" placeholder="Schreiben Sie Ihre Bemerkung zu diesem Gericht in dieses Feld." required></textarea>
        </label>
        <label for="wichtig">Hervorheben:
            <input class="loginform" type="checkbox" id="wichtig" name="wichtig">
        </label>
        <label for="formabgeschickt">
            <input class="loginform" type="submit" id="formabgeschickt" name="formabgeschickt" value="Bewertung abschicken" >
        </label>
    </form>
    @if (isset($msg))
        <p>{{$msg}}</p>
    @else
        <p></p>
    @endif

@endsection
