<?php
$titulo = "Psicologia Clínica";
$descricao = "Saiba mais sobre Psicologia Clínica no Centro Trevo: saúde emocional, comportamento e apoio à infância.";
include_once("templates/header.php");
?>

<main>
    <section class="terapia-detalhe">
        <div class="container">
            <h1>Psicologia Clínica</h1>

            <p class="texto-terapia texto-psicologia">
                A Psicologia Clínica no Centro Trevo apoia o desenvolvimento emocional e psicológico das crianças, contribuindo para o equilíbrio afetivo e comportamental desde a primeira infância.
            </p>

            <h2 class="h2-psicologia">Como atuamos com as famílias</h2>

            <p class="texto-terapia texto-psicologia">
                Acompanhamos crianças e seus cuidadores em situações de ansiedade, dificuldades escolares, autoestima, ou alterações do comportamento. Trabalhamos com escuta empática, recursos terapêuticos lúdicos e estratégias de desenvolvimento positivo.
            </p>

            <div class="galeria-terapia">
                <img src="images/terapias/PC1.jpg" alt="Sessão com criança em ambiente clínico acolhedor">
                <img src="images/terapias/PC2.jpg" alt="Atividades de expressão emocional">
                <img src="images/terapias/PC3.jpg" alt="Intervenção com apoio familiar">
            </div>

            <div class="botao-centro">
                <a href="agendamento.php" class="btn-nav">Agendar Consulta</a>
            </div>
        </div>
    </section>
</main>

<?php include_once("templates/footer.php"); ?>