/* ---------------- MODAL PACIENTE---------------- */
let pacienteModal = document.getElementById("pacienteModalOverlay");
let pacienteModalCard = document.getElementById("pacienteModalCard");

function openPacienteModal() {
    pacienteModal.classList.remove("hidden");
    setTimeout(() => {
        pacienteModalCard.classList.remove("scale-95", "opacity-0");
        pacienteModalCard.classList.add("scale-100", "opacity-100");
    }, 20);
}

function closePacienteModal() {
    pacienteModalCard.classList.add("scale-95", "opacity-0");
    setTimeout(() => pacienteModal.classList.add("hidden"), 150);
}

pacienteModal.addEventListener("click", function (e) {
    if (e.target === pacienteModal) closePacienteModal();
});