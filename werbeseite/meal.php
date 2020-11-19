<?php
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';
const GET_SHOW_DESCRIPTION = 'show_description';
const GET_SELECTED_LANGUAGE = 'language';
// Liste aller möglichen Allergene.
$allergens = array(
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch',
    17 => 'Milch',);
// Liste aller möglichen Gerichte.
$meal = [ // Kurzschreibweise für ein Array (entspricht = array())
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    'allergens' => [11, 13],
    'amount' => 42   // Anzahl der verfügbaren Gerichte.
];
// Liste aller Bewertungen.
$ratings = [
    [   'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [   'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [   'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [   'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];
// Arraydefinition
$showRatings = [];
// Wurde großteils vorgegeben
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    // Suche nach Treffern mit strpos() wir die Abfrage case-insensitive
    foreach ($ratings as $rating) {
        if (strpos(strtolower($rating['text']), strtolower($searchTerm)) !== false) {
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else {
    $showRatings = $ratings;
}
// Berechnung der Gesamtbewertung
function calcMeanStars($ratings) : float { // : float gibt an, dass der Rückgabewert vom Typ "float" ist
    $sum = 0;
    $i = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'];
        $i++;
    }
    return $sum / count($ratings);
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>Gericht: <?php echo $meal['name']; ?></title>
    <style type="text/css">
        * {
            font-family: Arial, serif;
        }
        .rating {
            color: darkgray;
        }
    </style>
</head>
<body>
<div>
    <!-- Abfrage, ob oder welche Sprache gefordert wurde und entsprechende Ausgabe (Überschrift) -->
    <?php
    if(empty($_GET[GET_SELECTED_LANGUAGE]) || $_GET[GET_SELECTED_LANGUAGE]=="deutsch"){
        echo '<h1 style="display: inline;">Gericht: '.$meal['name'].'</h1>';
    } else if($_GET[GET_SELECTED_LANGUAGE]=="english"){
        echo '<h1 style="display: inline;">Meal: '.$meal['name'].'</h1>';
    }
    ?>
    <!--Benutzer wählt die Sprache der Webseite aus-->
    <?php
    echo '<form action="meal.php" method="get" style="display: inline; margin-left:20px;">'.'<label for="language"></label>'.'<select name="language" id="language">'.'<option value="english">English</option>'.'<option value="deutsch">Deutsch</option>'.'</select>'.'<input type="submit" value="Sprache ändern">'.'</form>';
    ?>
</div>
<!-- Dynamik bei Beschreibung und Preisangaben -->
<?php
// Ein- und Ausblendefunktion der Gerichtbeschreibung
if(!empty($_GET[GET_SHOW_DESCRIPTION])){
    if($_GET[GET_SHOW_DESCRIPTION] == '1'){
        echo "<p>{$meal['description']}</p>".'<form action="meal.php" method="get">'.'<input type="hidden" value="0" name="show_description">'.'<input type="submit" value="Beschreibung ausblenden">'.'</form>';
    }
} else {
    echo '<form action="meal.php" method="get">'.'<input type="hidden" value="1" name="show_description">'.'<input type="submit" value="Beschreibung einblenden">'.'</form>';
}
// Abfrage, ob oder welche Sprache gefordert wurde und entsprechende Ausgabe (Preisangaben)
if(empty($_GET[GET_SELECTED_LANGUAGE]) || $_GET[GET_SELECTED_LANGUAGE]=="deutsch"){
    echo '<p>Preise intern: '.number_format($meal['price_intern'] , $decimals = 2, "," , ".").' €</p>'.'<p>Preise extern: '.number_format($meal['price_extern'] , $decimals = 2, "," , ".").' €</p>';
} else if($_GET[GET_SELECTED_LANGUAGE]=="english"){
    echo '<p>Price intern: '.number_format($meal['price_intern'] , $decimals = 2, "," , ".").' €</p>'.'<p>Price extern: '.number_format($meal['price_extern'] , $decimals = 2, "," , ".").' €</p>';
}
?>
<p>
    <!-- Allergenabfrage & Sprachabfrage bei Bewertungsüberschrift -->
    <?php
    // Abfrage und Ausgabe von Allergenen
    if (empty($meal['allergens'])) {
        echo("Keine Alergene.\n");
    } else {
        $x = 0;
        // Ausgabe der Liste mit den Allergenen
        echo("<ul>");
        foreach ($meal['allergens'] as $val) {
            echo("<li>" . htmlentities($val, ENT_QUOTES, 'UTF-8') . "</li>\n");
        }
        echo("</ul>");
    }
    // Abfrage, ob oder welche Sprache gefordert wurde und entsprechende Ausgabe (Bewertungsüberschrift)
    if (empty($_GET[GET_SELECTED_LANGUAGE]) || $_GET[GET_SELECTED_LANGUAGE] == "deutsch") {
        echo '<h1>Bewertungen (Insgesamt: ' .calcMeanStars($ratings). ')</h1>';
    } else if ($_GET[GET_SELECTED_LANGUAGE] == "english") {
        echo '<h1>Ratings (Summarized: ' .calcMeanStars($ratings). ')</h1>';
    }
    ?>
    <!-- Formular für den Filter von Bewertungen, mit Speicherung der letzten Filterung -->
<form method="get">
    <label for="search_text">Filter:</label>
    <?php
    // Suchfeld mit Speicherung der letzten Filterung
    if(!empty($_GET[GET_PARAM_SEARCH_TEXT])){
        $searchstr = $_GET[GET_PARAM_SEARCH_TEXT];
        echo '<input id="search_text" type="text" name="search_text"'."value=\"$searchstr\"".">";
    } else{
        echo '<input id="search_text" type="text" name="search_text">';
    }
    // Sprachabfrage des Suchbuttons und entsprechende Beschriftung
    if (empty($_GET[GET_SELECTED_LANGUAGE]) ||$_GET[GET_SELECTED_LANGUAGE] == "deutsch") {
        echo '<input type="submit" value="Suchen">';
    } else if ($_GET[GET_SELECTED_LANGUAGE] == "english") {
        echo '<input type="submit" value="Search">';
    }
    ?>
</form>
    <!-- Wiedergabe der Bewertungstexte -->
<table class="rating">
    <thead>
    <tr>
        <td>Text</td>
        <td>Sterne</td>
        <td>Autoren</td>
    </tr>
    </thead>
    <tbody>
    <!-- Schleife für die Ausgabe aller Bewertungen -->
    <?php
    foreach ($showRatings as $rating) {
        echo "<tr><td class='rating_text'>{$rating['text']}</td>
                      <td class='rating_stars'>{$rating['stars']}</td>
                      <td class='rating_author'>{$rating['author']}</td>
                  </tr>";
    }
    ?>
    </tbody>
</table>
<div>
</div>
</body>
</html>