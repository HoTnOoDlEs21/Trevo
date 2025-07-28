<?php
$titulo = "Recursos para Famílias";
$descricao = "Materiais de apoio, guias e artigos úteis para o desenvolvimento infantil no Centro Trevo.";
include_once("templates/header.php");
?>

<main>
    <section class="recursos-section">
        <div class="container">
            <h1 class="h2-ocupacional">Recursos para Famílias</h1>

            <p class="texto-terapia texto-ocupacional">
                Criámos este espaço para partilhar conteúdos práticos e informativos que ajudam a acompanhar o desenvolvimento das crianças. Desde rotinas saudáveis a estratégias de regulação emocional — aqui encontra apoio direto do Trevo.
            </p>

            <div class="recursos-grid">
                <!-- Recurso 1 -->
                <div class="recurso-card">
                    <i class="fas fa-file-alt"></i>
                    <h4>Guia: Rotinas Saudáveis</h4>
                    <p>Equilíbrio entre brincadeira, descanso e aprendizagem.</p>
                    <a href="#" class="btn-nav">Ver Guia</a>
                </div>

                <!-- Recurso 2 -->
                <div class="recurso-card">
                    <i class="fas fa-child"></i>
                    <h4>Regulação Emocional</h4>
                    <p>Atividades simples para lidar com emoções intensas.</p>
                    <a href="#" class="btn-nav">Ver Dicas</a>
                </div>

                <!-- Recurso 3 -->
                <div class="recurso-card">
                    <i class="fas fa-comments"></i>
                    <h4>Promoção da Comunicação</h4>
                    <p>Como estimular linguagem desde os primeiros anos.</p>
                    <a href="#" class="btn-nav">Ver Artigo</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include_once("templates/footer.php"); ?>