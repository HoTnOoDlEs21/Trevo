<?php
require_once("conexao_bd.php");
require_once("funcoes.php"); // ✅ inclui funções personalizadas

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome         = limparTexto($_POST['nome']);
    $email        = strtolower(trim($_POST['email'])); // email mantemos com trim
    $especialidade = limparTexto($_POST['especialidade']);
    $password     = $_POST['password'];

    // Validação básica
    if (empty($nome) || empty($email) || empty($especialidade) || empty($password)) {
        header("Location: ../dashboard_admin.php?erro=campos");
        exit;
    }

    // Verifica duplicação de email
    $verifica = $conn->prepare("SELECT id FROM utilizadores WHERE email = ?");
    $verifica->bind_param("s", $email);
    $verifica->execute();
    $verifica->store_result();

    if ($verifica->num_rows > 0) {
        header("Location: ../dashboard_admin.php?erro=email");
        exit;
    }

    // Cria utilizador com password encriptada
    $hash = criarHashPassword($password); // ✅ usa função personalizada
    $insereUser = $conn->prepare("
    INSERT INTO utilizadores (nome, email, password, tipo, reset_required)
    VALUES (?, ?, ?, 'terapeuta', 1)
  ");
    $insereUser->bind_param("sss", $nome, $email, $hash);
    $insereUser->execute();

    $utilizador_id = $conn->insert_id;

    // Cria terapeuta associado
    $insereTerapeuta = $conn->prepare("
    INSERT INTO terapeutas (nome, especialidade, utilizador_id)
    VALUES (?, ?, ?)
  ");
    $insereTerapeuta->bind_param("ssi", $nome, $especialidade, $utilizador_id);
    $insereTerapeuta->execute();

    header("Location: ../dashboard_admin.php?sucesso=1");
    exit;
} else {
    echo "Acesso inválido.";
    exit;
}
