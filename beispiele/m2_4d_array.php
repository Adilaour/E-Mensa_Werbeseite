<?php
/**
 * Praktikum DBWT Autoren:
 * Adil, Aouragh, 3203789
 * Alexander, List, 3126569
 */
// Gegebener Array
$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => 2019]
];
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>Beste Gerichte</title>
    <!-- Styling aus Aufgabe5ab -->
    <style>
        ol li{
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<ol>
    <?php
    // Schleife für alle Meals
    foreach($famousMeals as $key => $value){
        // Der Name kann direkt innerhalb eines Listitems ausgegeben werden. Zeilenumbruch folgt durch Konkatenation.
        echo "<li>".$value['name']."<br>";
        // Die Jahreszahlen werden als Array angegeben. ABER: Bei der letzten Speise nicht! Da benötigen wir kein implode unf keine Kommata.
        if(is_array($value['winner'])){
            // Implode gibt Arrays als Zeichenkette aus, mit Trennzeichen(kette)
            echo implode(", ", $value['winner']);
        } else{
            echo $value['winner'];
        }
        echo "</li>";
    }
    echo "<h2>In den folgenden Jahren gab es keine Gewinner:</h2>";
    // Alle Jahre zwischen 2000 und 2020 werden geprüft.
    for($currentYear=2000; $currentYear<= 2020; $currentYear++){
        $yearHasWinner = false;
        // Erstmal die Meals öffnen.
        foreach($famousMeals as $key => $currentMeal){
            // Wenn die Jahre des CurrentMeal als Array übergegeben werden, dann prüfen wir jedes einzelne.
            if(!is_array($currentMeal['winner'])){
                $yearHasWinner = $currentMeal['winner'] == $currentYear;
                if ($yearHasWinner)
                    break;
            } else{
                // Jahre als Array, also weitere Schleife nötig.
                foreach ($currentMeal['winner'] as $winneryear) {
                    $yearHasWinner = $winneryear == $currentYear;
                    if ($yearHasWinner)
                        break;
                }
            }
            if ($yearHasWinner)
                break;
        }
        if (!$yearHasWinner){
            echo "Im Jahr ".$currentYear." gab es keinen Gewinner.<br>";
        }
    }
    ?>
    </ol>
</body>
</html>
