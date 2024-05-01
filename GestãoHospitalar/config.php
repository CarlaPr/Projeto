<?php
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'hospital';

    $conexao = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

    //if ($conexao->connect_errno) {
    //    echo "Erro de conexão: " . $conexao->connect_error; 
    //} else {
    //    echo "Conexão bem-sucedida";
    //}

    // Recupera e verifica se os dados já existem
    $cpf = $_POST['cpf'];
    $cpf = mysqli_real_escape_string($conexao, $cpf);

    $sql_verificar = "SELECT cpf FROM pacientes WHERE cpf='$cpf'";
    $resultado_verificar = mysqli_query($conexao, $sql_verificar);

    // Verifica se houve erro na consulta
    if (empty($cpf) || empty($nome) || empty($data_nascimento) || empty($sexo) || empty($telefone) || empty($cep) || empty($email) || empty($senha)) {
        echo "";
    } else {
        // Aqui continua o restante do código

        $cpf = $_POST['cpf'];
        $cpf = mysqli_real_escape_string($conexao, $cpf);

        $sql_verificar = "SELECT cpf FROM pacientes WHERE cpf='$cpf'";
        $resultado_verificar = mysqli_query($conexao, $sql_verificar);

        if ($resultado_verificar !== false && mysqli_num_rows($resultado_verificar) > 0) { 
            echo "CPF já cadastrado. Por favor, tente novamente com um CPF diferente.";
        } else {
        
        $nome = $_POST['nome'];
        $data_nascimento = $_POST['data_nascimento'];
        $sexo = $_POST['genero'];
        $telefone = $_POST['telefone'];
        $cep = $_POST['cep'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // INSERE OS DADOS DO USUÁRIO NA TABELA
        $sql = "INSERT INTO pacientes (cpf, nome, data_nascimento, sexo, telefone, cep, email, senha) 
                VALUES ('$cpf', '$nome', '$data_nascimento', '$sexo', '$telefone', '$cep', '$email', '$senha')";
                
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {
            echo "Usuário cadastrado com sucesso";
        } else {
            echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);
        }
        }
    }


?>
