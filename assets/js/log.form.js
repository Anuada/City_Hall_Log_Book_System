import axios from './libs/axios.js';
import serializeForm from './function/serializeForm.js';
import { confirmAlert, errorAlert, successAlert } from "./libs/sweetAlert2.js";
import { strReplace, ucWords } from './function/formatter.js';

const [select_button, log_book_form] = ['select_button', 'log_book_form'].map(e => document.getElementById(e));
const [employee, visitor] = ['employee', 'visitor'].map(e => document.getElementById(e));
let visitor_type = '';

// Form Fields
const employee_formfield = `
    <div style="display: flex; justify-content: space-between; align-items: center">
        <h3><i class="fas fa-arrow-left ch-green-text" id="back"></i></h3>
        <h3 style="font-weight: bold" class="ch-green-text">LOG FORM</h3>
    </div>
    <form id="log_form">
        <div class="form-group">
            <label for="employee_id">Employee ID</label>
            <input class="form-control" id="employee_id" name="employee_id" placeholder="Select Employee ID">
            <div class="form-text text-danger" id="errorEmployeeId"></div>
        </div>
        <div id="employeeInfoContainer"></div>

        <div class="form-group">
            <label for="division">Division</label>
            <select class="form-control" id="division" name="division"></select>
            <div class="form-text text-danger" id="errorDivision"></div>
        </div>

        <div class="form-group">
            <label for="purpose">Purpose</label>
            <textarea class="form-control" id="purpose" name="purpose" placeholder="Enter your purpose here..."
                rows="4">Work</textarea>
            <div class="form-text text-danger" id="errorPurpose"></div>
        </div>

        <div class="form-group" style="display: flex; justify-content: flex-end;">
            <button type="submit" name="submit" class="btn ch-green text-white btn-submit">Submit Now</button>
        </div>
    </form>
`;
const visitor_formfield = `
    <div style="display: flex; justify-content: space-between; align-items: center">
        <h3><i class="fas fa-arrow-left ch-green-text" id="back"></i></h3>
        <h3 style="font-weight: bold" class="ch-green-text">LOG FORM</h3>
    </div>
    <form id="log_form">
        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
            <div class="form-text text-danger" id="errorFName"></div>
        </div>

        <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
            <div class="form-text text-danger" id="errorLName"></div>
        </div>

        <div class="form-group">
            <label for="office">Office</label>
            <input type="text" class="form-control" id="office" name="office" placeholder="Input Office">
            <div class="form-text text-danger" id="errorOffice"></div>
        </div>

        <div class="form-group">
            <label for="division">Division</label>
            <select class="form-control" id="division" name="division"></select>
            <div class="form-text text-danger" id="errorDivision"></div>
        </div>

        <div class="form-group">
            <label for="purpose">Purpose</label>
            <textarea class="form-control" id="purpose" name="purpose" placeholder="Enter your purpose here..."
                rows="4">Visit</textarea>
            <div class="form-text text-danger" id="errorPurpose"></div>
        </div>

        <div class="form-group" style="display: flex; justify-content: flex-end;">
            <button type="submit" name="submit" class="btn ch-green text-white btn-submit">Submit Now</button>
        </div>
    </form>
`;

// Loader
const loader = `
    <div class="loading">
        <span></span>
        <span></span>
        <span></span>
    </div>
`;
const loader2 = `<i style="color: #000">Loading...</i>`;

employee.addEventListener('click', () => {
    visitor_type = 'Employee';
    select_button.style.display = 'none';
    log_book_form.style.display = 'block';
    log_book_form.innerHTML = employee_formfield;
    fetchDivisionOptions();
});

visitor.addEventListener('click', () => {
    visitor_type = 'Visitor';
    select_button.style.display = 'none';
    log_book_form.style.display = 'block';
    log_book_form.innerHTML = visitor_formfield;
    fetchDivisionOptions();
});

document.addEventListener('click', (e) => {
    const id = e.target.id;
    if (id == 'back') {
        const log_form = document.getElementById('log_form');
        log_form.reset();
        log_book_form.style.display = 'none';
        select_button.style.display = 'flex';
    }
});

document.addEventListener('submit', (e) => {
    e.preventDefault();
    const form_id = e.target.id;
    if (form_id == 'log_form') {
        const payload = serializeForm(e.target);
        payload.type = visitor_type;
        const question = "Please confirm that all the details you provided are accurate. Do you want to proceed?";
        confirmAlert(question, handleFormSubmit, payload);
    }
});

