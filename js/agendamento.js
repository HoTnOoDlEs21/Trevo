document
    .querySelector('select[name="terapeuta"]')
    .addEventListener('change', carregarHorarios);
document
    .querySelector('input[name="data"]')
    .addEventListener('change', carregarHorarios);

function carregarHorarios() {
    const terapeuta = document.querySelector('select[name="terapeuta"]').value;
    const data = document.querySelector('input[name="data"]').value;
    const selectHora = document.querySelector('select[name="hora"]');

    // Limpa sempre antes
    selectHora.innerHTML = '';
    const defaultOpt = document.createElement('option');
    defaultOpt.value = '';
    defaultOpt.textContent = 'Escolher...';
    selectHora.appendChild(defaultOpt);

    if (!terapeuta || !data) return;

    fetch(
        `includes/horarios_disponiveis.php?terapeuta=${terapeuta}&data=${data}`
    )
        .then((res) => res.json())
        .then((horarios) => {
            if (horarios.length === 0) {
                const opt = document.createElement('option');
                opt.value = '';
                opt.textContent = 'Sem horários disponíveis';
                selectHora.appendChild(opt);
                return;
            }

            horarios.forEach((hora) => {
                const opt = document.createElement('option');
                opt.value = hora;
                opt.textContent = hora.substring(0, 5) + 'h';
                selectHora.appendChild(opt);
            });
        });
}
