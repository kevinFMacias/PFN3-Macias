const modal = document.getElementById('modal');
const cerrarBtn = document.getElementById('cerrar');
const tablaUsuarios = document.getElementById('infoUser');

cerrarBtn.addEventListener('click', () => {
    modal.classList.add('hidden');
});

const botonesEditar = document.querySelectorAll('.editar');

botonesEditar.forEach((boton) => {
    boton.addEventListener('click', function() {
        const fila = this.closest('tr');

        const email = fila.querySelector('td:nth-child(1)').textContent;
        const rol = fila.querySelector('td:nth-child(2)').textContent;

        document.getElementById('email').value = email;

        modal.classList.remove('hidden');
    });
});
