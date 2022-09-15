<?php

$servername = "us-cdbr-east-06.cleardb.net";
$username = "bcf49ec099e821";
$password = "74f84abf";
$database = "heroku_4ff1a34193b770e";

$connect = new mysqli($servername, $username, $password, $database);

$connect->set_charset("utf8mb4");