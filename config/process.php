<?php

session_start();

include_once(__DIR__ . "/connection.php");
include_once(__DIR__ . "/url.php");

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT, [
    "options" => ["min_range" => 1],
]);
$contacts = [];
$contact = null;

// Retorna o dado de um contato
if($id !== null && $id !== false) {
    $query = "SELECT * FROM contacts WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $contact = $stmt->fetch() ?: null;
} else {
    // Retorna todos os contatos
    $query = "SELECT * FROM contacts";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $contacts = $stmt->fetchAll();
}
