<?php
require_once("includes/conexao_bd.php");
require_once("includes/funcoes.php");

$titulo = "Agendamento";
$descricao = "Marque online a sua consulta no Centro Trevo — Terapia da Fala, Ocupacional ou Psicologia Clínica.";
include_once("templates/header.php");

// Preserva valores do formulário após submissão
$nome_valor      = $_POST['nome']      ?? '';
$email_valor     = $_POST['email']     ?? '';
$terapia_valor   = $_POST['terapia']   ?? '';
$terapeuta_valor = $_POST['terapeuta'] ?? '';
$data_valor      = $_POST['data']      ?? '';
$hora_valor      = $_POST['hora']      ?? '';
?>

<main>
    <section class="agendamento-section">
        <div class="container">
            <h1>Agendamento de Consulta</h1>

            <p class="intro-agendamento">
                Escolha a especialidade, terapeuta disponível e horário para a consulta. Os agendamentos são feitos em blocos de 1 hora e confirmados via email.
            </p>

            <?php if (isset($_GET['sucesso'])): ?>
                <div class="msg-sucesso">
                    ✅ Consulta agendada com sucesso! Irá receber confirmação por email.
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['erro'])): ?>
                <div class="msg-erro">
                    ⚠️ Ocorreu um problema ao tentar agendar. Verifique os dados e tente novamente.
                </div>
            <?php endif; ?>

            <form action="includes/processa_agendamento.php" method="POST" class="form-agendamento">
                <div class="form-grupo">
                    <label for="nome">Nome do Encarregado</label>
                    <input type="text" name="nome" required value="<?= htmlspecialchars($nome_valor) ?>">
                </div>

                <div class="form-grupo">
                    <label for="email">Email</label>
                    <input type="email" name="email" required value="<?= htmlspecialchars($email_valor) ?>">
                </div>

                <div class="form-grupo">
                    <label for="terapia">Especialidade</label>
                    <select name="terapia" required>
                        <option value="">Escolher...</option>
                        <option value="Fala" <?= $terapia_valor === "Fala" ? 'selected' : '' ?>>Terapia da Fala</option>
                        <option value="Ocupacional" <?= $terapia_valor === "Ocupacional" ? 'selected' : '' ?>>Terapia Ocupacional</option>
                        <option value="Psicologia" <?= $terapia_valor === "Psicologia" ? 'selected' : '' ?>>Psicologia Clínica</option>
                    </select>
                </div>

                <div class="form-grupo">
                    <label for="terapeuta">Terapeuta</label>
                    <select name="terapeuta" required>
                        <option value="">Escolher...</option>
                        <?php
                        $resultado = $conn->query("SELECT id, nome, especialidade FROM terapeutas ORDER BY nome");
                        while ($row = $resultado->fetch_assoc()) {
                            $selected = ($row['id'] == $terapeuta_valor) ? 'selected' : '';
                            echo "<option value='{$row['id']}' $selected>{$row['nome']} ({$row['especialidade']})</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-grupo">
                    <label for="data">Data</label>
                    <input type="date" name="data" id="data-agendamento" required min="<?= date('Y-m-d') ?>" value="<?= htmlspecialchars($data_valor) ?>">
                </div>

                <div class="form-grupo">
                    <label for="hora">Horário</label>
                    <select name="hora" required>
                        <?php if ($hora_valor): ?>
                            <option value="<?= $hora_valor ?>" selected><?= substr($hora_valor, 0, 5) ?>h</option>
                        <?php else: ?>
                            <option value="">Escolha um terapeuta e uma data primeiro</option>
                        <?php endif; ?>
                    </select>
                </div>

                <button type="submit" class="btn-nav">Agendar Consulta</button>
            </form>
        </div>
    </section>
</main>

<?php include_once("templates/footer.php"); ?>
<script src="js/agendamento.js"></script>