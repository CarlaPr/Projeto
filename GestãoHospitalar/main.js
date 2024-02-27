let patientData = [];

function addPatient() {
    const name = document.getElementById('name').value;
    const cpf = document.getElementById('cpf').value;
    const rg = document.getElementById('rg').value;
    const age = document.getElementById('age').value;
    const birthYear = document.getElementById('birthYear').value;
    const address = document.getElementById('address').value;
    const cep = document.getElementById('cep').value;
    const appointmentDate = document.getElementById('appointmentDate').value;
    const appointmentTime = document.getElementById('appointmentTime').value;

    const patient = {
        name,
        cpf,
        rg,
        age,
        birthYear,
        address,
        cep,
        appointmentDate,
        appointmentTime
    };

    patientData.push(patient);

    displayPatients();
    clearForm();
}

function displayPatients() {
    const patientList = document.getElementById('patientList');
    patientList.innerHTML = '';

    patientData.forEach((patient, index) => {
        const li = document.createElement('li');
        li.innerHTML = `
            <span>${patient.name}</span>
            <span>${patient.cpf}</span>
            <span>${patient.age} anos</span>
            <span>${patient.appointmentDate} ${patient.appointmentTime}</span>
            <button class="delete-btn" onclick="deletePatient(${index})">Excluir</button>
        `;
        patientList.appendChild(li);
    });
}

function deletePatient(index) {
    patientData.splice(index, 1);
    displayPatients();
}

function clearForm() {
    document.getElementById('patientForm').reset();
}
