buttonToggle.addEventListener('click', () => {
    toggleMenu.classList.toggle('hidden');
})

document.addEventListener("DOMContentLoaded", function() {
    const deleteButtons = document.querySelectorAll(".deleteBtn");

    deleteButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            const row = button.closest("tr");
            const id = row.cells[0].textContent;

            const hiddenInput = button.closest("form").querySelector(".editId");

            hiddenInput.value = id;
        });
    });
});