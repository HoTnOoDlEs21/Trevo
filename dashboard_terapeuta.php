<?php
session_start();
require_once("includes/conexao_bd.php");
require_once("includes/funcoes.php");

$titulo = "Painel do Terapeuta";
$descricao = "Área de gestão de horários e agendamentos do terapeuta no Centro Trevo.";
include_once("templates/header.php");

// Verifica se está autenticado como terapeuta
if (!isset($_SESSION['utilizador_id']) || $_SESSION['utilizador_tipo'] !== 'terapeuta') {
    echo "<p>Acesso restrito. Por favor, inicie sessão como terapeuta.</p>";
    exit;
}

$utilizador_id = $_SESSION['utilizador_id'];

// Obtém ID real do terapeuta
$stmtID = $conn->prepare("SELECT id FROM terapeutas WHERE utilizador_id = ?");
$stmtID->bind_param("i", $utilizador_id);
$stmtID->execute();
$stmtID->bind_result($id_terapeuta);
$stmtID->fetch();
$stmtID->close();

// Verifica se precisa alterar password
$sql = "SELECT reset_required FROM utilizadores WHERE id = $utilizador_id";
$res = $conn->query($sql);
$dados = $res->fetch_assoc();

if ($dados['reset_required']) {
    echo "<div class='msg-erro'>⚠️ Por segurança, altere a sua password inicial <a href='alterar_password.php'>aqui</a>.</div>";
}
?>

<main>
    <?php if (isset($_GET['sucesso'])): ?>
        <div class="msg-sucesso">✅ Disponibilidade inserida com sucesso.</div>
    <?php elseif (isset($_GET['erro']) && $_GET['erro'] === 'campos'): ?>
        <div class="msg-erro">⚠️ Por favor preencha todos os campos.</div>
    <?php elseif (isset($_GET['erro']) && $_GET['erro'] === 'duplicado'): ?>
        <div class="msg-erro">⚠️ Já existe disponibilidade nesse horário.</div>
    <?php elseif (isset($_GET['erro']) && $_GET['erro'] === 'intervalo'): ?>
        <div class="msg-erro">⚠️ Hora final deve ser superior à hora inicial.</div>
    <?php endif; ?>

    <?php if (isset($_GET['removido'])): ?>
        <div class="msg-sucesso">✅ Horário removido com sucesso.</div>
    <?php endif; ?>

    <section class="dashboard-section">
        <div class="container">
            <h1>Disponibilidade Semanal</h1>
            <p>Selecione os dias e horários disponíveis para consultas.</p>

            <form action="includes/inserir_disponibilidade.php" method="POST" class="form-disponibilidade">
                <div class="form-grupo">
                    <label for="data">Data</label>
                    <input type="date" name="data" required min="<?= date('Y-m-d') ?>">
                </div>

                <div class="form-grupo">
                    <label for="hora_inicio">Hora Inicial</label>
                    <input type="time" name="hora_inicio" required>
                </div>

                <div class="form-grupo">
                    <label for="hora_fim">Hora Final</label>
                    <input type="time" name="hora_fim" required>
                </div>

                <button type="submit" class="btn-nav">Inserir Disponibilidade</button>
            </form>

            <!-- Listagem de disponibilidades -->
            <h2>Horários Ativos</h2>
            <table class="tabela-disponibilidade">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT id, data, hora_inicio, hora_fim
                  FROM disponibilidade
                  WHERE terapeuta_id = ? AND disponivel = 1
                  ORDER BY data ASC, hora_inicio ASC";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id_terapeuta);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?= formatarData($row['data']) ?></td>
                            <td><?= formatarHora($row['hora_inicio']) ?> - <?= formatarHora($row['hora_fim']) ?></td>
                            <td>
                                <form action="includes/remover_disponibilidade.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="btn-pequeno">Remover</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php include_once("templates/footer.php"); ?>