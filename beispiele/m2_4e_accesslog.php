<?php
/**
 * Praktikum DBWT Autoren:
 * Adil, Aouragh, 3203789
 * Alexander, List, 3126569
 */
// Datei wird geöffnet.
$logfile=fopen('accesslog.txt', 'a');
// Variablen mit den Informationen für die Zeile füllen
$datum=date("m.d.Y - H:i:s");
$browser=$_SERVER['HTTP_USER_AGENT'];
$ipclient=$_SERVER['REMOTE_ADDR'];
// Neue Zeile direkt mit Inhalten füllen.
$newline="DATE - TIME: ".$datum." || "."USER_AGENT: ".$browser." || "."CLIENT_IP: ".$ipclient."\n";
// Neue Zeile wird in die geöffnete Datei geschrieben.
fwrite($logfile,$newline);
// Datei schließen!!!
fclose($logfile);