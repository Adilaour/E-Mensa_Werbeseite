<!DOCTYPE html>
<!--
- Praktikum DBWT. Autoren:
- Adil, Aouragh, 3203789
- Alexander, List, 3126569
-->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ihre E-Mensa</title>
    <link rel="stylesheet" href="index.css">
</head>
<body class="gridcontainer">
<header class="headercontainer">
    <div class="sitelogo bordered headeritems"><img src="" alt="E-Mensa Logo"></div>
    <nav class="navbar bordered headeritems">
        <ul class="mainmenu">
            <li><a href="#news">Ankündigung</a></li>
            <li><a href="#meals">Speisen</a></li>
            <li><a href="#zahlen">Zahlen</a></li>
            <li><a href="#contact">Kontakt</a></li>
            <li><a href="#wichtig">Wichtig für uns</a></li>
        </ul>
    </nav>
</header>
<main>
    <h1>Ihre E-Mensa</h1>
    <div class="mainitem"><img src="img/Banner.jpeg" alt="Bannerbild" class="banner"></div>
    <div class="mainitem" id="news">
        <h2>Bald gibt es Essen auch online ;)</h2>
        <!--im folgenden paragraph sprache auch zxx geändert-->
        <p class="bordered" lang="zxx">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
    </div>
    <div class="mainitem" id="meals">
        <h2>Köstlichkeiten, die Sie erwarten</h2>
        <!-- Alte Tabelle
        <table id="koestlichkeitent">
            <tr>
                <th></th>
                <th>Preis intern</th>
                <th>Preis extern</th>
            </tr>
            <tr>
                <td class="alignleft">Rindfleisch mit Bambus, Kaiserschoten und rotem Paprika, dazu Mie Nudeln</td>
                <td>3,50</td>
                <td>6,20</td>
            </tr>
            <tr>
                <td class="alignleft">Spinatrisotto mit kleinen Samsosateigecken und gemischter Salat</td>
                <td>2,90</td>
                <td>5,30</td>
            </tr>
            <tr>
                <td>...</td>
                <td>...</td>
                <td>...</td>
            </tr>
        </table>-->
        <?php $gerichte=[];
        include('gerichte.php');
        ?>
        <table id="koestlichkeitent">
            <tr>
                <th>Bild</th>
                <th>Bezeichnung</th>
                <th>Preis intern</th>
                <th>Preis extern</th>
            </tr>
            <tr>
                <td><img src="img/rindfleischnudeln.jpg" alt="Nicht gefunden"></td>
                <td class="alignleft"><?php print_r($gerichte[1]['name'])?></td>
                <td><?php print_r($gerichte[1]['preisintern'])?></td>
                <td><?php print_r($gerichte[1]['preisextern'])?></td>
            </tr>
            <tr>
                <td><img src="img/risotto.jpg" alt="Nicht gefunden"></td>
                <td class="alignleft"><?php print_r($gerichte[2]['name'])?></td>
                <td><?php print_r($gerichte[2]['preisintern'])?></td>
                <td><?php print_r($gerichte[2]['preisextern'])?></td>
            </tr>
            <tr>
                <td><img src="img/bolognese.jpg" alt="Nicht gefunden"></td>
                <td class="alignleft"><?php print_r($gerichte[3]['name'])?></td>
                <td><?php print_r($gerichte[3]['preisintern'])?></td>
                <td><?php print_r($gerichte[3]['preisextern'])?></td>
            </tr>
            <tr>
                <td><img src="img/jaegerschnitzel.jpg" alt="Nicht gefunden"></td>
                <td class="alignleft"><?php print_r($gerichte[4]['name'])?></td>
                <td><?php print_r($gerichte[4]['preisintern'])?></td>
                <td><?php print_r($gerichte[4]['preisextern'])?></td>
            </tr>
        </table>

    </div>
    <div class="mainitem" id="zahlen">
        <h2>E-Mensa in Zahlen</h2>
        <div class="stats">
            <div><p class="zahlenwerte">X</p><p>&nbsp;Besuche</p></div>
            <div><p class="zahlenwerte">Y</p><p>&nbsp;Anmeldungen zum Newsletter</p></div>
            <div><p class="zahlenwerte">Z</p><p>&nbsp;Speisen</p></div>
        </div>

    </div>
    <div class="mainitem" id="contact">
        <h2>Interesse geweckt? Wir informieren Sie!</h2>
        <form action="newsletteranmeldung.html" method="post" name="newsletteranmeldung_landingpage" class="newsletteranmeldung_landingpage">
            <label for="fan_name" id="fan_name_lbl">Ihr Name
                <input type="text" id="fan_name" placeholder="Vorname">
            </label>
            <label for="fan_mail" id="fan_mail_lbl">Ihre E-Mail
                <input type="email" id="fan_mail">
            </label>
            <label for="fan_lang" id="fan_lang_lbl">
                <select name="fan_lang" id="fan_lang">
                    <option selected>Deutsch</option>
                    <option>English</option>
                    <option>Fran&ccedil;ais</option>
                </select>
            </label>
            <label for="fan_data" id="fan_data_lbl">
                <input type="checkbox" id="fan_data"> Den Datenschutzbestimmungen stimme ich zu.
            </label>
            <button type="submit" name="newsletter_landingpage_submit" id="newsletter_landingpage_submit" disabled>Zum Newsletter anmelden</button>
        </form>
    </div>
    <div class="mainitem" id="wichtig">
        <h2>Das ist uns wichtig</h2>
        <div class="wichtige">
            <ul class="wichtige_liste">
                <li>Beste frische saisonale Zutaten</li>
                <li>Ausgewogene abwechslungsreiche Gerichte</li>
                <li>Sauberkeit</li>
            </ul>
        </div>
    </div>
    <h2 id="goodbye">Wir freuen uns auf Ihren Besuch!</h2>

</main>
<footer>
    <nav class="navbar">
        <ul class="footermenu">
            <li>(c) E-Mensa GmbH</li>
            <li>Adil Aouragh & Alexander List</li>
            <li><a href="impressum.html" target="_blank">Impressum</a></li>
        </ul>
    </nav>
</footer>
</body>
</html>