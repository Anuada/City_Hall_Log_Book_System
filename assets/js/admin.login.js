import fetch from './utilities/fetchClient.js';
import serializeForm from './helpers/serializeForm.js';
import { confirmAlert, errorAlert } from "./libs/sweetAlert2.js";

const admin_login = document.getElementById('admin_login');
const [usernameError, passwordError] = ['usernameError', 'passwordError'].map(e => document.getElementById(e));

admin_login.addEventListener('submit', (e) => {
    e.preventDefault();
    const payload = serializeForm(admin_login);
    const question = "Please confirm that all the details you provided are accurate. Do you want to proceed?";
    confirmAlert(question, handleLogin, payload);
});

const handleLogin = async (payload) => {
    try {
        await fetch.post('../api/adminLogin.php', payload);
        [usernameError, passwordError].forEach(e => { if (e) e.textContent = '' });
        location.href = "../admin/";
    } catch (error) {
        const { response } = error;
        if (response && response.status === 422) {
            usernameError.textContent = error.data.username;
            passwordError.textContent = error.data.password;
        } else if (response && response.status === 401) {
            [usernameError, passwordError].forEach(e => { if (e) e.textContent = '' });
            errorAlert(response.data.message);
        } else {
            console.error(error);
        }
    }
}