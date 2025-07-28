<?php
require_once("conexao_bd.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = intval($_POST['id']);
    $ativo = intval($_POST['ativo']);

    $sql = "UPDATE utilizadores SET ativo = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $ativo, $id);
    $stmt->execute();

    $acao = $ativo ? 'reativado' : 'suspenso';
    header("Location: ../dashboard_admin.php?acao=" . $acao);
    exit;
} else {
    echo "Acesso inválido.";
    exit;
}
