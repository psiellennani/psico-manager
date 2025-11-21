@extends('layouts.app')
@section('title', 'Agenda')

@push('styles')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.min.css' rel='stylesheet' />

<style>
/* -----------------------------------------------------------
   VARIÁVEIS GERAIS
----------------------------------------------------------- */
:root {
    --fc-today-bg-color: #f8fafc;
    --fc-border-color: #e5e7eb;
    --fc-text-muted: #6b7280;
    --fc-primary: #3b82f6;
    --fc-primary-light: #eff6ff;
}

/* -----------------------------------------------------------
   RESET DO HEADER NATIVO
----------------------------------------------------------- */
.fc-col-header {
    display: none !important;
}

/* Remove bordas duplas */
.fc-scrollgrid-section-body .fc-timegrid-cols table {
    border-left: none !important;
    border-right: none !important;
}

.fc-timegrid-col {
    border-right: 1px solid var(--fc-border-color);
}
.fc-timegrid-col:last-child {
    border-right: none !important;
}

.fc-timegrid-axis-frame {
    border-bottom: none !important;
}

/* -----------------------------------------------------------
   COLUNA DE HORAS
----------------------------------------------------------- */
.fc-timegrid-slots col:first-child,
.fc-timegrid-cols col:first-child,
.fc-timegrid-axis {
    width: 80px !important;
    min-width: 80px !important;
    max-width: 80px !important;
    background: #f9fafb;
    font-weight: 500;
    border-right: 1px solid var(--fc-border-color);
}

.fc-timegrid-slot-label {
    text-align: right !important;
    padding-right: 14px !important;
    color: var(--fc-text-muted);
    font-size: 0.85rem;
    display: flex;
    align-items: flex-start;
    justify-content: flex-end;
    height: 100%;
    padding-top: 0px !important;
}

.fc-timegrid-axis-cushion {
    margin-top: -6px;
    line-height: 1.1;
}

/* -----------------------------------------------------------
   ALTURA DAS LINHAS (VISUAL PREMIUM)
----------------------------------------------------------- */
.fc-timegrid-slot {
    height: 50px;
}

.fc-timegrid-slot-minor {
    height: 25px;
    border-color: #f1f5f9;
}

.fc-timegrid-slot:not(.fc-timegrid-slot-minor) {
    border-top: 1px solid var(--fc-border-color);
}

/* -----------------------------------------------------------
   ESTILO DE EVENTOS (PROFISSIONAL)
----------------------------------------------------------- */
.fc-event {
    background: var(--fc-primary-light);
    border: 1px solid #bfdbfe;
    border-radius: 10px;
    padding: 6px 8px;
    color: var(--fc-primary);
    font-size: 0.82rem;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    transition: 0.15s ease;
}

.fc-event:hover {
    background: #e0f2fe;
    border-color: var(--fc-primary);
    transform: scale(1.02);
}

.fc-event-main-frame {
    line-height: 1.25;
}

.event-time {
    font-size: 0.75rem;
    font-weight: 600;
    opacity: 0.9;
}

