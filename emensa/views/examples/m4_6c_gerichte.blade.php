<!doctype html>
<html>
<head>
    <title>{{$title}}</title>
</head>
<body>
<ul>
    @foreach($gerichte as $gericht)
        <li>{{$gericht['name']}}
            {{number_format($gericht['preis_intern'],2)}} &euro;
        </li>

    @endforeach
</ul>
</body>

</html>
