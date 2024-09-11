const formatDate = (dateStr) => {
    const date = new Date(dateStr);

    const options = { year: "numeric", month: "long", day: "numeric" };
    return date.toLocaleDateString("en-US", options);
};

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const currentMonthYearEl = document.getElementById('currentMonthYear');

    const updateMonthYearDisplay = async (calendar) => {
        let view = calendar.view;
        let startDate = view.currentStart; // This is the first visible date in the view

        // Format it as yyyy-mm
        let formattedDate = startDate.toLocaleDateString('en-CA', { year: 'numeric', month: '2-digit' });

        const response = await axios.get('../response/monthlyLogsReports.php', { params: { month: formattedDate } });

        // Update the div content
        currentMonthYearEl.innerHTML = `
        <p>Employee Count: ${response.data.employee_count}</p>
        <p>Visitor Count: ${response.data.visitor_count}</p>
        `;
    };

    const handleDateClick = async (info) => {
        let clickedDate = info.dateStr;

        const events = await axios.get('../response/logs.php');

        let eventsThisDay = events.data.filter((e) => {
            return e.start === clickedDate;
        });

        // Populate the modal with events
        let modalBody = $('#modalBody');
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

        $('#modalTitle').text(`Logs on ${formatDate(clickedDate)}`);

        // Show the modal
        $('#eventModal').modal('show');
    }

    // Initialize the FullCalendar without events
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // Display type (e.g., month, week)
        events: '../response/logs.php',
        dayMaxEvents: 2,
        selectable: true,
        // Callback for when the calendar first loads
        viewDidMount: async () => {
            await updateMonthYearDisplay(calendar);
        },

        // Callback for when the calendar changes (e.g., next/prev clicked)
        datesSet: async () => {
            await updateMonthYearDisplay(calendar);
        },
        dateClick: async (info) => {
            await handleDateClick(info);
        }
    });

    // Render the calendar
    calendar.render();
});