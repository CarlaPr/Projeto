<?php
include_once('protect.php');
include_once('conexao.php');

$idpacientes = $_SESSION['idpacientes'];

// Consulta ao banco de dados para obter as consultas do paciente
$query_consultas = "SELECT nome, tipo_agendamento, data_agendamento, hora_agendamento 
                    FROM pacientes 
                    LEFT JOIN agendamento ON pacientes.idpacientes = agendamento.id_paciente_agendamento
                    WHERE agendamento.id_paciente_agendamento = ?
                    ORDER BY data_agendamento DESC";

$stmt = $mysqli->prepare($query_consultas);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Morello - Historico de Consultas</title>

<style>

    @import url('https://fonts.googleapis.com/css?family=Poppins:400,700,900');

    * {
        margin: 0px;
        padding: 0px; 
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
        list-style: none;
        text-decoration: none;
    }
    .recuo{
        margin-top: 10px;
        background-color: #74AFB2;
    }

    .navegacao{
        background-color: rgba(255, 255, 255, 0.904);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 40px;
        box-shadow: 0 0.1rem 0.5rem #ccc;
        width: 100%;
    }

    .logo {
        width: 50px;
        height: auto;
    }

    .navegacao h1{
    font-size: 18px;
    }

    .nav-menu {
        display: flex;
        justify-content: center;
        gap: 5rem;
        list-style-type: none;
    }

    .nav-menu li a {
        color: black;
        font-size: 15px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.5s;
    }

    .nav-menu li a:hover {
        color: brown;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
    }

    .historico {
        margin: 20px;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .historico h4 {
        text-align: center;
        font-size: 40px;
        margin-bottom: 20px;
        font-size : 40px
    }

    #listar-Pacientes {
        margin-top: 20px;
    }

    #listar-Pacientes table {
        width: 100%;
        border-collapse: collapse;
    }

    #listar-Pacientes th{
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    #listar-Pacientes td{
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    #listar-Pacientes th {
        background-color: #f2f2f2;
    }

    #listar-Pacientes tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    #listar-Pacientes tr:hover {
        background-color: #f2f2f2;
    }
    

    </style>

</head>
<body>

    <script src="custom.js"></script>
    
    <header>
        <div class="recuo"></div>

        <nav class="navegacao">

             <img src="./componentes/imagens/logo2.png" alt="logo da empresa Morello com cores azuis" class="logo">

            <h1>Bem vindo ao portal do paciente, <?php echo $_SESSION['nome']; ?>.</h1>

            <ul class="nav-menu">
                <li><a href="index.html">Nosso Hospital</a></li>
                <li><a href="portalPaciente.php">Portal do Paciente</a></li>
                <li><a href="logout.php">Sair da Conta</a></li>
            </ul>
        </nav>
    </header>

    <div class="historico">
        <h4>Historico de Consultas</h4>
        <span id="msgAlerta"></span>

        <div id="listar-Pacientes">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo de Agendamento</th>
                        <th>Data do Agendamento</th>
                        <th>Hora do Agendamento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if ($stmt) {
                        // Vincular o parâmetro do ID do paciente à declaração
                        $stmt->bind_param("i", $idpacientes);
    
                        // Executar a consulta
                        $stmt->execute();
                        
                        // Armazenar o resultado
                        $stmt->store_result();
                        
                        // Verificar se há consultas retornadas
                        if ($stmt->num_rows > 0) {
                            // Vincular as colunas do resultado
                            $stmt->bind_result($nome, $tipo_agendamento, $data_agendamento, $hora_agendamento);
                            
                            // Loop para exibir as consultas do paciente
                            while ($stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $nome . "</td>";
                                echo "<td>" . $tipo_agendamento . "</td>";
                                echo "<td>" . $data_agendamento . "</td>";
                                echo "<td>" . $hora_agendamento . "</td>";
                                echo "<td> Editar</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Nenhuma consulta encontrada.</td></tr>";
                        }
                    
                        $stmt->close();
                    } else {
                        echo "Erro na preparação da consulta";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>