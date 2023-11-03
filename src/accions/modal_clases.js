const modal = document.querySelector('#modalAdd');
const modalToggle = document.querySelector('#modalToggle');
const closeModal = document.querySelector('#closeModal');

modalToggle.addEventListener('click', function () {
    modal.classList.remove('hidden');
});

closeModal.addEventListener('click', function () {
    modal.classList.add('hidden');
});

document.addEventListener("DOMContentLoaded", function () {
    const openModal = document.querySelectorAll(".updateModal");

    openModal.forEach(function (button) {
        button.addEventListener("click", function () {
            updateModal.classList.remove('hidden');
        });
    });
});

const closeUpdateModal = document.querySelector('#closeUpdateModal');
closeUpdateModal.addEventListener('click', function () {
    updateModal.classList.add('hidden');
});





// const updateModal = document.querySelector('#updateModal');
// const updateModalToggle = document.querySelector('#modalUpdateToggle');

// updateModalToggle.addEventListener('click', function () {
// });

