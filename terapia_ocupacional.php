<?php
$titulo = "Terapia Ocupacional";
$descricao = "Saiba mais sobre a Terapia Ocupacional no Centro Trevo: desenvolvimento infantil, autonomia e bem-estar.";
include_once("templates/header.php");
?>

<main>
    <section class="terapia-detalhe">
        <div class="container">
            <h1>Terapia Ocupacional</h1>

            <p class="texto-terapia texto-ocupacional">
                A Terapia Ocupacional promove o desenvolvimento motor, cognitivo, emocional e sensorial da criança,
                através de atividades lúdicas e funcionais, personalizadas para cada etapa do crescimento.
            </p>

            <h2 class="h2-ocupacional">Como funciona no Centro Trevo</h2>

            <p class="texto-terapia texto-ocupacional">
                Cada criança é avaliada individualmente e acompanhada por um plano terapêutico específico. Utilizamos jogos,
                movimentos e estímulos sensoriais que favorecem a autonomia, a integração social e a confiança emocional.
            </p>

            <div class="galeria-terapia">
                <img src="images/terapias/TO1.jpg" alt="Sessão de terapia com brinquedos">
                <img src="images/terapias/TO2.jpg" alt="Estimulação sensorial com blocos">
                <img src="images/terapias/TO3.jpg" alt="Atividades motoras em sala">
            </div>

            <div class="botao-centro">
                <a href="agendamento.php" class="btn-nav">Agendar Consulta</a>
            </div>
        </div>
    </section>
</main>

<?php include_once("templates/footer.php"); ?>