const formatDate = (dateStr) => {
    const date = new Date(dateStr);

    const options = { year: "numeric", month: "long", day: "numeric" };
    return date.toLocaleDateString("en-US", options);
};

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    // Initialize the FullCalendar without events
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // Display type (e.g., month, week)
        events: async function (fetchInfo, successCallback, failureCallback) {
            try {
                const response = await axios('../response/logs.php');
                const events = await response.data;

                // Filter events to display a maximum of 3 per day
                const limitedEvents = events.reduce((acc, event) => {
                    const date = formatDate(event.start);
                    if (!acc[date]) {
                        acc[date] = [];
                    }
                    if (acc[date].length < 3) {
                        acc[date].push(event);
                    }
                    return acc;
                }, {});

                // Flatten the filtered events into a single array
                const filteredEvents = Object.values(limitedEvents).flat();

                successCallback(filteredEvents);
            } catch (error) {
                failureCallback(error);
            }
        },
        selectable: true, // To allow date selection
        dateClick: async (info) => {
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
                        </tr>
                    `);
                });
            } else {
                modalBody.append('<tr><td colspan="3" class="text-center">No logs on this day.</td></tr>');
            }

            $('#modalTitle').text(`Logs on ${formatDate(clickedDate)}`);

            // Show the modal
            $('#eventModal').modal('show');
        }
    });

    // Render the calendar
    calendar.render();
});