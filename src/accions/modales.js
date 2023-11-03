const openModalBtn = document.getElementById('abrirModal');
const modalOverlay = document.getElementById('modalAdd'); // Cambiado de document.querySelector('.modalAdd')
const closeBtn = document.getElementById('cerrarModalAdd');
const updateModal = document.getElementById('modalEdit'); // Cambiado de document.querySelector('#modalEdit')
const closeUpdateModal = document.getElementById('cerrarModalEdit');

openModalBtn.addEventListener('click', () => {
    modalOverlay.classList.remove('hidden');
});

closeBtn.addEventListener('click', () => {
    modalOverlay.classList.add('hidden');
});

closeUpdateModal.addEventListener('click', () => {
    updateModal.classList.add('hidden');
});

function openUpdateModal(button) {
    const row = button.closest('tr');
    const id = row.cells[0].textContent;
    const dni = row.cells[1].textContent;
    const nombre = row.cells[2].textContent;
    const apellidos = row.cells[3].textContent;
    const email = row.cells[4].textContent;
    const direccion = row.cells[5].textContent;
    const fechaNacimiento = row.cells[6].textContent;

    document.getElementById('editId').value = id;
    document.getElementById('editDni').value = dni;
    document.getElementById('editNombre').value = nombre;
    document.getElementById('editApellidos').value = apellidos;
    document.getElementById('editEmail').value = email;
    document.getElementById('editDireccion').value = direccion;
    document.getElementById('editFechaNacimiento').value = fechaNacimiento;

    updateModal.classList.remove('hidden');
}
