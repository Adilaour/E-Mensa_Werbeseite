<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    "driver" => "mysql",
    "host" => "localhost",
    "database" => "<yourdatabasename>",
    "username" => "root",
    "password" => "<yourpassword>"
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();