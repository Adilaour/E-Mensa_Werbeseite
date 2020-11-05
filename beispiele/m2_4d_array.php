<?php
/**
 * Praktikum DBWT Autoren:
 * Adil, Aouragh, 3203789
 * Alexander, List, 3126569
 */

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
    <title>Bester Gerichte</title>
</head>
<body>
<ol>
    <?php
    foreach($famousMeals as $key => $value){
        echo "<li>".$value['name']."<br>";
        if(is_array($value['winner'])){
            echo implode(", ", $value['winner']);
        } else{
            echo $value['winner'];
        }
        echo "</li>";
    }
    echo "<h2>In den folgenden Jahren gab es keine Gewinner:</h2>";

    for($currentYear=2000; $currentYear<= 2020; $currentYear++){

        $yearHasWinner = false;

        foreach($famousMeals as $key => $currentMeal){

            if(!is_array($currentMeal['winner'])){
                $yearHasWinner = $currentMeal['winner'] == $currentYear;
                if ($yearHasWinner)
                    break;
            } else{
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
