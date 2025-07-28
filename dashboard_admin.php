<?php
session_start();
require_once("includes/conexao_bd.php");
require_once("includes/funcoes.php");

$titulo = "Painel Administrativo";
$descricao = "Área de gestão global do Centro Trevo — terapeutas, marcações e disponibilidade.";
include_once("templates/header.php");

// Verifica se é utilizador admin
if (!isset($_SESSION['utilizador_id']) || $_SESSION['utilizador_tipo'] !== 'admin') {
    echo "<p>Acesso restrito. Por favor inicie sessão como administrador.</p>";
    exit;
}
?>

<main>
    <section class="admin-section">
        <div class="container">
            <h1>Painel Administrativo</h1>
            <p>Gestão central dos profissionais e marcações no Centro Trevo.</p>

            <div class="admin-tabs">
                <nav class="tabs-menu">
                    <button data-tab="terapeutas" class="tab-btn active">👩‍⚕️ Terapeutas</button>
                    <button data-tab="agendamentos" class="tab-btn">📅 Agendamentos</button>
                    <button data-tab="acessos" class="tab-btn">👤 Acessos</button>
                </nav>

                <!-- Tab: Terapeutas -->
                <div id="tab-terapeutas" class="tab-conteudo active">
                    <div class="admin-bloco">
                        <h2>📋 Lista de Terapeutas</h2>
                        <table class="tabela-admin">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Especialidade</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $resultado = $conn->query("SELECT id, nome, especialidade FROM terapeutas ORDER BY nome");
                                while ($row = $resultado->fetch_assoc()):
                                ?>
                                    <tr>
                                        <td><?= $row['nome'] ?></td>
                                        <td><?= $row['especialidade'] ?></td>
                                        <td>
                                            <button class="btn-pequeno">Editar</button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab: Agendamentos -->
                <div id="tab-agendamentos" class="tab-conteudo">
                    <div class="admin-bloco">
                        <h2>📅 Agendamentos Recentes</h2>
                        <table class="tabela-admin">
                            <thead>
                                <tr>
                                    <th>Paciente</th>
                                    <th>Terapeuta</th>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Terapia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT a.paciente_nome, a.terapia, a.data, a.hora, t.nome AS terapeuta
                        FROM agendamentos a
                        JOIN terapeutas t ON a.terapeuta_id = t.id
                        ORDER BY a.data DESC, a.hora DESC
                        LIMIT 10";
                                $resultado = $conn->query($sql);
                                while ($row = $resultado->fetch_assoc()):
                                ?>
                                    <tr>
                                        <td><?= $row['paciente_nome'] ?></td>
                                        <td><?= $row['terapeuta'] ?></td>
                                        <td><?= !empty($row['data']) ? formatarData($row['data']) : "—" ?></td>
                                        <td><?= formatarHora($row['hora']) ?></td>
                                        <td><?= $row['terapia'] ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab: Acessos -->
                <div id="tab-acessos" class="tab-conteudo">
                    <div class="admin-bloco">
                        <h2>👤 Gestão de Acessos</h2>

                        <nav class="subtabs-menu">
                            <button data-subtab="criar" class="subtab-btn active">➕ Criar Novo</button>
                            <button data-subtab="gerir" class="subtab-btn">🛠️ Gerir Existentes</button>
                        </nav>

                        <!-- Subtab: Criar Novo -->
                        <div id="subtab-criar" class="subtab-conteudo active">
                            <?php if (isset($_GET['sucesso'])): ?>
                                <div class="msg-sucesso">✅ Terapeuta criado com sucesso.</div>
                            <?php elseif (isset($_GET['erro']) && $_GET['erro'] === 'email'): ?>
                                <div class="msg-erro">⚠️ Este email já está registado.</div>
                            <?php elseif (isset($_GET['erro']) && $_GET['erro'] === 'campos'): ?>
                                <div class="msg-erro">⚠️ Preencha todos os campos obrigatórios.</div>
                            <?php endif; ?>

                            <form action="includes/criar_utilizador.php" method="POST" class="form-login">
                                <div class="form-grupo">
                                    <label>Nome completo</label>
                                    <input type="text" name="nome" required>
                                </div>

                                <div class="form-grupo">
                                    <label>Email</label>
                                    <input type="email" name="email" required>
                                </div>

                                <div class="form-grupo">
                                    <label>Especialidade</label>
                                    <select name="especialidade" required>
                                        <option value="">Escolher...</option>
                                        <option value="Fala">Terapia da Fala</option>
                                        <option value="Ocupacional">Terapia Ocupacional</option>
                                        <option value="Psicologia">Psicologia Clínica</option>
                                    </select>
                                </div>

                                <div class="form-grupo">
                                    <label>Password inicial</label>
                                    <input type="password" name="password" required>
                                </div>

                                <button type="submit" class="btn-nav">Criar terapeuta</button>
                            </form>
                        </div>

                        <!-- Subtab: Gerir Existentes -->
                        <div id="subtab-gerir" class="subtab-conteudo">
                            <?php if (isset($_GET['acao']) && $_GET['acao'] === 'reativado'): ?>
                                <div class="msg-sucesso">✅ Terapeuta reativado com sucesso.</div>
                            <?php elseif (isset($_GET['acao']) && $_GET['acao'] === 'suspenso'): ?>
                                <div class="msg-erro">⛔ Terapeuta suspenso.</div>
                            <?php endif; ?>

                            <table class="tabela-admin">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Especialidade</th>
                                        <th>Estado</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT u.id, u.nome, u.email, u.ativo, t.especialidade
                          FROM utilizadores u
                          LEFT JOIN terapeutas t ON u.id = t.utilizador_id
                          WHERE u.tipo = 'terapeuta'
                          ORDER BY u.nome ASC";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()):
                                    ?>
                                        <tr>
                                            <td><?= $row['nome'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= $row['especialidade'] ?></td>
                                            <td><?= $row['ativo'] ? '✅ Ativo' : '⛔ Inativo' ?></td>
                                            <td>
                                                <form action="includes/atualizar_estado.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                    <input type="hidden" name="ativo" value="<?= $row['ativo'] ? 0 : 1 ?>">
                                                    <button type="submit" class="btn-pequeno">
                                                        <?= $row['ativo'] ? 'Suspender' : 'Reativar' ?>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="js/tabs_admin.js"></script>
<?php include_once("templates/footer.php"); ?>