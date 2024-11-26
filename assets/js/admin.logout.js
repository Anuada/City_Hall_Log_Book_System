import fetch from './utilities/fetchClient.js';
import { confirmAlert } from "./libs/sweetAlert2.js";

const logoutButton = document.getElementById('logoutButton');

logoutButton.addEventListener('click', () => {
    const question = "Are you sure you want to logout?";
    confirmAlert(question, handleLogout);
});

const handleLogout = async () => {
    try {
        await fetch.post('../api/adminLogout.php');
        location.href = '../page/admin_login.php';
    } catch (error) {
        console.error(error);
    }
}