.event-title {
    font-size: 0.87rem;
    font-weight: 700;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* -----------------------------------------------------------
   CABEÇALHO CUSTOMIZADO
----------------------------------------------------------- */
.custom-header {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    background: white;
    border-top: 1px solid var(--fc-border-color);
    border-bottom: 1px solid var(--fc-border-color);
}

.day-header {
    padding: 12px 4px;
    text-align: center;
    border-right: 1px solid var(--fc-border-color);
}

.day-header:last-child {
    border-right: none;
}

.day-name {
    font-size: 0.75rem;
    color: var(--fc-text-muted);
    letter-spacing: 0.5px;
}

.day-number {
    margin-top: 4px;
    font-size: 1.25rem;
    font-weight: 600;
    color: #1f2937;
}

.day-number.highlight {
    background: var(--fc-primary);
    color: white;
    border-radius: 50%;
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 6px auto 0;
    box-shadow: 0 2px 4px rgba(59,130,246,0.3);
}
</style>
@endpush


@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto p-4 sm:p-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <button id="monthBtn" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-l-md hover:bg-gray-200 transition">
                        Mês
                    </button>
                    <button id="weekBtn" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-r-md">
                        Semana
                    </button>

                    <div class="flex items-center border border-gray-300 rounded-md ml-6">
                        <button id="prevBtn" class="p-2 hover:bg-gray-100"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></button>
                        <span id="title" class="px-4 font-semibold text-gray-700">Semana 16 - 22 Nov</span>
                        <button id="nextBtn" class="p-2 hover:bg-gray-100"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></button>
                    </div>

                    <button id="todayBtn" class="px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-md border border-gray-300">
                        Hoje
                    </button>
                </div>

                <button onclick="openModal()" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-xl shadow transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Novo Agendamento
                </button>
            </div>
        </div>

        <div class="custom-header flex border-x border-gray-200">
            <div class="w-20 flex-shrink-0"></div> 
            <div id="customHeader" class="flex flex-1"></div>
        </div>

        <div class="bg-white rounded-b-lg shadow-sm border border-gray-200 border-t-0 overflow-hidden">
            <div id="calendar"></div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/locales/pt-br.global.min.js'></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/pt-br.min.js"></script>

<script>
window.openModal = function(info = null) {
    console.log('Abrir Modal com informações:', info);
};


document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const customHeaderEl = document.getElementById('customHeader');
    
    moment.locale('pt-br'); 

    const calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'pt-br',
        initialView: 'timeGridWeek',
        headerToolbar: false,
        height: 'auto',
        slotMinTime: '07:00:00',
        slotMaxTime: '20:00:00',
        slotDuration: '00:30:00',
        slotLabelInterval: '01:00:00',
        allDaySlot: false,
        selectable: true,
        editable: true,
        events: '{{ route("consultas.api.events") }}',

        datesSet: function(info) {
            updateCustomHeader(info);
            updateTitle(info);
        },

        eventContent: function(arg) {
            const start = moment(arg.event.start).format('HH:mm'); 
            const name = arg.event.extendedProps.paciente_nome || 'Paciente';
            
            // Retorna o HTML do evento formatado com as classes CSS
            return { 
                html: `<div class="event-time">${start} - ${arg.event.title}</div><div class="event-title">${name}</div>` 
            };
        },

        select: window.openModal,
        eventClick: window.openModal,
    });

    calendar.render();

    // Função para renderizar o cabeçalho de dias customizado
    function updateCustomHeader(dateInfo) {
        customHeaderEl.innerHTML = '';
        const start = moment(dateInfo.start);
        
        for (let i = 0; i < 7; i++) {
            const day = start.clone().add(i, 'days');
            const isHighlight = day.isSame(moment(), 'day'); 
            const dayName = day.format('ddd').toUpperCase().replace('.', '');
            const dayNum = day.format('D');

            const div = document.createElement('div');
            div.className = `day-header flex-1 cursor-pointer`; 
            div.innerHTML = `
                <div class="day-name">${dayName}</div>
                <div class="day-number ${isHighlight ? 'highlight' : ''}">${dayNum}</div>
            `;
            
            div.addEventListener('click', () => {
                calendar.changeView('timeGridDay', day.format('YYYY-MM-DD'));
            });

            customHeaderEl.appendChild(div);
        }
    }

    // Função para atualizar o título da barra de navegação
    function updateTitle(info) {
        const start = moment(info.start);
        const end = moment(info.end).subtract(1, 'day'); 
        const title = `Semana ${start.format('D')} - ${end.format('D MMM')}`; 
        document.getElementById('title').textContent = title;
    }

    // Navegação (Prev, Next, Today)
    document.getElementById('prevBtn').onclick = () => calendar.prev();
    document.getElementById('nextBtn').onclick = () => calendar.next();
    document.getElementById('todayBtn').onclick = () => calendar.today();

    // Troca de visualização (Semana/Mês)
    document.getElementById('weekBtn').onclick = function() {
        calendar.changeView('timeGridWeek');
        this.classList.add('bg-blue-600', 'text-white');
        this.classList.remove('bg-gray-100', 'text-gray-600');
        document.getElementById('monthBtn').classList.remove('bg-blue-600', 'text-white');
        document.getElementById('monthBtn').classList.add('bg-gray-100', 'text-gray-600');
    };

    document.getElementById('monthBtn').onclick = function() {
        calendar.changeView('dayGridMonth');
        this.classList.add('bg-blue-600', 'text-white');
        this.classList.remove('bg-gray-100', 'text-gray-600');
        document.getElementById('weekBtn').classList.remove('bg-blue-600', 'text-white');
        document.getElementById('weekBtn').classList.add('bg-gray-100', 'text-gray-600');
    };
});
</script>
@endpush