<?php
$servername = "seu_servidor_mysql";
$username = "seu_usuario_mysql";
$password = "sua_senha_mysql";
$dbname = "seu_banco_de_dados";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o MySQL: " . $conn->connect_error);
}

$sqlCreateTable = "CREATE TABLE IF NOT EXISTS pacientes (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    rg VARCHAR(12) NOT NULL,
    idade INT(3) NOT NULL,
    ano_nascimento INT(4) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    data_agendamento DATE NOT NULL,
    hora_agendamento TIME NOT NULL
)";
$conn->query($sqlCreateTable);

function getPatients() {
    global $conn;
    $sqlSelect = "SELECT * FROM pacientes";
    $result = $conn->query($sqlSelect);

    $patients = [];
    while ($row = $result->fetch_assoc()) {
        $patients[] = $row;
    }

    return $patients;
}

function addPatient($data) {
    global $conn;
    $sqlInsert = "INSERT INTO pacientes (nome, cpf, rg, idade, ano_nascimento, endereco, cep, data_agendamento, hora_agendamento)
                  VALUES (
                    '" . $data['name'] . "',
                    '" . $data['cpf'] . "',
                    '" . $data['rg'] . "',
                    '" . $data['age'] . "',
                    '" . $data['birthYear'] . "',
                    '" . $data['address'] . "',
                    '" . $data['cep'] . "',
                    '" . $data['appointmentDate'] . "',
                    '" . $data['appointmentTime'] . "'
                  )";

    if ($conn->query($sqlInsert) === TRUE) {
        return true;
    } else {
        return false;
    }
}

function deletePatient($id) {
    global $conn;
    $sqlDelete = "DELETE FROM pacientes WHERE id='$id'";
    return $conn->query($sqlDelete);
}


