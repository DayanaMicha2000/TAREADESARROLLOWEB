<?php
session_start();
require '../config/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if (!isset($_POST['id_curso']) || !is_numeric($_POST['id_curso'])) {
    header("Location: ../admin_cursos.php?error=ID inválido");
    exit;
}
$id_curso = intval($_POST['id_curso']);


// Primero eliminar las inscripciones relacionadas (si existen)
$stmt_inscripciones = $conexion->prepare("DELETE FROM inscripciones WHERE id_curso = ?");
$stmt_inscripciones->bind_param("i", $id_curso);
$stmt_inscripciones->execute();

// Luego eliminar el curso
$stmt_curso = $conexion->prepare("DELETE FROM cursos WHERE id_curso = ?");
$stmt_curso->bind_param("i", $id_curso);

if ($stmt_curso->execute()) {
    header("Location: ../admin_cursos.php?mensaje=Curso eliminado correctamente");
} else {
    header("Location: ../admin_cursos.php?error=Error al eliminar el curso");
}

exit;
?>
