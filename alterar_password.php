<?php
session_start();
require_once("includes/conexao_bd.php");
require_once("includes/funcoes.php");

$titulo = "Alterar Password";
$descricao = "Defina uma nova password para garantir o seu acesso seguro ao Centro Trevo.";
include_once("templates/header.php");

// Apenas terapeutas podem aceder
if (!isset($_SESSION['utilizador_id']) || $_SESSION['utilizador_tipo'] !== 'terapeuta') {
    echo "<p>Acesso restrito.</p>";
    exit;
}

// Processa submissão
$mensagem = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nova     = $_POST['nova_password'];
    $confirmar = $_POST['confirmar_password'];

    if (strlen($nova) < 6) {
        $mensagem = "<div class='msg-erro'>⚠️ A password deve ter pelo menos 6 caracteres.</div>";
    } elseif ($nova !== $confirmar) {
        $mensagem = "<div class='msg-erro'>⚠️ As passwords não coincidem.</div>";
    } else {
        $hash = password_hash($nova, PASSWORD_DEFAULT);
        $id = $_SESSION['utilizador_id'];

        $stmt = $conn->prepare("UPDATE utilizadores SET password = ?, reset_required = 0 WHERE id = ?");
        $stmt->bind_param("si", $hash, $id);
        $stmt->execute();

        $mensagem = "<div class='msg-sucesso'>✅ Password atualizada com sucesso. Pode agora aceder ao painel com total segurança.</div>";
    }
}
?>

<main>
    <section class="login-section">
        <div class="container">
            <h1>🔒 Alterar Password</h1>
            <p>Por motivos de segurança, pedimos que defina uma nova password pessoal.</p>

            <?= $mensagem ?>

            <form method="POST" class="form-login">
                <div class="form-grupo">
                    <label for="nova_password">Nova Password</label>
                    <input type="password" name="nova_password" required>
                </div>

                <div class="form-grupo">
                    <label for="confirmar_password">Confirmar Password</label>
                    <input type="password" name="confirmar_password" required>
                </div>

                <button type="submit" class="btn-nav">Alterar Password</button>
            </form>
        </div>
    </section>
</main>

<?php include_once("templates/footer.php"); ?>