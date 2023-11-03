const modal = document.querySelector('#modal');
const modalToggle = document.querySelector('#modalToggle');
const closeModal = document.querySelector('#closeModal');

modalToggle.addEventListener('click', function() {
    modal.classList.remove('hidden');
});

closeModal.addEventListener('click', function() {
    modal.classList.add('hidden');
});

const updateModal = document.querySelector('#updateModal');
const closeUpdateModal = document.querySelector('#closeUpdateModal');

function openUpdateModal(button) {
    const row = button.closest('tr');
    const id = row.cells[0].textContent;
    const nombre = row.cells[1].textContent;
    const apellidos = row.cells[2].textContent;
    const correo = row.cells[3].textContent;
    const direccion = row.cells[4].textContent;
    const fechaNacimiento = row.cells[5].textContent;

    document.getElementById('editNombre').value = nombre;
    document.getElementById('editCorreo').value = correo;
    document.getElementById('editApellidos').value = apellidos;
    document.getElementById('editDireccion').value = direccion;
    document.getElementById('editfecha_nacimiento').value = fechaNacimiento;
    document.getElementById('editId').value = id;

    updateModal.classList.remove('hidden');
}

closeUpdateModal.addEventListener('click', function() {
    updateModal.classList.add('hidden');
});
