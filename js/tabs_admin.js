document.querySelectorAll('.tab-btn').forEach((btn) => {
    btn.addEventListener('click', () => {
        // Ativa botão clicado
        document
            .querySelectorAll('.tab-btn')
            .forEach((b) => b.classList.remove('active'));
        btn.classList.add('active');

        // Mostra conteúdo correspondente
        const tab = btn.getAttribute('data-tab');
        document
            .querySelectorAll('.tab-conteudo')
            .forEach((sec) => sec.classList.remove('active'));
        document.getElementById('tab-' + tab).classList.add('active');
    });
});

document.querySelectorAll('.subtab-btn').forEach((btn) => {
    btn.addEventListener('click', () => {
        document
            .querySelectorAll('.subtab-btn')
            .forEach((b) => b.classList.remove('active'));
        btn.classList.add('active');

        const subtab = btn.getAttribute('data-subtab');
        document
            .querySelectorAll('.subtab-conteudo')
            .forEach((sec) => sec.classList.remove('active'));
        document.getElementById('subtab-' + subtab).classList.add('active');
    });
});
