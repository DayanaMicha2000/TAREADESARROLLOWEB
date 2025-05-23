<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: /CURSOSPHP/index.php");
    exit;
}

include("../config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $usuario = $_SESSION['usuario'];

    $stmt = $conexion->prepare("UPDATE usuarios SET cedula = ?, nombres = ?, apellidos = ?, pais = ?, ciudad = ?, correo = ?, telefono = ?, direccion = ?, fecha_nacimiento = ? WHERE usuario = ?");
    $stmt->bind_param("ssssssssss", $cedula, $nombres, $apellidos, $pais, $ciudad, $correo, $telefono, $direccion, $fecha_nacimiento, $usuario);

    if ($stmt->execute()) {
        $_SESSION['nombre_completo'] = $nombres . ' ' . $apellidos;
        header("Location: /CURSOSPHP/perfil.php?actualizado=1");
        exit;
    } else {
        echo "Error al actualizar el perfil: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
