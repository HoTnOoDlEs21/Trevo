<?php
require_once("conexao_bd.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    // Desativa disponibilidade (não apaga)
    $stmt = $conn->prepare("UPDATE disponibilidade SET disponivel = 0 WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: ../dashboard_terapeuta.php?removido=1");
    exit;
} else {
    echo "Acesso inválido.";
    exit;
}