document.addEventListener('change', (e) => {
    const id = e.target.id.trim();
    const purpose = document.getElementById('purpose');
    if (id == 'office') {
        const office = e.target.value;
        if (visitor_type == 'Visitor') {
            purpose.value = `Visit the ${ucWords(strReplace(office))}`;
        }
    } else if (id == 'employee_id') {
        const employee_id = e.target.value;
        getEmployeeInfo(employee_id, purpose);
    }
});

const getEmployeeInfo = async (id, purpose) => {
    const employeeInfoContainer = document.getElementById('employeeInfoContainer');
    const errorEmployeeId = document.getElementById('errorEmployeeId');
    employeeInfoContainer.style.display = 'none';
    errorEmployeeId.innerHTML = loader2;
    try {
        const { data } = await axios.get('../api/findEmployee.php', { params: { id: id } });
        employeeInfoContainer.style.display = 'block';
        errorEmployeeId.textContent = '';
        displayEmployeeInfo(employeeInfoContainer, data);
        purpose.value = `Work at the ${ucWords(data.office)}`;
    } catch (error) {
        const { response } = error;
        employeeInfoContainer.style.display = 'none';
        errorEmployeeId.textContent = response.data.message;
    }
}

const displayEmployeeInfo = (employeeInfoContainer, data) => {
    employeeInfoContainer.innerHTML = `
        <div class="form-group">
            <label>Employee Name</label>
            <div style="display: flex; justify-content: space-between">
                <input type="text" class="form-control" name="fname" id="fname" placeholder="Employee First Name" value="${ucWords(data.fname)}" style="width: 48%" readonly>
                <input type="text" class="form-control" name="lname" id="lname" placeholder="Employee Last Name" value="${ucWords(data.lname)}" style="width: 48%" readonly>
            </div>
        </div>
        <div class="form-group">
            <label>Employee Office</label>
            <input type="text" class="form-control" name="office" id="office" placeholder="Employee Office" value="${ucWords(data.office)}" readonly>
        </div>
    `;
}

const fetchDivisionOptions = async () => {
    const division = document.getElementById('division');
    try {
        const { data } = await axios.get('../api/divisionEnums.php');
        const options = ['<option disabled selected hidden>SELECT DIVISION</option>']
            .concat(data.map(opt => `<option value="${opt}">${opt}</option>`))
            .join('');
        division.innerHTML = options;
    } catch (error) {
        console.error(error);
    }
}

const handleFormSubmit = async (payload) => {
    const log_form = document.getElementById('log_form');
    const button = log_form.getElementsByTagName('button')[0];

    const [errorOffice, errorEmployeeId, errorFName, errorLName, errorDivision, errorPurpose] = ['errorOffice', 'errorEmployeeId', 'errorFName', 'errorLName', 'errorDivision', 'errorPurpose'].map(e => document.getElementById(e));
    button.disabled = true;
    button.innerHTML = loader;
    try {
        const { data } = await axios.post('../api/logVisitor.php', payload);
        successAlert(data.message);
        log_form.reset();
        log_book_form.style.display = 'none';
        select_button.style.display = 'flex';
        [errorOffice, errorEmployeeId, errorFName, errorLName, errorDivision, errorPurpose].forEach(e => { if (e) e.textContent = '' })

    } catch (error) {
        const { response } = error;
        if (response && response.status == 422) {
            const errorMessages = response.data.message;
            if (visitor_type == 'Employee') {
                errorEmployeeId.textContent = errorMessages.employee_id;
                if (errorFName && errorLName && errorOffice) {
                    errorFName.textContent = errorMessages.fname;
                    errorLName.textContent = errorMessages.lname;
                    errorOffice.textContent = errorMessages.office;
                }
            } else if (visitor_type == 'Visitor') {
                errorFName.textContent = errorMessages.fname;
                errorLName.textContent = errorMessages.lname;
                errorOffice.textContent = errorMessages.office;
            }
            errorDivision.textContent = errorMessages.division;
            errorPurpose.textContent = errorMessages.purpose;
        } else if (response && response.status == 400) {
            errorAlert(response.data.message);
        }
    } finally {
        button.disabled = false;
        button.innerHTML = 'Submit Now';
    }
}