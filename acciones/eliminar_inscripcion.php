<?php
session_start();
include("../config/conexion.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_POST['id_curso'])) {
    header("Location: ../miscursos.php?mensaje=Curso no seleccionado");
    exit;
}

$id_curso = intval($_POST['id_curso']);
$usuario = $_SESSION['usuario'];

// Obtener id_usuario
$sql = "SELECT id_usuario FROM usuarios WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();
$fila = $result->fetch_assoc();
$id_usuario = $fila['id_usuario'];
$stmt->close();

// Eliminar inscripción
$delete = $conexion->prepare("DELETE FROM inscripciones WHERE id_usuario = ? AND id_curso = ?");
$delete->bind_param("ii", $id_usuario, $id_curso);

if ($delete->execute()) {
    // Aumentar cupos al eliminar inscripción
    $update = $conexion->prepare("UPDATE cursos SET cupos = cupos + 1 WHERE id_curso = ?");
    $update->bind_param("i", $id_curso);
    $update->execute();
    $update->close();

    $mensaje = "Inscripción eliminada correctamente";
} else {
    $mensaje = "Error al eliminar la inscripción";
}

$delete->close();
$conexion->close();

header("Location: ../miscursos.php?mensaje=" . urlencode($mensaje));
exit;
?>
