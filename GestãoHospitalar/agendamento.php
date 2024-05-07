<?php
include_once('protect.php');
include_once('conexao.php');

    // Verifica se o usuário está logado
    if(isset($_SESSION['idpacientes'])) {
        
        $paciente_agendamento = $_SESSION['idpacientes'];
        $tipo_agendamento = $_POST['tipo_agendamento'];
        $data_agendamento = $_POST['data_agendamento'];
        $hora_agendamento = $_POST['hora_agendamento'];

        // INSERE OS DADOS DO USUÁRIO NA TABELA
        $sql = "INSERT INTO agendamento (paciente_agendamento, tipo_agendamento, data_agendamento, hora_agendamento) 
                VALUES ('$paciente_agendamento', '$tipo_agendamento', '$data_agendamento', '$hora_agendamento')";

        $resultado = mysqli_query($mysqli, $sql);

        if($resultado){
            echo 'Agendamento realizado com sucesso.';
            header("Location: portalPaciente.php");

        } else {
            echo 'Não foi possível realizar o agendamento : ' . mysqli_error($mysqli);
    }
}
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
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 40px;
            padding: 0 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size : 40px
        }

        form {
            width: 100%;
            max-width: 800px;
            margin: 0 auto; 
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
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

    <div class="container">

        <h2>Agendamento</h2>

        <form action="agendamento.php" method="post">
            
            <input type="hidden" name="paciente_agendamento" value="<?php echo isset($_SESSION['idpacientes']) ? $_SESSION['idpacientes'] : ''; ?>">

            <label for="tipo_agendamento">Tipo de Agendamento:</label>
            <select id="tipo_agendamento" name="tipo_agendamento" required>
                <option value="consulta_medica">Consulta Médica</option>
                <option value="exame">Exame</option>
                <option value="procedimento">Procedimento</option>
            </select><br>

            <label for="data_agendamento">Data da Consulta:</label>
            <input type="date" id="data_agendamento" name="data_agendamento" required><br>

            <label for="hora_agendamento">Hora da Consulta:</label>
            <input type="time" id="hora_agendamento" name="hora_agendamento" required><br>

            <input type="submit" name="submit" value="Agendar">
            <br><br>

        </form>
    </div>

    
</body>
</html>