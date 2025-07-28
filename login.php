<?php
session_start();
require_once("includes/conexao_bd.php");

$titulo = "Login";
$descricao = "Acesso restrito a terapeutas e administração do Centro Trevo.";
include_once("templates/header.php");
?>

<main>
    <section class="login-section">
        <div class="container">
            <h1>Acesso ao Sistema</h1>
            <p>Insira os seus dados para entrar no painel restrito.</p>

            <?php if (isset($_GET['erro'])): ?>
                <div class="msg-erro">⚠️ Credenciais inválidas. Tente novamente.</div>
            <?php endif; ?>

            <form action="includes/valida_login.php" method="POST" class="form-login">
                <div class="form-grupo">
                    <label for="email">Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-grupo">
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                </div>

                <button type="submit" class="btn-nav">Entrar</button>
            </form>
        </div>
    </section>
</main>

<?php include_once("templates/footer.php"); ?>