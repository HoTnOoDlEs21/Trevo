<?php
require_once("conexao_bd.php");
header("Content-Type: application/json");

if (!isset($_GET['terapeuta']) || !isset($_GET['data'])) {
    echo json_encode(["erro" => "Dados insuficientes"]);
    exit;
}

$terapeuta_id = intval($_GET['terapeuta']);
$data = $_GET['data'];

$sql = "SELECT hora_inicio, hora_fim FROM disponibilidade
        WHERE terapeuta_id = ? AND data = ? AND disponivel = 1
        ORDER BY hora_inicio ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $terapeuta_id, $data);
$stmt->execute();
$resultado = $stmt->get_result();

$horarios = [];

while ($row = $resultado->fetch_assoc()) {
    $inicio = strtotime($row['hora_inicio']);
    $fim    = strtotime($row['hora_fim']);

    while ($inicio <= $fim) {
        $slot = date("H:i:s", $inicio);

        // Verifica se este slot já foi reservado
        $check = $conn->prepare("SELECT id FROM agendamentos WHERE terapeuta_id = ? AND data = ? AND hora = ?");
        $check->bind_param("iss", $terapeuta_id, $data, $slot);
        $check->execute();
        $check->store_result();

        if ($check->num_rows === 0) {
            $horarios[] = $slot;
        }

        $check->close();
        $inicio += 3600;
    }
}


echo json_encode($horarios);
