<?php
include("../config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $cedula = $_POST['cedula'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    // Verificar si el nombre de usuario ya existe
    $verificar = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE usuario = ?");
    $verificar->bind_param("s", $usuario);
    $verificar->execute();
    $resultado = $verificar->get_result();
   
    if ($resultado->num_rows > 0) {
        // Redirigir con un parámetro de error
        header("Location: ../registro.php?error=usuario_existente");
        exit;
    }

    // Insertar nuevo usuario (omitimos el campo 'id' ya que es autoincremental)
    $stmt = $conexion->prepare("INSERT INTO usuarios (cedula, nombres, apellidos, pais, ciudad, correo, telefono, direccion, usuario, contrasena, fecha_nacimiento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $cedula, $nombres, $apellidos, $pais, $ciudad, $correo, $telefono, $direccion, $usuario, $contrasena, $fecha_nacimiento);

    if ($stmt->execute()) {
        // Obtener el ID del nuevo usuario
        $nuevo_id = $conexion->insert_id;

        // Iniciar sesión y redirigir
        session_start();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['usuario_id'] = $nuevo_id; 
        header("Location: ../perfil.php");
        exit;
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
