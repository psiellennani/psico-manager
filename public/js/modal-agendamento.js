/* ---------------- MODAL DE AGENDAMENTO ---------------- */

const modal = document.getElementById("modalOverlay");
const modalCard = document.getElementById("modalCard");

// FUNÇÃO DE LIMPEZA TOTAL (chamada SEMPRE ao abrir o modal)
function resetarModal() {
    const form = document.getElementById("formAgendamento");
    if (form) form.reset(); // limpa todos os campos do <form>

    // Limpa campos que às vezes não são resetados automaticamente
    document.getElementById("paciente_id").value = "";
    document.getElementById("titulo").value = "";
    document.getElementById("status").value = "agendado"; // padrão
    document.getElementById("modalDate").value = "";
    document.getElementById("modalStart").value = "";
    document.getElementById("modalEnd").value = "";

    // Botões
    document.getElementById("btnExcluirAgendamento").classList.add("hidden");
    document.getElementById("btnSalvarAgendamento").onclick = null; // remove onclick antigo
    document.getElementById("btnExcluirAgendamento").onclick = null;
}

// ABRE modal (NOVO agendamento)
window.openModalAgendamento = function (info) {
    showModal();
    resetarModal();

    document.getElementById("modalTitle").innerText = "Novo Agendamento";

    const start = moment(info.start);
    const end = moment(info.end || start.clone().add(30, "minutes"));

    document.getElementById("modalDate").value = start.format("YYYY-MM-DD");
    document.getElementById("modalStart").value = start.format("HH:mm");
    document.getElementById("modalEnd").value = end.format("HH:mm");

    // Botão salvar = CREATE
    document.getElementById("btnSalvarAgendamento").onclick = salvarAgendamento;
};

// ABRE modal (EDIÇÃO de agendamento)
window.openModalEdicao = function (info) {
    showModal();
    resetarModal(); // ← LIMPEZA TOTAL antes de preencher

    const event = info.event;
    const id = String(event.id); // garante string (já está funcionando)

    document.getElementById("modalTitle").innerText = "Editar Agendamento";

    // Preenche com os dados do evento clicado
    document.getElementById("paciente_id").value = event.extendedProps.paciente_id || "";
    document.getElementById("titulo").value       = event.extendedProps.titulo || "";
    document.getElementById("status").value       = event.extendedProps.status || "agendado";

    document.getElementById("modalDate").value   = moment(event.start).format("YYYY-MM-DD");
    document.getElementById("modalStart").value = moment(event.start).format("HH:mm");
    document.getElementById("modalEnd").value   = event.end
        ? moment(event.end).format("HH:mm")
        : moment(event.start).add(30, "minutes").format("HH:mm");

    // Botão salvar = UPDATE
    document.getElementById("btnSalvarAgendamento").onclick = () => updateAgendamento(id);

    // Botão excluir
    const btnExcluir = document.getElementById("btnExcluirAgendamento");
    btnExcluir.classList.remove("hidden");
    btnExcluir.onclick = () => excluirAgendamento(id);
};

// EXCLUIR agendamento
window.excluirAgendamento = function (id) {
    if (!confirm("Tem certeza que deseja excluir este agendamento?")) return;

    // Remove visualmente ANTES da requisição (fica mais rápido)
    const evento = calendar.getEventById(String(id));
    if (evento) evento.remove();

    fetch(`/consultas/${id}`, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "Accept": "application/json"
        }
    })
    .then(r => {
        if (!r.ok) throw new Error("Erro na exclusão");
        return r.json();
    })
    .then(() => {
        calendar.refetchEvents(); // garante sincronia
        closeModal();
    })
    .catch(err => {
        console.error(err);
        alert("Erro ao excluir. Tente novamente.");
        calendar.refetchEvents(); // recarrega caso tenha dado errado
    });
};

// MOSTRAR modal (com animação)
function showModal() {
    modal.classList.remove("hidden");
    setTimeout(() => {
        modalCard.classList.remove("scale-95", "opacity-0");
        modalCard.classList.add("scale-100", "opacity-100");
    }, 20);
}

// FECHAR modal (com animação + limpeza total)
window.closeModal = function () {
    modalCard.classList.add("scale-95", "opacity-0");
    setTimeout(() => {
        modal.classList.add("hidden");
        resetarModal(); // ← garante que na próxima abertura esteja 100% limpo
    }, 150);
};

// Fechar ao clicar fora
modal.addEventListener("click", (e) => {
    if (e.target === modal) closeModal();
});