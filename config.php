<?php

# conexão com o banco
$db_host = 'localhost';
$db_name = 'test';
$db_user = 'root';
$db_password = '';
$dsn = "mysql:dbhost={$db_host};dbname={$db_name}";

$pdo = new PDO($dsn, $db_user, $db_password);

$array = [
    'error' => '',
    'result' => []
];
