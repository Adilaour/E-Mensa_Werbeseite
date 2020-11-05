<?php
/**
 * Praktikum DBWT Autoren:
 * Adil, Aouragh, 3203789
 * Alexander, List, 3126569
 */

$logfile=fopen('accesslog.txt', 'a');                                     // Datei wird geöffnet.

// Hier setze ich die Variablen mit den Informationen für die Zeile
$datum=date("m.d.Y - H:i:s");
$browser=$_SERVER['HTTP_USER_AGENT'];
$ipclient=$_SERVER['REMOTE_ADDR'];


$newline="DATE - TIME: ".$datum." || "."USER_AGENT: ".$browser." || "."CLIENT_IP: ".$ipclient."\n";

fwrite($logfile,$newline);                                                              // Neue Zeile wird in die geöffnete Datei geschrieben.
fclose($logfile);