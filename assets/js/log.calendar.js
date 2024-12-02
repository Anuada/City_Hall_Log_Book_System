import { formatDate } from "./helpers/formatter.js";
import Calendar from './libs/fullCalendar.js';
import fetch from './utilities/fetchClient.js';
import { confirmAlert, errorAlert, successAlert } from "./libs/sweetAlert2.js";

// VARIABLES
const calendarEl = document.getElementById('calendar');
const currentMonthYearEl = document.getElementById('otherDetails');
const search = document.getElementById('search');
const modal = $('#eventModal');
const modalBody = $('#modalBody');
const modalText = $('#modalTitle');

let eventsThisDay = [];

// FUNCTIONS
const updateMonthYearDisplay = async (calendar) => {
    const view = calendar.view;
    const startDate = view.currentStart;
    const formattedDate = startDate.toLocaleDateString('en-CA', { year: 'numeric', month: '2-digit' });

    const { data } = await fetch.get('../api/monthlyLogsReports.php', { month: formattedDate });

    currentMonthYearEl.innerHTML = `
        <p>Employee Count: ${data.employee_count}</p>
        <p>Visitor Count: ${data.visitor_count}</p>
    `;
};

const handleDateClick = async (info) => {
    const clickedDate = info.dateStr;

    const { data } = await fetch.get('../api/logs.php');

    eventsThisDay = data.filter((e) => {
        return e.start === clickedDate;
    });

    displayTable(eventsThisDay);

    modalText.text(`${eventsThisDay.length > 1 ? 'Logs' : 'Log'} on ${formatDate(clickedDate)}`);
};

search.addEventListener('input', () => {
    const query = search.value.toLowerCase();
    const filteredLogs = eventsThisDay.filter(e => {
        return e.id.toLowerCase().includes(query) ||
            e.title.toLowerCase().includes(query) ||
            e.purpose.toLowerCase().includes(query) ||
            e.type.toLowerCase().includes(query) ||
            e.status.toLowerCase().includes(query) ||
            e.time.toLowerCase().includes(query);
    });

    displayTable(filteredLogs);
});

const displayTable = async (data) => {
    modalBody.empty();
    if (data.length > 0) {
        data.forEach((event) => {
            modalBody.append(`
                <tr>
                    <td>
                        <input type="checkbox" class="select-log" data-id="${event.id}" ${event.status !== 'Pending' ? 'disabled' : ''}>
                    </td>
                    <td>${event.id}</td>
                    <td>${event.title}</td>
                    <td>${event.contact_num}</td>
                    <td>${event.purpose}</td>
                    <td>${event.type}</td>
                    <td>${event.office}</td>
                    <td>${event.division}</td>
                    <td>${event.time}</td>
                    <td class="text-center">
                        ${event.status !== 'Pending' ? `
                            <span class="text-success">✔️</span> ${event.status}
                        ` : `
                            <span class="text-muted">❌</span> ${event.status}
                        `}
                    </td>
                </tr>
            `);
        });

        // Add the Accept button below the table
        modalBody.append(`
            <tr>
                <td colspan="9" class="text-center">
                    <button id="acceptSelected" class="btn btn-primary">Accept Selected</button>
                </td>
            </tr>
        `);
    } else {
        modalBody.append('<tr><td colspan="9" class="text-center">No logs found</td></tr>');
    }

    modal.modal('show');

    // Add event listener for the Accept button
    document.getElementById('acceptSelected').addEventListener('click', handleAcceptSelected);
};

// Function to handle the Accept button click
const handleAcceptSelected = async () => {
    const selectedLogs = [];

    // Loop through the checkboxes to find selected logs
    modalBody.find('.select-log:checked').each(function () {
        const id = $(this).data('id'); // Get the ID from the checkbox
        selectedLogs.push(id);
    });

    if (selectedLogs.length === 0) {
        errorAlert("No logs selected for acceptance.");
        return;
    }

    // Prepare payload for the status update
    const payload = {
        ids: selectedLogs, // Assuming the API accepts an array of IDs
        status: 'Accepted'
    };

    handleConfirmChangeStatus(payload);
};

document.addEventListener('change', (e) => {
    const statusChange = e.target.closest('.form-control');
    if (statusChange) {
        const selectedOption = statusChange.querySelector('option:checked');
        const id = selectedOption.getAttribute('data-id');
        const status = selectedOption.getAttribute('data-status');
        const payload = {
            id: id,
            status: status
        };
        handleConfirmChangeStatus(payload);
    }
});

const handleConfirmChangeStatus = async (payload) => {
    const question = "Are you sure you want to change the status of this log?";
    confirmAlert(question, handleChangeStatus, payload);
};

const handleChangeStatus = async (payload) => {
    try {
        const { data } = await fetch.post('../api/changeStatus.php', payload);
        if (data.success == true) {
            successAlert(data.message);
            await updateMonthYearDisplay(calendar);
            modal.modal('hide');
        } else {
            errorAlert(data.message);
        }
    } catch (error) {
        const { response } = error;
        if (response && response.status == 404) {
            errorAlert(error.data.message);
            modal.modal('hide');
        }
    }
};

// INITIALIZE THE FULLCALENDAR
const calendar = new Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: '../api/logs.php',
    eventColor: '#ff6740',
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

    setInterval(() => {
        calendar.refetchEvents();
        calendar.render();
    }, 1000);
});
