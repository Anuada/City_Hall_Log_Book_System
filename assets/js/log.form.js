import axios from 'https://cdn.skypack.dev/axios';
import serializeForm from './function/serializeForm.js';
import { errorAlert, successAlert } from "./libs/sweetAlert2.js";
import { strReplace, ucWords } from './function/formatter.js';

// VARIABLES
const [employee_info, visitor_info, employeeInfoContainer] = ['employee_info', 'visitor_info', 'employeeInfoContainer'].map(e => document.getElementById(e));
const [log_form, type, purpose, employee_id, office] = ['log_form', 'type', 'purpose', 'employee_id', 'office'].map(e => document.getElementById(e));
const [errorType, errorOffice, errorEmployeeId, errorFName, errorLName, errorPurpose] = ['errorType', 'errorOffice', 'errorEmployeeId', 'errorFName', 'errorLName', 'errorPurpose'].map(e => document.getElementById(e));

// EVENT LISTENERS
type.addEventListener('change', (e) => {
    const selectedType = e.target.value;
    if (selectedType == 'Employee') {
        employee_info.style.display = 'block';
        visitor_info.style.display = 'none';

        if (office.value != '') {
            purpose.value = `Work at the ${ucWords(strReplace(office.value))}`;
        } else {
            purpose.value = 'Work';
        }
    } else if (selectedType == 'Visitor') {
        visitor_info.style.display = 'block';
        employee_info.style.display = 'none';

        if (office.value != '') {
            purpose.value = `Visit the ${ucWords(strReplace(office.value))}`;
        } else {
            purpose.value = 'Visit';
        }
    }
});

log_form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const payload = serializeForm(log_form);
    try {
        const { data } = await axios.post('../response/logVisitor.php', payload);
        successAlert(data.message);
        log_form.reset();
        employee_info.style.display = 'none';
        employeeInfoContainer.style.display = 'none';
        visitor_info.style.display = 'none';
        [errorType, errorOffice, errorEmployeeId, errorFName, errorLName, errorPurpose].forEach(e => { if (e) e.textContent = '' })

    } catch (error) {
        const { response } = error;
        if (response && response.status == 422) {
            const errorMessages = response.data.message;
            errorType.textContent = errorMessages.type;
            errorOffice.textContent = errorMessages.office;
            errorEmployeeId.textContent = errorMessages.employee_id;
            errorFName.textContent = errorMessages.fname;
            errorLName.textContent = errorMessages.lname;
            errorPurpose.textContent = errorMessages.purpose;
        } else if (response && response.status == 400) {
            errorAlert(response.data.message);
        }
    }
})

office.addEventListener('change', (e) => {
    const value = ucWords(strReplace(e.target.value));
    if (type.value != '') {
        if (type.value == 'Employee') {
            purpose.value = `Work at the ${value}`
        } else if (type.value == 'Visitor') {
            purpose.value = `Visit the ${value}`
        }
    }
});

employee_id.addEventListener('change', (e) => {
    const id = e.target.value;
    employeeInfoContainer.style.display = 'block';
    getEmployeeInfo(id);
});

// FUNCTIONS
const getEmployeeInfo = async (id) => {
    try {
        const { data } = await axios.get('../response/findEmployee.php', { params: { id: id } });
        displayEmployeeInfo(data.data);
    } catch (error) {
        const { response } = error;
        displayEmployeeInfo(response.data.message);
    }
}

const displayEmployeeInfo = (data) => {
    employeeInfoContainer.innerHTML = `
        <label>Employee Info</label>
        <input type="text" class="form-control" value="${data}" disabled>
    `;
}