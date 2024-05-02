<?php
    if(isset($_POST['submit'])){
       
        include_once('config.php');

        $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);
        $sexo = mysqli_real_escape_string($conexao, $_POST['genero']);
        $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
        $cep = mysqli_real_escape_string($conexao, $_POST['cep']);
        $email = mysqli_real_escape_string($conexao, $_POST['email']);
        $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

        $resultado = mysqli_query($conexao, "INSERT INTO pacientes (cpf, nome, data_nascimento, sexo, telefone, cep, email, senha) 
                                    VALUES ('$cpf', '$nome', '$data_nascimento', '$sexo', '$telefone', '$cep', '$email', '$senha')");

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="stylesLogin.css">
    <title>Cadastro - Morello Clinic</title>

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
                font-family: 'Poppins', sans-serif;
                background-color: #f0f0f0;
                margin: 0;
                padding: 0;
            }

            h1 {
                text-align: center;
                margin-top: 30px;
            }

            form {
                width: 400px;
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
            input[type="tel"],
            input[type="email"],
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
                background-color: #007bff;
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

    <h1>Cadastro de Pacientes</h1>
    <form action="cadastro.php" method="POST">

        <label for="cpf">CPF:</label><br>
        <input type="text" id="cpf" name="cpf" required><br><br>
        
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>
        
        <label for="data_nascimento">Data de Nascimento:</label><br>
        <input type="date" id="data_nascimento" name="data_nascimento" required><br><br>
        
        <label for="genero">Gênero:</label><br>
        <select id="genero" name="genero" required>
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
            <option value="Outro">Outro</option>
        </select><br><br>
        
        <label for="cep">CEP:</label><br>
        <input type="text" id="cep" name="cep" required><br><br>
        
        <label for="telefone">Telefone:</label><br>
        <input type="tel" id="telefone" name="telefone" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br><br>
        
        <input type="submit" name="submit" id="submit">
    </form>
</body>
</html>
