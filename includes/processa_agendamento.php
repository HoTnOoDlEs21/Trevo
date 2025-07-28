<?php
require_once("conexao_bd.php");

function registarLog($dados)
{
    file_put_contents("log_agendamento.txt", date("Y-m-d H:i:s") . " | " . json_encode($dados) . "\n", FILE_APPEND);
}

file_put_contents("log_agendamento_data.txt", date("Y-m-d H:i:s") . " | RECEBIDO: " . ($_POST['data'] ?? '—') . "\n", FILE_APPEND);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome      = trim($_POST['nome'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $terapia   = trim($_POST['terapia'] ?? '');
    $terapeuta = intval($_POST['terapeuta'] ?? 0);
    $data      = trim($_POST['data'] ?? '');
    $hora      = trim($_POST['hora'] ?? '');

    registarLog($_POST);

    if (empty($nome) || empty($email) || empty($terapia) || empty($terapeuta) || empty($data) || empty($hora)) {
        echo "Por favor preencha todos os campos.";
        exit;
    }

    // Valida e formata data
    $obj_data = DateTime::createFromFormat("Y-m-d", $data);
    if (!$obj_data || $obj_data->format("Y-m-d") !== $data) {
        echo "Data inválida.";
        exit;
    }
    $data_formatada = $obj_data->format("Y-m-d");

    // Valida e formata hora
    $obj_hora = DateTime::createFromFormat("H:i", $hora) ?: DateTime::createFromFormat("H:i:s", $hora);
    if (!$obj_hora) {
        echo "Hora inválida.";
        exit;
    }
    $hora_formatada = $obj_hora->format("H:i:s");

    // Verifica duplicação
    $verifica_agendamento = "SELECT id FROM agendamentos WHERE terapeuta_id = ? AND data = ? AND hora = ?";
    $stmt = $conn->prepare($verifica_agendamento);
    $stmt->bind_param("iss", $terapeuta, $data_formatada, $hora_formatada);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Este horário já está ocupado.";
        exit;
    }

    // Verifica disponibilidade
    $verifica_disponibilidade = "SELECT id FROM disponibilidade
                                 WHERE terapeuta_id = ? AND data = ? AND disponivel = 1
                                 AND hora_inicio <= ? AND hora_fim >= ?";
    $stmt = $conn->prepare($verifica_disponibilidade);
    $stmt->bind_param("isss", $terapeuta, $data_formatada, $hora_formatada, $hora_formatada);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 0) {
        echo "Este horário não está disponível.";
        exit;
    }

    // Insere agendamento com data embutida
    $insert_sql = "INSERT INTO agendamentos (paciente_nome, paciente_email, terapeuta_id, data, hora, terapia)
                   VALUES (?, ?, ?, '$data_formatada', ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("ssiss", $nome, $email, $terapeuta, $hora_formatada, $terapia);
    $stmt->execute();

    // Marca slot como ocupada
    $verifica_slot = "SELECT id FROM disponibilidade
                      WHERE terapeuta_id = ? AND data = ? AND hora_inicio = ? AND disponivel = 1";
    $stmt = $conn->prepare($verifica_slot);
    $stmt->bind_param("iss", $terapeuta, $data_formatada, $hora_formatada);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $hora_fim_slot = date("H:i:s", strtotime($hora_formatada) + 3600);
        $insert_slot = "INSERT INTO disponibilidade (terapeuta_id, data, hora_inicio, hora_fim, disponivel)
                        VALUES (?, ?, ?, ?, 0)";
        $stmt = $conn->prepare($insert_slot);
        $stmt->bind_param("isss", $terapeuta, $data_formatada, $hora_formatada, $hora_fim_slot);
        $stmt->execute();
    } else {
        $update_slot = "UPDATE disponibilidade SET disponivel = 0
                        WHERE terapeuta_id = ? AND data = ? AND hora_inicio = ?";
        $stmt = $conn->prepare($update_slot);
        $stmt->bind_param("iss", $terapeuta, $data_formatada, $hora_formatada);
        $stmt->execute();
    }

    header("Location: ../agendamento.php?sucesso=1");
    exit;
} else {
    echo "Acesso inválido.";
    exit;
}
