/* ---------------- CRIAR PACIENTE AJAX ---------------- */
document.getElementById("btnSalvarPaciente").addEventListener("click", function () {
    const form = document.getElementById("formPaciente");
    const formData = new FormData(form);

    fetch("/pacientes", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content") },
        body: formData
    })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                alert(res.message);
                closePacienteModal();
                location.reload(); // Atualiza select de pacientes
            }
        })
        .catch(err => console.error(err));
});