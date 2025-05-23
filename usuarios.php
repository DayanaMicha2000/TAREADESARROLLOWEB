<?php
session_start();
include 'includes/header.php';
include 'config/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Consulta para obtener todos los usuarios
$sql = "SELECT id_usuario, cedula, usuario, contrasena, correo, nombres, apellidos, pais, ciudad, telefono, direccion, fecha_nacimiento FROM usuarios";
$result = $conexion->query($sql);

$usuarios = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}
?>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Contenido principal -->
    <main class="flex-grow">
<div class="max-w-7xl mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold mb-6 text-purple-800">Usuarios Registrados</h1>

    <?php if(count($usuarios) > 0): ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded">
                <thead>
                    <tr class="bg-violet-600 text-white text-left">
                        <th class="py-2 px-4 border">ID</th>
                        <th class="py-2 px-4 border">Usuario</th>
                        <th class="py-2 px-4 border">Contraseña</th>
                        <th class="py-2 px-4 border">Correo</th>
                        <th class="py-2 px-4 border">Nombres</th>
                        <th class="py-2 px-4 border">Apellidos</th>
                        <th class="py-2 px-4 border">Cédula</th>
                        <th class="py-2 px-4 border">País</th>
                        <th class="py-2 px-4 border">Ciudad</th>
                        <th class="py-2 px-4 border">Teléfono</th>
                        <th class="py-2 px-4 border">Dirección</th>
                        <th class="py-2 px-4 border">Fecha de Nacimiento</th>    

                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usuarios as $usuario): ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-2 px-4 border"><?= $usuario['id_usuario'] ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($usuario['usuario']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($usuario['contrasena']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($usuario['correo']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($usuario['nombres']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($usuario['apellidos']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($usuario['cedula']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($usuario['pais']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($usuario['ciudad']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($usuario['telefono']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($usuario['direccion']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($usuario['fecha_nacimiento']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>No hay usuarios registrados aún.</p>
    <?php endif; ?>
</div>

    </main>

    <!-- Footer incluido -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>
