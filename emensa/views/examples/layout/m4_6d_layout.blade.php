<!doctype html>
<html>
<head>
    <title>@yield('title')</title>
</head>

<body>
<header>
    @section('header')
        header
    @show
</header>
<main>
    @section('main')
    @show
</main>
<footer>
    @section('footer')
        footer
    @show
</footer>
</body>
</html>

