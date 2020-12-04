<!doctype html>
<html>
<head>
    <title>{{$title}}</title>
</head>

<body>
<ul>
    @foreach($gerichte as $gericht)
        <li>{{$gericht['name']}}</li>
    @endforeach
</ul>
</body>

</html>