<?php
session_start();
include_once('conexao.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morello - Agendar Consultas</title>

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

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size : 40px;
            padding: 8px;
        }

        form {
            width: 100%;
            max-width: 800px;
            margin: 0 auto; 
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            font-size: 16px;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: blue;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
</style>

</head>
<body>

    <header>
        <nav class="navegacao">

             <img src="./imagens/logo2.png" alt="logo da empresa Morello com cores azuis" class="logo">

            <ul class="nav-menu">

                <li><a href="portalAdministrativo.php">Portal Administrativo</a></li>
                <li><a href="logout.php">Sair da Conta</a></li>
                
            </ul>
        </nav>
    </header>

    <div class="container">

        <h2>Agendamento</h2>

        <form action="agendamento.php" method="post">
            
            <input type="hidden" name="id_paciente_agendamento" value="<?php echo isset($_SESSION['idpacientes']) ? $_SESSION['idpacientes'] : ''; ?>">

            <label for="tipo_agendamento">Tipo de Agendamento:</label>
            <select id="tipo_agendamento" name="tipo_agendamento" required>
                <option value="Consulta Medica">Consulta Médica</option>
                <option value="Exame">Exame</option>
                <option value="Procedimento Médico">Procedimento</option>
            </select><br>

            <label for="data_agendamento">Data da Consulta:</label>
            <input type="date" id="data_agendamento" name="data_agendamento" required><br>

            <label for="hora_agendamento">Hora da Consulta:</label>
            <input type="time" id="hora_agendamento" name="hora_agendamento" required><br>

            <?php

                if (isset($_SESSION['idpacientes']) && isset($_POST['tipo_agendamento']) && isset($_POST['data_agendamento']) && isset($_POST['hora_agendamento'])) {
                    $id_paciente_agendamento = $_SESSION['idpacientes'];
                    $tipo_agendamento = $_POST['tipo_agendamento'];
                    $data_agendamento = $_POST['data_agendamento'];
                    $hora_agendamento = $_POST['hora_agendamento'];

                    // Verificar se já existe um agendamento na mesma data e hora
                    $check_query = "SELECT * FROM agendamento WHERE id_paciente_agendamento != ? AND data_agendamento = ? AND hora_agendamento = ?";
                    $check_stmt = $mysqli->prepare($check_query);
                    
                    if ($check_stmt) {
                        $check_stmt->bind_param("iss", $id_paciente_agendamento, $data_agendamento, $hora_agendamento);
                        $check_stmt->execute();
                        $check_stmt->store_result();
                        
                        // Verifica se a execução da consulta foi bem-sucedida
                        if ($check_stmt->num_rows > 0) {
                            echo "Desculpe, já existe um agendamento para outro paciente na mesma data e horário.";
                        } else {
                            // Inserir o novo agendamento
                            $insert_stmt = $mysqli->prepare("INSERT INTO agendamento (id_paciente_agendamento, tipo_agendamento, data_agendamento, hora_agendamento) 
                                                                VALUES (?, ?, ?, ?)");
                    
                            if ($insert_stmt) {
                                $insert_stmt->bind_param("isss", $id_paciente_agendamento, $tipo_agendamento, $data_agendamento, $hora_agendamento);
                                $insert_stmt->execute();
                    
                                // Verificar se o agendamento foi inserido com sucesso
                                if ($insert_stmt->affected_rows > 0) {
                                    echo 'Agendamento realizado com sucesso.';
                                } else {
                                    echo 'Não foi possível realizar o agendamento.';
                                }
                    
                                $insert_stmt->close();
                            } else {
                                echo 'Erro na preparação da consulta de inserção: ' . $mysqli->error;
                            }
                        }

                        $check_stmt->close();
                    } else {
                        echo 'Erro na preparação da consulta de verificação: ' . $mysqli->error;
                    }
                }
            ?>

            <input type="submit" id="agendar" name="submit" value="Agendar">
            <br><br>
            

        </form>
    </div>
</body>
</html>