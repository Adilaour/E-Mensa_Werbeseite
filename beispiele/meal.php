<?php
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';
const GET_PARAM_SHOW_DESCRIPTION = 'show_description';

/**
 * Liste aller möglichen Allergene.
 */
$allergens = array(
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch',
    17 => 'Milch',);


$meal = [ // Kurzschreibweise für ein Array (entspricht = array())
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    'allergens' => [11, 13],
    'amount' => 42   // Anzahl der verfügbaren Gerichte.
];

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

$showRatings = [];
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        if (strpos($rating['text'], $searchTerm) !== false) {
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


$states = array(
    'visible' => 'hidden' ,
    'hidden' => 'visible' ,
);
$show_description = 'visible';
if (!empty($_GET[GET_PARAM_SHOW_DESCRIPTION])) {
    if(in_array ($_GET[GET_PARAM_SHOW_DESCRIPTION] , $states)) {
        $display = $_GET[GET_PARAM_SHOW_DESCRIPTION];
    }
}
$link = '?display=' . $states[GET_PARAM_SHOW_DESCRIPTION];


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
        <h1>Gericht: <?php echo $meal['name']; ?></h1>
        <p><?php echo $meal['description']; ?></p>
        <p><?php if (empty($meal['allergens'])) {
        echo("Keine Alergene.\n");
        } else {
        $x = 0;
        echo("<ul>");
            foreach ($meal['allergens'] as $val) {
                echo("<li>" . htmlentities($val, ENT_QUOTES, 'UTF-8') . "</li>\n");
            }
            echo("</ul>");
        }
        ?>

        <h1>Bewertungen (Insgesamt: <?php echo calcMeanStars($ratings); ?>)</h1>
        <form method="get">
            <label for="search_text">Filter:</label>
            <input id="search_text" type="text" name="search_text">
            <input type="submit" value="Suchen">
        </form>
        <table class="rating">
            <thead>
            <tr>
                <td>Text</td>
                <td>Sterne</td>
                <td>Autoren</td>
                <td>Preis intern</td>
                <td>Preis extern</td>
            </tr>
            </thead>
            <tbody>
            <?php
        foreach ($showRatings as $rating) {
            echo "<tr><td class='rating_text'>{$rating['text']}</td>
                      <td class='rating_stars'>{$rating['stars']}</td>
                      <td class='rating_author'>{$rating['author']}</td>
                      <td class='price_intern'>{$meal['price_intern']}</td>
                      <td class='price_extern'>{$meal['price_extern']}</td>
                  </tr>";
        }
        ?>
            </tbody>
        </table>
    </body>
</html>