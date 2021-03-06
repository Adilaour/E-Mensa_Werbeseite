<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>{{$title}}</title>
    <!-- Besucherzähler muss überholt werden! -->
    <?php
    if(!file_exists("besucherlog.txt")){
        // Beim ersten Besuch auf der Seite existiert die Daten noch nicht.
        $besucherlog = fopen("besucherlog.txt", 'w');
        fwrite($besucherlog, "1");
        fclose($besucherlog);
    } else {
        // Wenn Datei existiert wird sie ausgelesen, wobei der gelesene string in (int) umgecastet und in var $aktuellerstand gespeichert wird. Anschließend Datei schließen, um Modus zu wechseln.
        $besucherlog = fopen("besucherlog.txt",'r');
        $aktuellerstand = (int)fgets($besucherlog);
        fclose($besucherlog);
        // $aktuellerstand hochzählen und in Datei schreiben
        $aktuellerstand++;
        $besucherlog = fopen("besucherlog.txt",'w');
        fwrite($besucherlog, $aktuellerstand);
        fclose($besucherlog);
    }
    ?>
</head>
<body>
<header>
    @section('header')
        <div class="sitelogo bordered headeritems"><img src="" alt="E-Mensa Logo"></div>
        <nav class="navbar bordered headeritems">
            <ul class="mainmenu">
                <li><a href="#news">Ankündigung</a></li>
                <li><a href="#meals">Speisen</a></li>
                <li><a href="#zahlen">Zahlen</a></li>
                <li><a href="#reviews">Bewertungen</a></li>
                <li><a href="#contact">Kontakt</a></li>
                <li><a href="#wichtig">Wichtig für uns</a></li>
            </ul>
        </nav>
        @if(isset($_SESSION['login_ok']) && isset($_SESSION['nutzer']))
            <div class="nutzerbereich tooltip">
                <p class="tooltiptext">
                   Angemeldet als:
                </p>
                <a class="nutzerlink" href="/profil">{{$_SESSION['nutzer']}}</a>
                <a href="/abmeldung">
                    <img class="logout_btn" src="img/logout.svg" alt="Abmeldung">
                </a>
            </div>

        @endif
    @show
</header>
<main>
    @section('main')
    @show
</main>
<footer>
    @section('footer')
        <nav class="navbar">
            <ul class="footermenu">
                <li>(c) E-Mensa GmbH</li>
                <li>Adil Aouragh & Alexander List</li>
                <li><a href="impressum.html" target="_blank">Impressum</a></li>
            </ul>
        </nav>
    @show
</footer>
</body>
</html>

