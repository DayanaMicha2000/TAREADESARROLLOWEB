<?php
session_start();
include("../config/conexion.php"); // Ajusta la ruta

// Verificar que el usuario esté logueado y que id_usuario esté en sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit;
}

// Obtener id_usuario desde la base de datos
$usuario = $_SESSION['usuario'];

$sql_id = "SELECT id_usuario FROM usuarios WHERE usuario = ?";
$stmt_id = $conexion->prepare($sql_id);
$stmt_id->bind_param("s", $usuario);
$stmt_id->execute();
$result_id = $stmt_id->get_result();

if ($result_id->num_rows !== 1) {
    // Usuario no encontrado o error
    header("Location: ../login.php");
    exit;
}

$fila_id = $result_id->fetch_assoc();
$id_usuario = $fila_id['id_usuario'];
$stmt_id->close();

// Verificar que se envió id_curso por POST
if (!isset($_POST['id_curso'])) {
    header("Location: ../cursos.php?error=curso_no_seleccionado");
    exit;
}

$id_curso = intval($_POST['id_curso']);

// Verificar si ya está inscrito en el curso
$verificar = $conexion->prepare("SELECT 1 FROM inscripciones WHERE id_usuario = ? AND id_curso = ?");
$verificar->bind_param("ii", $id_usuario, $id_curso);
$verificar->execute();
$resultado = $verificar->get_result();

if ($resultado->num_rows > 0) {
    $verificar->close();
    header("Location: ../miscursos.php?mensaje=Ya estás inscrito en este curso");
    exit;
}
$verificar->close();

// Verificar cupos disponibles
$cupos_stmt = $conexion->prepare("SELECT cupos FROM cursos WHERE id_curso = ?");
$cupos_stmt->bind_param("i", $id_curso);
$cupos_stmt->execute();
$cupos_resultado = $cupos_stmt->get_result();

if ($cupos_resultado->num_rows === 0) {
    $cupos_stmt->close();
    header("Location: ../cursos.php?error=curso_invalido");
    exit;
}

$curso = $cupos_resultado->fetch_assoc();
$cupos_stmt->close();

if ($curso['cupos'] <= 0) {
    header("Location: ../miscursos.php?mensaje=No hay cupos disponibles para este curso");
    exit;
}

// Insertar la inscripción
$insertar = $conexion->prepare("INSERT INTO inscripciones (id_usuario, id_curso) VALUES (?, ?)");
$insertar->bind_param("ii", $id_usuario, $id_curso);
if (!$insertar->execute()) {
    // Error al insertar
    $insertar->close();
    header("Location: ../cursos.php?error=error_inscripcion");
    exit;
}
$insertar->close();

// Actualizar cupos
$actualizar = $conexion->prepare("UPDATE cursos SET cupos = cupos - 1 WHERE id_curso = ?");
$actualizar->bind_param("i", $id_curso);
$actualizar->execute();
$actualizar->close();

// Redirigir con mensaje éxito
header("Location: ../miscursos.php?mensaje=Inscripción exitosa");
exit;
?>
