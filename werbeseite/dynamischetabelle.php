<?php
/*
$gerichte = [];
include 'gerichte.php';
echo var_dump($gerichte);
*/
$gerichte=[];
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
                <td><img alt="Nicht gefunden"></td>
                <td ><?php print_r($gerichte[1]['name'])?></td>
                <td><?php print_r($gerichte[1]['preisintern'])?></td>
                <td><?php print_r($gerichte[1]['preisextern'])?></td>
            </tr>
            <tr>
                <td><img alt="Nicht gefunden"></td>
                <td ><?php print_r($gerichte[2]['name'])?></td>
                <td><?php print_r($gerichte[2]['preisintern'])?></td>
                <td><?php print_r($gerichte[2]['preisextern'])?></td>
            </tr>
            <tr>
                <td><img alt="Nicht gefunden"></td>
                <td ><?php print_r($gerichte[3]['name'])?></td>
                <td><?php print_r($gerichte[3]['preisintern'])?></td>
                <td><?php print_r($gerichte[3]['preisextern'])?></td>
            </tr>
            <tr>
                <td><img alt="Nicht gefunden"></td>
                <td ><?php print_r($gerichte[4]['name'])?></td>
                <td><?php print_r($gerichte[4]['preisintern'])?></td>
                <td><?php print_r($gerichte[4]['preisextern'])?></td>
            </tr>
        </table>