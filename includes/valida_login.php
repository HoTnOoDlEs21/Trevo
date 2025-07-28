<?php
session_start();
require_once("conexao_bd.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    // Busca utilizador pelo email
    $sql = "SELECT id, nome, password, tipo, ativo FROM utilizadores WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $user = $resultado->fetch_assoc();

        // Verifica se está ativo e se a password está correta
        if ($user['ativo'] && password_verify($password, $user['password'])) {
            // Autentica e guarda sessão
            $_SESSION['utilizador_id']   = $user['id'];
            $_SESSION['utilizador_nome'] = $user['nome'];
            $_SESSION['utilizador_tipo'] = $user['tipo'];

            // Redireciona para o painel correspondente
            if ($user['tipo'] === 'admin') {
                header("Location: ../dashboard_admin.php");
                exit;
            } elseif ($user['tipo'] === 'terapeuta') {
                header("Location: ../dashboard_terapeuta.php");
                exit;
            }
        }
    }

    // Se falhar: volta para login com erro
    header("Location: ../login.php?erro=1");
    exit;
} else {
    echo "Acesso inválido.";
    exit;
}
