<?php
$titulo = "Terapia da Fala";
$descricao = "Saiba mais sobre a Terapia da Fala no Centro Trevo: linguagem, articulação e comunicação infantil.";
include_once("templates/header.php");
?>

<main>
    <section class="terapia-detalhe">
        <div class="container">
            <h1>Terapia da Fala</h1>

            <p class="texto-terapia texto-fala">
                A Terapia da Fala atua sobre a comunicação, a linguagem oral e escrita, a articulação dos sons e a expressão da criança, sempre com uma abordagem lúdica e acolhedora.
            </p>

            <h2 class="h2-fala">Como trabalhamos no Centro Trevo</h2>

            <p class="texto-terapia texto-fala">
                Cada criança é acompanhada com empatia, respeitando o seu ritmo e necessidades. Trabalhamos competências linguísticas, fluência, respiração e audição, criando um ambiente que favorece a interação e o progresso.
            </p>

            <div class="galeria-terapia">
                <img src="images/terapias/TF1.jpg" alt="Sessão de fala com jogos fonéticos">
                <img src="images/terapias/TF2.jpg" alt="Atividades lúdicas de linguagem">
                <img src="images/terapias/TF3.jpg" alt="Intervenção com cartões de imagem">
            </div>

            <div class="botao-centro">
                <a href="agendamento.php" class="btn-nav">Agendar Consulta</a>
            </div>
        </div>
    </section>
</main>

<?php include_once("templates/footer.php"); ?>