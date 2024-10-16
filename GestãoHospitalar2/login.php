<?php
   require_once 'conexao.php';

session_start(); // Inicia a sessão

if (isset($_POST['cpf']) && isset($_POST['senha'])){
    $cpf = $mysqli->real_escape_string($_POST['cpf']);
    $senha = $mysqli->real_escape_string($_POST['senha']);

    if(strlen($cpf) == 0){
        echo "Preencha seu cpf";
    } elseif(strlen($senha) == 0){
        echo "Preencha sua senha";
    } else {
        $sql_code = "SELECT * FROM pacientes WHERE cpf = '$cpf' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidadeRequisitos = $sql_query->num_rows;

        if($quantidadeRequisitos == 1) {

            $pacientes = $sql_query->fetch_assoc();
            $_SESSION['cpf'] = $cpf;
            $_SESSION['nome'] = $pacientes['nome']; 
            $_SESSION['idpacientes'] = $pacientes['idpacientes']; 
            
            header("Location: portalPaciente.php");
            
        }else{
            header("Location: login.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morello - Login</title>

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

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../componentes/imagens/agenda_admin_back.jpg'); /* Substitua 'caminho_para_sua_imagem.jpg' pelo caminho da sua imagem de fundo */
            background-size: cover;
            background-position: center;
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
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        label {
             font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
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

        p {
            text-align: center;
        }

    </style>
</head>
<body>

    <header>
        <div class="recuo"></div>
        <nav class="navegacao">
             <img src="./componentes/imagens/logo2.png" alt="logo da empresa Morello com cores azuis" class="logo">

            <ul class="nav-menu">
                <li><a href="index.html">Nosso Hospital</a></li>
                <li><a href="portalPaciente.php">Portal do Paciente</a></li>
                <li><a href="administracao/portalAdmin.php">Portal Empresarial</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">

        <h2>Login</h2>

        <form action="" method="POST">

            <div class="formulario">

                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}" title="Formato de CPF inválido. Use XXX.XXX.XXX-XX" maxlength="14" required>
                <br>

            </div>

            <div class="formulario">

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
                <br><br>

            </div>

            <button type="submit">Login</button>

        </form>

        <br>
        <p>Ainda não tem uma conta? <a href="cadastro.php">Clique aqui</a> para se cadastrar.</p>

    </div>
    <script>
        // Função para formatar o CPF conforme o usuário digita
        document.getElementById('cpf').addEventListener('input', function (e) {
            var cpf = e.target.value.replace(/\D/g, '');
            if (cpf.length > 0) {
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            }
            e.target.value = cpf;
        });
    </script>


    </div>

</body>
</html>
