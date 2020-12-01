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
    <!--Besucherzähler(Bei Newsletternameldung erneute Zählung...)-->
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
        <table id="koestlichkeitent">
            <tr>
                <th>Bild</th>
                <th>Bezeichnung</th>
                <th>Preis intern</th>
                <th>Preis extern</th>
            </tr>
            <!--Datenbankenabfrage zur Darstellung von Gerichten-->
            <?php
            $gerichtanzahl = 0;
            $link = mysqli_connect("localhost", "root","abc123","emensawerbeseite");
            // Überprüfung, ob Verbindung erfolgreich war
            if (!$link) {
                echo "Die Verbindung zur Datenbank ist fehlgeschlagen: ", mysqli_connect_error();
                exit();
            }
            // SQL Query (noch nicht dynamisch)
            $sql="SELECT g.name AS Gerichtname, g.preis_intern AS preisintern, g.preis_extern AS preisextern, GROUP_CONCAT(a.code) AS Allergen FROM gericht g, allergen a, gericht_hat_allergen gha WHERE g.id = gha.gericht_id AND a.code = gha.code GROUP BY g.name LIMIT 5;";
            $result = mysqli_query($link, $sql);
            // Prüfung, ob Abfrage korrekt ist
            if(!$result){
                echo "Fehler bei der Abfrage: ", mysqli_error($link);
                exit();
            }
            // Ausgabe der abgefragten Daten
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr><td><img src="img/bild" alt="Speisebild nicht gefunden">' . '</td><td class="alignleft">' . $row['Gerichtname'] . " <span style='font-size:0.75em'>" . $row['Allergen'] . '</span></td><td>' . $row['preisintern'] . '</td><td>' . $row['preisextern'] . '</td></tr>';
                $gerichtanzahl++;
            }
            // Schließen der Datenbankverbindung
            mysqli_free_result($result);
            mysqli_close($link);
            ?>
        </table>
        <div class="container">
            <div>
                <h3>Legende der verwendeten Allergene</h3>
                <?php
                // Erneuter Verbindungsaufbau
                $link = mysqli_connect("localhost", "root","abc123","emensawerbeseite");
                // Prüfung des erfolgreichen Verbindungsaufbaus
                if (!$link) {
                    echo "Die Verbindung zur Datenbank ist fehlgeschlagen: ", mysqli_connect_error();
                    exit();
                }
                // Datenabfrage der Allergene + Prüfung der Korrektheit
                $sql = "SELECT DISTINCT a.name AS Allergene, a.code AS Allergencode FROM allergen a, gericht g, gericht_hat_allergen gha WHERE g.id = gha.gericht_id AND a.code = gha.code";
                $result =mysqli_query($link, $sql);
                if(!$result){
                    echo "Fehler bei der Abfrage: ", mysqli_error($link);
                    exit();
                }
                // Ausgabe der Allergene in einer Tabelle mit Code
                echo "<table>";
                while($row = mysqli_fetch_assoc($result)){
                    echo '<tr><td>'.$row['Allergene'].'</td><td>'.$row['Allergencode'].'</td></tr>';
                }
                echo "</table>";
                // Verbindung schließen
                mysqli_free_result($result);
                mysqli_close($link);

                ?>
            </div>
            <div>
                <h3>Deine Wunschgerichte</h3>
                <p>In unserer Küche findest du sicher auch dein <a href="wunschgericht.php">Wunschgericht</a>. Aus einer Vielzahl köstlicher Mahlzeiten kannst du hier deine Liebsten auswählen. So können wir dich frühzeitig darauf aufmerksam machen, wenn deine Leibspeisen wieder in der Mensa serviert werden.</p>
                <p style="background-color: #00b5ad; border-radius: 5px; text-align: center; padding: 1em;"><a href="wunschgericht.php" style="color:white;">Wunschgerichte auswählen</a></p>
            </div>
        </div>

    </div>
    <div class="mainitem" id="zahlen">
        <h2>E-Mensa in Zahlen</h2>
        <div class="stats">
            <div>
                <p><?php
                    // Auslesen und Ausgabe der Besucherlogdatei@localhost
                    $besucherlog= fopen("besucherlog.txt",'r');
                    $aktuellerstand = (int)fgets($besucherlog);
                    fclose($besucherlog);
                    echo "$aktuellerstand";
                    ?></p>
                <p>&nbsp;Besuche</p>
            </div>
            <div>
                <p><?php
                    // Zählen der Zeilen in der Newsletterlog-Datei
                    if(file_exists("emails.txt")) {
                        $anmeldungen = count(file("emails.txt"));
                        echo "$anmeldungen";
                    } else{
                        echo "0";
                    }
                    ?></p>
                <p>&nbsp;Anmeldungen zum Newsletter</p>
            </div>
            <div>
                <p><?php
                    // Bisher Ausgabe der Tabellenzeilen in #meals - Später Summe der Gerichte in Datenbank
                    echo"$gerichtanzahl";
                    ?></p>
                <p>&nbsp;Speisen</p>
            </div>
        </div>
    </div>
    <div class="mainitem" id="contact">
        <h2>Interesse geweckt? Wir informieren Sie!</h2>
        <form action="index.php" method="post" name="newsletteranmeldung_landingpage" class="newsletteranmeldung_landingpage">
            <label for="fan_name" id="fan_name_lbl">Ihr Name
                <input type="text" id="fan_name" placeholder="Vorname" name="Vorname">
            </label>
            <label for="fan_mail" id="fan_mail_lbl">Ihre E-Mail
                <input type="email" id="fan_mail" name="email">
            </label>
            <label for="fan_lang" id="fan_lang_lbl">
                <select name="fan_lang" id="fan_lang">
                    <option selected>Deutsch</option>
                    <option>English</option>
                    <option>Fran&ccedil;ais</option>
                </select>
            </label>
            <label for="fan_data" id="fan_data_lbl">
                <input type="checkbox" id="fan_data" name="datasec"> Den Datenschutzbestimmungen stimme ich zu.
            </label>
            <button type="submit" name="newsletter_landingpage_submit" id="newsletter_landingpage_submit" value="1" >Zum Newsletter anmelden</button>
            <!-- Newsletterlogik Meilenstein2 -->
            <?php
            // Festlegung der unqualifizierten E-Mail Hoster
            $trashmails = explode("\n","0-mail.com
0815.ru
0clickemail.com
0wnd.net
0wnd.org
10minutemail.com
20minutemail.com
2prong.com
30minutemail.com
3d-painting.com
4warding.com
4warding.net
4warding.org
60minutemail.com
675hosting.com
675hosting.net
675hosting.org
6url.com
75hosting.com
75hosting.net
75hosting.org
7tags.com
9ox.net
a-bc.net
afrobacon.com
ajaxapp.net
amilegit.com
amiri.net
amiriindustries.com
anonbox.net
anonymbox.com
antichef.com
antichef.net
antispam.de
baxomale.ht.cx
beefmilk.com
binkmail.com
bio-muesli.net
bobmail.info
bodhi.lawlita.com
bofthew.com
brefmail.com
broadbandninja.com
bsnow.net
bugmenot.com
bumpymail.com
casualdx.com
centermail.com
centermail.net
chogmail.com
choicemail1.com
cool.fr.nf
correo.blogos.net
cosmorph.com
courriel.fr.nf
courrieltemporaire.com
cubiclink.com
curryworld.de
cust.in
dacoolest.com
dandikmail.com
dayrep.com
deadaddress.com
deadspam.com
despam.it
despammed.com
devnullmail.com
dfgh.net
digitalsanctuary.com
discardmail.com
discardmail.de
Disposableemailaddresses:emailmiser.com
disposableaddress.com
disposeamail.com
disposemail.com
dispostable.com
dm.w3internet.co.ukexample.com
dodgeit.com
dodgit.com
dodgit.org
donemail.ru
dontreg.com
dontsendmespam.de
dump-email.info
dumpandjunk.com
dumpmail.de
dumpyemail.com
e4ward.com
email60.com
emaildienst.de
emailias.com
emailigo.de
emailinfive.com
emailmiser.com
emailsensei.com
emailtemporario.com.br
emailto.de
emailwarden.com
emailx.at.hm
emailxfer.com
emz.net
enterto.com
ephemail.net
etranquil.com
etranquil.net
etranquil.org
explodemail.com
fakeinbox.com
fakeinformation.com
fastacura.com
fastchevy.com
fastchrysler.com
fastkawasaki.com
fastmazda.com
fastmitsubishi.com
fastnissan.com
fastsubaru.com
fastsuzuki.com
fasttoyota.com
fastyamaha.com
filzmail.com
fizmail.com
fr33mail.info
frapmail.com
front14.org
fux0ringduh.com
garliclife.com
get1mail.com
get2mail.fr
getonemail.com
getonemail.net
ghosttexter.de
girlsundertheinfluence.com
gishpuppy.com
gowikibooks.com
gowikicampus.com
gowikicars.com
gowikifilms.com
gowikigames.com
gowikimusic.com
gowikinetwork.com
gowikitravel.com
gowikitv.com
great-host.in
greensloth.com
gsrv.co.uk
guerillamail.biz
guerillamail.com
guerillamail.net
guerillamail.org
guerrillamail.biz
guerrillamail.com
guerrillamail.de
guerrillamail.net
guerrillamail.org
guerrillamailblock.com
h.mintemail.com
h8s.org
haltospam.com
hatespam.org
hidemail.de
hochsitze.com
hotpop.com
hulapla.de
ieatspam.eu
ieatspam.info
ihateyoualot.info
iheartspam.org
imails.info
inboxclean.com
inboxclean.org
incognitomail.com
incognitomail.net
incognitomail.org
insorg-mail.info
ipoo.org
irish2me.com
iwi.net
jetable.com
jetable.fr.nf
jetable.net
jetable.org
jnxjn.com
junk1e.com
kasmail.com
kaspop.com
keepmymail.com
killmail.com
killmail.net
kir.ch.tc
klassmaster.com
klassmaster.net
klzlk.com
kulturbetrieb.info
kurzepost.de
letthemeatspam.com
lhsdv.com
lifebyfood.com
link2mail.net
litedrop.com
lol.ovpn.to
lookugly.com
lopl.co.cc
lortemail.dk
lr78.com
m4ilweb.info
maboard.com
mail-temporaire.fr
mail.by
mail.mezimages.net
mail2rss.org
mail333.com
mail4trash.com
mailbidon.com
mailblocks.com
mailcatch.com
maileater.com
mailexpire.com
mailfreeonline.com
mailin8r.com
mailinater.com
mailinator.com
mailinator.net
mailinator2.com
mailincubator.com
mailme.ir
mailme.lv
mailmetrash.com
mailmoat.com
mailnator.com
mailnesia.com
mailnull.com
mailshell.com
mailsiphon.com
mailslite.com
mailzilla.com
mailzilla.org
mbx.cc
mega.zik.dj
meinspamschutz.de
meltmail.com
messagebeamer.de
mierdamail.com
mintemail.com
moburl.com
moncourrier.fr.nf
monemail.fr.nf
monmail.fr.nf
msa.minsmail.com
mt2009.com
mx0.wwwnew.eu
mycleaninbox.net
mypartyclip.de
myphantomemail.com
myspaceinc.com
myspaceinc.net
myspaceinc.org
myspacepimpedup.com
myspamless.com
mytrashmail.com
neomailbox.com
nepwk.com
nervmich.net
nervtmich.net
netmails.com
netmails.net
netzidiot.de
neverbox.com
no-spam.ws
nobulk.com
noclickemail.com
nogmailspam.info
nomail.xl.cx
nomail2me.com
nomorespamemails.com
nospam.ze.tc
nospam4.us
nospamfor.us
nospamthanks.info
notmailinator.com
nowmymail.com
nurfuerspam.de
nus.edu.sg
nwldx.com
objectmail.com
obobbo.com
oneoffemail.com
onewaymail.com
online.ms
oopi.org
ordinaryamerican.net
otherinbox.com
ourklips.com
outlawspam.com
ovpn.to
owlpic.com
pancakemail.com
pimpedupmyspace.com
pjjkp.com
politikerclub.de
poofy.org
pookmail.com
privacy.net
proxymail.eu
prtnx.com
punkass.com
PutThisInYourSpamDatabase.com
qq.com
quickinbox.com
rcpt.at
recode.me
recursor.net
regbypass.com
regbypass.comsafe-mail.net
rejectmail.com
rklips.com
rmqkr.net
rppkn.com
rtrtr.com
s0ny.net
safe-mail.net
safersignup.de
safetymail.info
safetypost.de
sandelf.de
saynotospams.com
selfdestructingmail.com
SendSpamHere.com
sharklasers.com
shiftmail.com
shitmail.me
shortmail.net
sibmail.com
skeefmail.com
slaskpost.se
slopsbox.com
smellfear.com
snakemail.com
sneakemail.com
sofimail.com
sofort-mail.de
sogetthis.com
soodonims.com
spam.la
spam.su
spamavert.com
spambob.com
spambob.net
spambob.org
spambog.com
spambog.de
spambog.ru
spambox.info
spambox.irishspringrealty.com
spambox.us
spamcannon.com
spamcannon.net
spamcero.com
spamcon.org
spamcorptastic.com
spamcowboy.com
spamcowboy.net
spamcowboy.org
spamday.com
spamex.com
spamfree24.com
spamfree24.de
spamfree24.eu
spamfree24.info
spamfree24.net
spamfree24.org
SpamHereLots.com
SpamHerePlease.com
spamhole.com
spamify.com
spaminator.de
spamkill.info
spaml.com
spaml.de
spammotel.com
spamobox.com
spamoff.de
spamslicer.com
spamspot.com
spamthis.co.uk
spamthisplease.com
spamtrail.com
speed.1s.fr
supergreatmail.com
supermailer.jp
suremail.info
teewars.org
teleworm.com
tempalias.com
tempe-mail.com
tempemail.biz
tempemail.com
TempEMail.net
tempinbox.co.uk
tempinbox.com
tempmail.it
tempmail2.com
tempomail.fr
temporarily.de
temporarioemail.com.br
temporaryemail.net
temporaryforwarding.com
temporaryinbox.com
thanksnospam.info
thankyou2010.com
thisisnotmyrealemail.com
throwawayemailaddress.com
tilien.com
tmailinator.com
tradermail.info
trash-amil.com
trash-mail.at
trash-mail.com
trash-mail.de
trash2009.com
trashemail.de
trashmail.at
trashmail.com
trashmail.de
trashmail.me
trashmail.net
trashmail.org
trashmail.ws
trashmailer.com
trashymail.com
trashymail.net
trillianpro.com
turual.com
twinmail.de
tyldd.com
uggsrock.com
upliftnow.com
uplipht.com
venompen.com
veryrealemail.com
viditag.com
viewcastmedia.com
viewcastmedia.net
viewcastmedia.org
webm4il.info
wegwerfadresse.de
wegwerfemail.de
wegwerfmail.de
wegwerfmail.net
wegwerfmail.org
wetrainbayarea.com
wetrainbayarea.org
wh4f.org
whyspam.me
willselfdestruct.com
winemaven.info
wronghead.com
wuzup.net
wuzupmail.net
www.e4ward.com
www.gishpuppy.com
www.mailinator.com
wwwnew.eu
xagloo.com
xemaps.com
xents.com
xmaily.com
xoxy.net
yep.it
yogamaven.com
yopmail.com
yopmail.fr
yopmail.net
ypmail.webarnak.fr.eu.org
yuurok.com
zehnminutenmail.de
zippymail.info
zoaxe.com
zoemail.org");
            // Kontrolle aller Eingaben in der Newsletteranmeldung + Ausgabe aller Fehler
            if(!empty($_POST)){
                $allesok = 0;
                $emailok = 0;
                // trim entfernt Leerzeichen dann prüfen
                $vorname = trim($_POST['Vorname']);
                // Prüfung der korrekten Namensangabe
                if(!isset($vorname) || $vorname==''){
                    echo "Geben Sie Ihren vollständigen Namen an!".'<br>';
                } else{
                    $vorname = $_POST['Vorname'];
                    $allesok++;
                }
                // Prüfung auf Zustimmung der Datenschutzbestimmungen
                if(!isset($_POST['datasec'])){
                    echo "Datenschutzbestimmungen akzeptieren!".'<br>';
                    $datasec = false;
                } else{
                    $datasec = $_POST['datasec'];
                    $allesok++;
                }
                // Prüfung der E-Mail
                if(isset($_POST['email']) && $_POST['email'] != '') {
                    // explode trennt Email an dieser Stelle und speichert sie in einem Array. Das 2. Element enthält die Domain ohne @-Zeichen
                    $emailarray = explode('@', $_POST['email']);
                    // Alle Trashdomains mit dem 2.Arrayelement vergleichen, wenn nichts gefunden wird email setzen
                    foreach ($trashmails as $trashy) {
                        if (strpos($trashy, $emailarray[1])) {
                            echo 'Email nicht gültig' . '<br>';
                            $emailok = false;
                            break;
                        } else {
                            $email = $_POST['email'];
                            $emailok = true;
                        }
                    }
                } else{
                    echo 'Email nicht gültig' . '<br>';
                    $emailok = false;
                    $email = false;
                }
                // Sprache des Newsletters speichern
                $lang = $_POST['fan_lang'];
                // Abspeicherung aller Daten, wenn alles in Ordnung ist
                if($allesok>=2&&$emailok){
                    $newline = $vorname.' | '.$email.' | '.$lang.' | '.$datasec."\n";
                    // Datei wird zum Schreiben geöffnet
                    $newsletterlog = fopen ( "emails.txt", "a" );
                    // schreiben des Inhaltes von email
                    fwrite ( $newsletterlog, $newline );
                    fclose ( $newsletterlog );
                    echo "Mashalla! Eingabe erfolgreich";
                }
            }
            ?>
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


