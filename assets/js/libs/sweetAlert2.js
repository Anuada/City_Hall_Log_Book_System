import sweetalert2 from 'https://cdn.skypack.dev/sweetalert2';

/**
 * Displays a success alert with a custom message.
 * @param {*} message The message to display in the success alert.
 */
export const successAlert = (message) => {
    sweetalert2.fire({
        icon: "success",
        title: message,
        confirmButtonColor: "#5DB075",
        timer: 2000,
        timerProgressBar: true,
    });
};

/**
 * Displays an error alert with a custom message.
 * @param {*} message The message to display in the error alert.
 */
export const errorAlert = (message) => {
    sweetalert2.fire({
        icon: "error",
        title: message,
        confirmButtonColor: "#d33",
        timer: 2000,
        timerProgressBar: true,
    });
};

/**
 * Shows a confirmation dialog with a question, and executes a provided action if confirmed.
 * @param {*} question The question to ask in the confirmation dialog.
 * @param {*} action The function to execute if the user confirms.
 * @param  {...any} actionArgs Arguments to pass to the `action` function.
 */
export const confirmAlert = (question, action, ...actionArgs) => {
    sweetalert2.fire({
        title: question,
        showDenyButton: true,
        confirmButtonText: "Yes",
        denyButtonText: `No`,
    }).then((result) => {
        if (result.isConfirmed) {
            action(...actionArgs);
        } else if (result.isDenied) {
            sweetalert2.fire({
                icon: "info",
                title: "No Changes Were Made",
                timer: 2000,
                timerProgressBar: true,
            });
        }
    });
};
