<?php

$config = require __DIR__ . "/database.php";

try {
    $host = $config["host"];
    $dbname = $config["dbname"];
    $charset = $config["charset"];

    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

    $conn = new PDO($dsn, $config["user"], $config["password"], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    // Erro na conexao
    $error = $e->getMessage();
    echo "Erro: $error";
}
