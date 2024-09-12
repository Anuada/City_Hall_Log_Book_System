import formatDate from "./formatter.js";
import { Calendar } from 'https://cdn.skypack.dev/fullcalendar';
import axios from 'https://cdn.skypack.dev/axios';

// VARIABLES
const calendarEl = document.getElementById('calendar');
const currentMonthYearEl = document.getElementById('otherDetails');
const modal = $('#eventModal');
const modalBody = $('#modalBody');
const modalText = $('#modalTitle');

// FUNCTIONS
const updateMonthYearDisplay = async (calendar) => {
    const view = calendar.view;
    const startDate = view.currentStart;
    const formattedDate = startDate.toLocaleDateString('en-CA', { year: 'numeric', month: '2-digit' });

    const { data } = await axios.get('../response/monthlyLogsReports.php', { params: { month: formattedDate } });

    currentMonthYearEl.innerHTML = `
        <p>Employee Count: ${data.employee_count}</p>
        <p>Visitor Count: ${data.visitor_count}</p>
        `;
};

const handleDateClick = async (info) => {
    const clickedDate = info.dateStr;

    const { data } = await axios.get('../response/logs.php');

    const eventsThisDay = data.filter((e) => {
        return e.start === clickedDate;
    });

    modalBody.empty();

    if (eventsThisDay.length > 0) {
        eventsThisDay.forEach((event) => {
            modalBody.append(`
                <tr>
                    <td>${event.id}</td>
                    <td>${event.title}</td>
                    <td>${event.purpose}</td>
                    <td>${event.type}</td>
                    <td>${event.time}</td>
                </tr>
            `);
        });
    } else {
        modalBody.append('<tr><td colspan="5" class="text-center">No logs on this day.</td></tr>');
    }

    modalText.text(`${eventsThisDay.length > 1 ? 'Logs' : 'Log'} on ${formatDate(clickedDate)}`);
    modal.modal('show');
}

// INITIALIZE THE FULLCALENDAR
const calendar = new Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: '../response/logs.php',
    dayMaxEvents: 2,
    selectable: true,
    datesSet: async () => {
        await updateMonthYearDisplay(calendar);
    },
    dateClick: async (info) => {
        await handleDateClick(info);
    }
});

document.addEventListener('DOMContentLoaded', async () => {
    await updateMonthYearDisplay(calendar);
    calendar.render();
})