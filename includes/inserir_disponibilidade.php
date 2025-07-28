<?php
session_start();
require_once("conexao_bd.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utilizador_id = $_SESSION['utilizador_id'];
    $data = $_POST['data'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fim    = $_POST['hora_fim'];

    // Obtém terapeuta_id correto
    $stmt = $conn->prepare("SELECT id FROM terapeutas WHERE utilizador_id = ?");
    $stmt->bind_param("i", $utilizador_id);
    $stmt->execute();
    $stmt->bind_result($terapeuta_id);
    $stmt->fetch();
    $stmt->close();

    // Validação
    if (empty($terapeuta_id) || empty($data) || empty($hora_inicio) || empty($hora_fim)) {
        header("Location: ../dashboard_terapeuta.php?erro=campos");
        exit;
    }

    if (strtotime($hora_fim) <= strtotime($hora_inicio)) {
        header("Location: ../dashboard_terapeuta.php?erro=intervalo");
        exit;
    }

    // Verifica duplicação exata
    $stmt = $conn->prepare("SELECT id FROM disponibilidade WHERE terapeuta_id = ? AND data = ? AND hora_inicio = ?");
    $stmt->bind_param("iss", $terapeuta_id, $data, $hora_inicio);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        header("Location: ../dashboard_terapeuta.php?erro=duplicado");
        exit;
    }

    // Insere disponibilidade
    $stmt = $conn->prepare("INSERT INTO disponibilidade (terapeuta_id, data, hora_inicio, hora_fim, disponivel) VALUES (?, ?, ?, ?, 1)");
    $stmt->bind_param("isss", $terapeuta_id, $data, $hora_inicio, $hora_fim);
    $stmt->execute();

    header("Location: ../dashboard_terapeuta.php?sucesso=1");
    exit;
} else {
    echo "Acesso não autorizado.";
    exit;
}
