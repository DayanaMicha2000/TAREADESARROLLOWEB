<?php
session_start();
include("../config/conexion.php");


$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();

    if ($contrasena === $fila['contrasena']) {
        $_SESSION['usuario'] = $fila['usuario'];
        $_SESSION['id_usuario'] = $fila['id_usuario'];
          $_SESSION['rol'] = $fila['rol'];
        header("Location: ../perfil.php");
        exit;
    } else {
        header("Location: ../login.php?error=contrasena");
        exit;
    }
} else {
    header("Location: ../login.php?error=usuario");
    exit;
}
?>
