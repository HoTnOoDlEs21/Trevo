<?php
$titulo = "Centro Trevo";
$descricao = "Centro Trevo — Terapias para crianças. Acolhimento familiar, desenvolvimento infantil e acompanhamento especializado.";
include_once("templates/header.php");
?>

<main>
    <!-- Hero Section -->
    <section id="hero-trevo" class="hero-section">
        <div class="hero-bg">
            <img src="images/imghero1.png" alt="Criança em ambiente terapêutico" class="hero-img" loading="lazy">
            <div class="hero-overlay">
                <div class="hero-content container">
                    <h1 class="hero-title">Centro Trevo</h1>
                    <p class="hero-subtitle">Acolhemos com afeto. Cuidamos com ciência.</p>
                    <a href="agendamento.php" class="btn-nav">Agendar Consulta</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Especialidades -->
    <section id="especialidades" class="especialidades-section">
        <div class="container">
            <h2>As nossas especialidades terapêuticas</h2>
            <p class="subtexto">No Centro Trevo, cada criança é acompanhada com atenção, carinho e ciência.</p>

            <div class="especialidades-grid">

                <!-- Terapia Ocupacional -->
                <div class="card-especialidade card-ocupacional">
                    <div class="card-conteudo">
                        <h3>Terapia Ocupacional</h3>
                        <p>Promove o desenvolvimento motor, cognitivo e emocional através de atividades significativas.</p>
                        <small>⤷ Terapeuta responsável: Ana Pereira</small>
                        <a href="terapia_ocupacional.php" class="btn-especialidade">Saber mais</a>
                    </div>
                </div>

                <!-- Terapia da Fala -->
                <div class="card-especialidade card-fala">
                    <div class="card-conteudo">
                        <h3>Terapia da Fala</h3>
                        <p>Intervém na linguagem, articulação, compreensão e expressão oral, adaptada à infância.</p>
                        <a href="terapia_fala.php" class="btn-especialidade">Saber mais</a>
                    </div>
                </div>

                <!-- Psicologia Clínica -->
                <div class="card-especialidade card-psicologia">
                    <div class="card-conteudo">
                        <h3>Psicologia Clínica</h3>
                        <p>Foca-se na saúde emocional, comportamento, autoestima e bem-estar da criança e família.</p>
                        <a href="psicologia_clinica.php" class="btn-especialidade">Saber mais</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Sobre nós -->
    <section id="sobre-nos" class="sobre-nos-section">
        <div class="container">
            <h2 class="h2-ocupacional">Sobre Nós</h2>

            <p class="texto-terapia texto-ocupacional">
                No Centro Trevo acreditamos que cada criança é única. O nosso compromisso é acolher com afeto, atuar com ciência
                e caminhar lado a lado com as famílias na construção de um desenvolvimento saudável e feliz.
            </p>

            <h3 class="equipa-subtitulo">A nossa equipa terapêutica</h3>

            <div class="equipa-terapeutas">
                <div class="terapeuta">
                    <img src="images/equipa/ana.png" alt="Ana Pereira — Terapeuta Ocupacional">
                    <p><strong>Ana Pereira</strong><br>Terapeuta Ocupacional</p>
                </div>
                <div class="terapeuta">
                    <img src="images/equipa/beatriz.png" alt="Beatriz Silva — Terapeuta da Fala">
                    <p><strong>Beatriz Silva</strong><br>Terapeuta da Fala</p>
                </div>
                <div class="terapeuta">
                    <img src="images/equipa/clara.png" alt="Clara Fernandes — Psicóloga Clínica">
                    <p><strong>Clara Fernandes</strong><br>Psicóloga Clínica</p>
                </div>
            </div>

            <a href="agendamento.php" class="btn-nav">Agendar Consulta</a>
        </div>
    </section>

    <!-- Outras secções podem ser adicionadas aqui... -->
</main>

<!-- Contactos -->
<section id="contactos" class="contactos-section">
    <div class="container">
        <h2 class="h2-psicologia">Contactos</h2>

        <div class="contactos-colunas">
            <!-- Coluna Esquerda: Dados + Mapa -->
            <div class="contacto-dados">
                <p><i class="fas fa-map-marker-alt"></i> R. da Castanheira 439<br>4435-158 Rio Tinto, Porto</p>
                <p><i class="fas fa-envelope"></i> <a href="mailto:geral@centrotrevo.pt">geral@centrotrevo.pt</a></p>
                <p><i class="fas fa-phone-alt"></i> <a href="tel:+351912345678">+351 912 345 678</a></p>
                <p><i class="fas fa-clock"></i> Segunda a Sexta<br>09:00 — 18:30</p>

                <div class="mapa-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2993.846775365097!2d-8.5735196!3d41.1793853!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd24702f45ae4c95%3A0x6d32d2856f83ae3b!2sR.%20da%20Castanheira%20439%2C%204435-158%20Rio%20Tinto!5e0!3m2!1spt-PT!2spt!4v1721390000000"
                        width="100%"
                        height="240"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- Coluna Direita: Formulário -->
            <div class="contacto-formulario">
                <form action="includes/enviar_mensagem.php" method="POST">
                    <input type="text" name="nome" placeholder="Nome" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <textarea name="mensagem" rows="5" placeholder="Escreva a sua mensagem..." required></textarea>
                    <button type="submit" class="btn-nav">Enviar Mensagem</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include_once("templates/footer.php"); ?>