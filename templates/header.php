<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titulo) ? "$titulo | Trevo" : "Trevo – Centro de Terapias" ?></title>
    <meta name="description" content="<?= isset($descricao) ? $descricao : 'Centro Trevo — Terapia da fala, ocupacional e psicologia clínica para crianças, com foco no desenvolvimento e acolhimento familiar.' ?>">
    <meta name="keywords" content="trevo, terapias infantis, terapia da fala, ocupacional, psicologia clínica, desenvolvimento infantil, centro terapêutico, acompanhamento infantil, agendamento, porto, rio tinto">
    <meta name="robots" content="<?= (isset($noindex) && $noindex) ? 'noindex, nofollow' : 'index, follow' ?>">
    <link rel="canonical" href="https://www.centrotrevo.pt/">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <!-- Fontes e estilos -->
    <link href="css/style.css?v=1.1" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/265e8c9848.js" crossorigin="anonymous"></script>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    $currentPage = basename($_SERVER['PHP_SELF']);
    $isIndex     = $currentPage === 'index.php';
    $base        = $isIndex ? '' : 'index.php';
    ?>

    <header>
        <div class="header-container">
            <a href="index.php" class="logo" aria-label="Centro Trevo">
                <div class="logo-bg">
                    <img src="images/logotrevo_limpo2.svg" alt="Centro Trevo" class="logo-img">
                </div>
            </a>

            <button class="menu-toggle" aria-label="Abrir menu de navegação">
                <i class="fas fa-bars"></i>
            </button>

            <nav class="nav-right">
                <ul class="navbar">
                    <li><a href="index.php">Início</a></li>
                    <li><a href="<?= $base ?>#especialidades">Especialidades</a></li>
                    <li><a href="<?= $base ?>#sobre-nos">Sobre Nós</a></li>
                    <li><a href="<?= $base ?>#contactos">Contactos</a></li>
                    <li><a href="recursos.php">Recursos</a></li>


                    <?php if (isset($_SESSION['utilizador_id'])): ?>
                        <?php
                        $nome_utilizador = htmlspecialchars($_SESSION['utilizador_nome']);
                        $dashboard_link = ($_SESSION['utilizador_tipo'] === 'terapeuta') ? "dashboard_terapeuta.php" : "dashboard_admin.php";
                        ?>
                        <li><a href="<?= $dashboard_link ?>">Olá, <?= $nome_utilizador ?></a></li>
                    <?php else: ?>
                        <li><a href="login.php">Área Reservada</a></li>
                    <?php endif; ?>
                </ul>

                <a href="agendamento.php" class="btn-nav">Agendar Consulta</a>

                <?php if (isset($_SESSION['utilizador_id'])): ?>
                    <a href="includes/logout.inc.php" class="btn-nav">Terminar Sessão</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>