<?php
session_start();
require_once 'conexao.php';
require_once 'protect.php';

$idPaciente = $_SESSION['idpacientes'];

function exibirRelatorios($mysqli, $idPaciente) {
    $sql = "SELECT pacientes.nome, agendamento.tipo_agendamento, agendamento.data_agendamento, relatorios.relatorio
            FROM pacientes
            LEFT JOIN agendamento ON pacientes.idpacientes = agendamento.id_paciente_agendamento
            LEFT JOIN relatorios ON agendamento.id_paciente_agendamento = relatorios.id_paciente_relatorio
            WHERE pacientes.idpacientes = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $idPaciente);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nome"] . "</td>";
        echo "<td>" . $row["tipo_agendamento"] . "</td>";
        echo "<td>" . $row["data_agendamento"] . "</td>";
        echo "<td>" . $row["relatorio"] . "</td>";
        echo "</tr>";
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morello - Portal do Paciente</title>

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

        .container {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h4 {
            text-align: center;
            font-size: 40px;
            margin-bottom: 20px;
            font-size : 40px
        }

        #listar-relatorios {
            margin-top: 20px;
        }

        #listar-relatorios table {
            width: 100%;
            border-collapse: collapse;
        }

        #listar-relatorios th{
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        #listar-relatorios td{
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #listar-relatorios th {
            background-color: #f2f2f2;
        }

        #listar-relatorios tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        #listar-relatorios tr:hover {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>

    <header>
        <div class="recuo"></div>

        <nav class="navegacao">

        <img src="../../componentes/imagens/logo2.png" alt="logo da empresa Morello com cores azuis" class="logo">


            <h1>Bem vindo ao portal do paciente, <?php echo $_SESSION['nome']; ?>.</h1>

            <ul class="nav-menu">
                <li><a href="index.html">Nosso Hospital</a></li>
                <li><a href="portalPaciente.php">Portal do Paciente</a></li>
                <li><a href="logout.php">Sair da Conta</a></li>
            </ul>

        </nav>
    </header>

    <div class="container">

        <h4>Resultados e Relatórios</h4>

        <div id="listar-relatorios">

            <span id="msgAlerta"></span>

            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo de Agendamento</th>
                        <th>Data do Agendamento</th>
                        <th>Relsultado</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php
                            // Exibir os relatórios do paciente
                            exibirRelatorios($mysqli, $idPaciente);

                            $mysqli->close();
                        ?>
                    </tbody>
            </table>
        </div>
    </div>
</body>
</html>
