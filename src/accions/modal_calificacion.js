function abrirModal(button) {
    const modal = document.getElementById('modal');
    
    modal.classList.remove('hidden');

    const calificacionId = button.getAttribute('id_usuario');

    const calificacionIdField = document.querySelector('input[name="id_user"]');
    calificacionIdField.value = calificacionId;
}

function cerrarModal() {
    const modal = document.getElementById('modal');

    modal.classList.add('hidden');
}
