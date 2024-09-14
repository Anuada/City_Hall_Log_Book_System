import sweetalert2 from 'https://cdn.skypack.dev/sweetalert2';

export const successAlert = (message) => {
    sweetalert2.fire({
        icon: "success",
        title: message,
        confirmButtonColor: "#5DB075",
        timer: 2000,
        timerProgressBar: true,
    });
};

export const errorAlert = (message) => {
    sweetalert2.fire({
        icon: "error",
        title: message,
        confirmButtonColor: "#d33",
        timer: 2000,
        timerProgressBar: true,
    });
};

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
