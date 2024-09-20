import axios from 'https://cdn.skypack.dev/axios';
import serializeForm from './function/serializeForm.js';
import { confirmAlert, errorAlert, successAlert } from "./libs/sweetAlert2.js";
import { idFormatter, strReplace, ucWords } from './function/formatter.js';

// VARIABLES
const [employee_info, visitor_info, employeeInfoContainer] = ['employee_info', 'visitor_info', 'employeeInfoContainer'].map(e => document.getElementById(e));
const [log_form, type, purpose, employee_id, office] = ['log_form', 'type', 'purpose', 'employee_id', 'office'].map(e => document.getElementById(e));
const [errorType, errorOffice, errorEmployeeId, errorFName, errorLName, errorPurpose] = ['errorType', 'errorOffice', 'errorEmployeeId', 'errorFName', 'errorLName', 'errorPurpose'].map(e => document.getElementById(e));
let types = [];

// EVENT LISTENERS
type.addEventListener('change', (e) => {
    const selectedType = e.target.value;
    if (selectedType == 'Employee') {
        employee_info.style.display = 'block';
        visitor_info.style.display = 'none';
        errorType.textContent = '';

        if (office.value != '') {
            purpose.value = `Work at the ${ucWords(strReplace(office.value))}`;
        } else {
            purpose.value = 'Work';
        }
    } else if (selectedType == 'Visitor') {
        visitor_info.style.display = 'block';
        employee_info.style.display = 'none';
        errorType.textContent = '';

        if (office.value != '') {
            purpose.value = `Visit the ${ucWords(strReplace(office.value))}`;
        } else {
            purpose.value = 'Visit';
        }
    } else if (!types.includes(selectedType)) {
        errorType.textContent = 'invalid type';
        const options = ['<option disabled selected hidden>SELECT TYPE</option>']
            .concat(types.map(opt => `<option value="${opt}">${opt}</option>`))
            .join('');
        type.innerHTML = options;
    }
});

log_form.addEventListener('submit', (e) => {
    e.preventDefault();
    const payload = serializeForm(log_form);
    const question = "Please confirm that all the details you provided are accurate. Do you want to proceed?";
    confirmAlert(question, handleFormSubmit, payload);
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
    const formattedId = idFormatter(id);
    employee_id.value = formattedId;
    getEmployeeInfo(formattedId);
});

// FUNCTIONS
const handleFormSubmit = async (payload) => {
    try {
        const { data } = await axios.post('../api/logVisitor.php', payload);
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
}

const getEmployeeInfo = async (id) => {
    try {
        const { data } = await axios.get('../api/findEmployee.php', { params: { id: id } });
        employeeInfoContainer.style.display = 'block';
        errorEmployeeId.textContent = '';
        displayEmployeeInfo(data.data);
    } catch (error) {
        const { response } = error;
        employeeInfoContainer.style.display = 'none';
        errorEmployeeId.textContent = response.data.message;
    }
}

const displayEmployeeInfo = (data) => {
    employeeInfoContainer.innerHTML = `
        <label>Employee Info</label>
        <input type="text" class="form-control" value="${data}" disabled>
    `;
}

document.addEventListener('DOMContentLoaded', async () => {
    try {
        const { data } = await axios.get('../api/typesEnums.php');
        types = data;
    } catch (error) {
        console.error(error);
    }
});