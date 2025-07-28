<?php
// ✅ Sanitiza entrada de texto (contra XSS e espaços)
function limparTexto($texto)
{
    return htmlspecialchars(trim(strip_tags($texto)), ENT_QUOTES, 'UTF-8');
}

// ✅ Verifica se email tem formato válido
function emailValido($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// ✅ Encripta password com padrão seguro
function criarHashPassword($senha)
{
    return password_hash($senha, PASSWORD_DEFAULT);
}

// ✅ Verifica password comparando com hash
function verificarPassword($senha, $hash)
{
    return password_verify($senha, $hash);
}

// ✅ Formata data para DD/MM/AAAA (proteção contra datas falsas)
function formatarData($data)
{
    if (empty($data) || $data === "0000-00-00") return "—";

    $d = DateTime::createFromFormat("Y-m-d", $data);
    return $d ? $d->format("d/m/Y") : "—";
}

// ✅ Formata hora para HHhMM
function formatarHora($hora)
{
    $t = DateTime::createFromFormat("H:i:s", $hora) ?: DateTime::createFromFormat("H:i", $hora);
    return $t ? $t->format("H\hi") : $hora;
}

// ✅ Junta data e hora num só texto (ex: 21/07/2025 às 09h30)
function formatarDataHora($data, $hora)
{
    return formatarData($data) . " às " . formatarHora($hora);
}

// ✅ Retorna nome do terapeuta via ID (ou "Desconhecido")
function obterNomeTerapeuta($conn, $id)
{
    $stmt = $conn->prepare("SELECT nome FROM terapeutas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nome);
    return $stmt->fetch() ? $nome : "Desconhecido";
}
