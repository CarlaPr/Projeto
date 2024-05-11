<?php
session_start();
include_once('conexao.php');

$idusuario = $_SESSION['idusuario'];

$query_consultas = "SELECT idpacientes, nome, cpf, email, telefone, sexo, data_nascimento, cep
                    FROM pacientes";


$stmt = $mysqli->prepare($query_consultas);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Morello - Pacientes</title>

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
        <nav class="navegacao">

             <img src="./imagens/logo2.png" alt="logo da empresa Morello com cores azuis" class="logo">

            <ul class="nav-menu">

                <li><a href="portalAdministrativo.php">Portal Administrativo</a></li>
                <li><a href="logout.php">Sair da Conta</a></li>
                
            </ul>
        </nav>
    </header>

    <div class="historico">
        <h4>Pacientes</h4>
        <span id="msgAlerta"></span>

        <div id="listar-Pacientes">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Sexo</th>
                        <th>Data Nascimento</th>
                        <th>CEP</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <tr>

                    <?php
                    if ($stmt) {
                        $stmt->execute();
                        
                        // Armazenar o resultado
                        $stmt->store_result();
                        
                        // Verificar se há consultas retornadas
                        if ($stmt->num_rows > 0) {

                            $stmt->bind_result($idpacientes, $nome, $cpf, $email, $telefone, $sexo, $data_nascimento, $cep);
                            
                            while ($stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $idpacientes . "</td>";
                                echo "<td>" . $nome . "</td>";
                                echo "<td>" . $cpf . "</td>";
                                echo "<td>" . $email . "</td>";
                                echo "<td>" . $telefone . "</td>";
                                echo "<td>" . $sexo . "</td>";
                                echo "<td>" . $data_nascimento . "</td>";
                                echo "<td>" . $cep . "</td>";
                                echo "<td> Editar Excluir</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Nenhum paciente encontrada.</td></tr>";
                        }
                    
                        $stmt->close();
                    } else {
                        echo "Erro na preparação";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>