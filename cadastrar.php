<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
        <?php

            $dbHost = 'localhost';
            $dbUsername = 'root';
            $dbPassword = '';
            $dbName = 'projeto';

            $conexao = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

            if ($conexao->connect_errno) {
            echo "Erro de conexão: " . $conexao->connect_error; 
            } else {
            echo "Conexão bem-sucedida";
            }


             //recuperar e verificar se os dados ja existem
            $cpf = $_POST['cpf'];
            $cpf = mysqli_real_escape_string($conexao, $cpf); //impede de haver caracteres especiais

            $sql = "SELECT cpf FROM projeto.usuarios WHERE cpf='$cpf'"; //busca o cpf na tabela usuarios
            $retorno = mysqli_query($conexao, $sql); //retorna a consulta

             //busca a quantidade de usuarios registrados com o cpf digitado
            if (mysqli_num_rows($retorno)>0){ 
                echo"Usuario já cadastrado<br>";
                //VOLTAR PARA A PAGINA DE CADASTRO
                echo" <a href='index.html'>VOLTAR<";
            } else {

                $cpf = $_POST['cpf'];
                $nome = $_POST['nome'];
                $email = $_POST['email']; //CADASTRA O USUARIO
                $contato = $_POST['contato'];
                $endereco = $_POST['endereco'];

                    //INSERE OS DADOS DO USUARIO NA TABELA
                $sql = "INSERT INTO projeto.usuarios (cpf,nome,email,contato,endereco) VALUES('$cpf','$nome','$email','$contato','$endereco')";
                    
                $resultado = mysqli_query($conexao, $sql);
                echo">>USUARIO CADASTRADO COM SUCESSO <br>";
                 
                //VOLTAR PARA A PAGINA DE CADASTRO
                echo" <a href='index.html'>VOLTAR<";
            }



        ?>
    </body>
</html>
