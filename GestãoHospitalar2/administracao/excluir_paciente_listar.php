<?php
require_once 'conexao.php';

if (!isset($_GET['idpacientes']) || !is_numeric($_GET['idpacientes'])) {
    die("ID de paciente inválido.");
}

$idpacientes = (int) $_GET['idpacientes'];

// Excluir os registros relacionados na tabela 'agendamento'
$query_excluir_agendamentos = "DELETE FROM agendamento WHERE id_paciente_agendamento = '{$idpacientes}'";
$resultado_agendamentos = mysqli_query($mysqli, $query_excluir_agendamentos);

if ($resultado_agendamentos) {
    // Se os agendamentos foram excluídos com sucesso, exclua o paciente
    $query_excluir_paciente = "DELETE FROM pacientes WHERE idpacientes = '{$idpacientes}'";
    $resultado_paciente = mysqli_query($mysqli, $query_excluir_paciente);

    if ($resultado_paciente) {
        // Redireciona para a lista de pacientes após a exclusão
        header("Location: listar_pacientes.php");
        exit;
    } else {
        echo "Erro ao excluir o paciente: " . mysqli_error($mysqli);
    }
} else {
    echo "Erro ao excluir os agendamentos: " . mysqli_error($mysqli);
}
?>
