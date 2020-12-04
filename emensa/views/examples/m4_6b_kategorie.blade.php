<!doctype html>
<html>
<head>
    <title>{{$title}}</title>
</head>

<body>
<ul>
    @foreach($kategorien as $kategorie)
        <li>{{$kategorie['name']}}</li>
    @endforeach
</ul>
</body>

</html>

<style>
    li:nth-child(even){font-weight:bold}
</style>