<?php

session_start();

include_once(__DIR__ . "/connection.php");
include_once(__DIR__ . "/url.php");

$isPostRequest = ($_SERVER["REQUEST_METHOD"] ?? "GET") === "POST";

// MODIFICACOES NO BANCO
if($isPostRequest) {
    $type = $_POST["type"] ?? "";

    if($type === "create") {
        $name = trim($_POST["name"] ?? "");
        $phone = trim($_POST["phone"] ?? "");
        $observations = trim($_POST["observations"] ?? "");

        if($name === "" || $phone === "") {
            $_SESSION["msg"] = "Preencha o nome e o telefone do contato.";
        } else {
            $query = "INSERT INTO contacts (name, phone, observations) VALUES (:name, :phone, :observations)";
            $stmt = $conn->prepare($query);

            try {
                $stmt->execute([
                    ":name" => $name,
                    ":phone" => $phone,
                    ":observations" => $observations,
                ]);
                $_SESSION["msg"] = "Contato criado com sucesso!";
            } catch(PDOException $e) {
                $_SESSION["msg"] = "Nao foi possivel criar o contato.";
            }
        }
    } elseif($type === "edit") {
        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT, [
            "options" => ["min_range" => 1],
        ]);
        $name = trim($_POST["name"] ?? "");
        $phone = trim($_POST["phone"] ?? "");
        $observations = trim($_POST["observations"] ?? "");

        if($id === null || $id === false || $name === "" || $phone === "") {
            $_SESSION["msg"] = "Nao foi possivel atualizar o contato.";
        } else {
            $query = "UPDATE contacts SET name = :name, phone = :phone, observations = :observations WHERE id = :id";
            $stmt = $conn->prepare($query);

            try {
                $stmt->execute([
                    ":id" => $id,
                    ":name" => $name,
                    ":phone" => $phone,
                    ":observations" => $observations,
                ]);
                $_SESSION["msg"] = "Contato atualizado com sucesso!";
            } catch(PDOException $e) {
                $_SESSION["msg"] = "Nao foi possivel atualizar o contato.";
            }
        }
    } else {
        $_SESSION["msg"] = "Operacao invalida.";
    }

    // Usa GET apos o envio para evitar recriar o contato ao atualizar a pagina.
    header("Location: " . $BASE_URL . "../index.php", true, 303);
    exit;
} else { // SELEÇÃO DE DADOS
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
}

// Fechar conexão
$conn = null;
