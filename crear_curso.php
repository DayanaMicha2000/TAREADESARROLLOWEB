<?php
session_start();
include 'includes/header.php';
include 'config/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $inicio = $_POST['fecha_inicio'];
    $fin = $_POST['fecha_fin'];
    $cupos = $_POST['cupos'];

    $sql = "INSERT INTO cursos (nombre, descripcion, fecha_inicio, fecha_fin, cupos)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $descripcion, $inicio, $fin, $cupos);
    $stmt->execute();

    header("Location: admin_cursos.php");
    exit;
}
?>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Contenido principal -->
    <main class="flex-grow">
<div class="max-w-3xl mx-auto px-6 py-8">
    <!-- Botón de regreso -->
    <div class="mb-4 pl-2">
        <a href="admin_cursos.php" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
            ← Volver a la lista de cursos
        </a>
    </div>

    <h1 class="text-2xl font-bold mb-6">Agregar Nuevo Curso</h1>

    <form method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <label class="block mb-2">Nombre</label>
        <input name="nombre" required class="w-full mb-4 p-2 border rounded" />

        <label class="block mb-2">Descripción</label>
        <textarea name="descripcion" required class="w-full mb-4 p-2 border rounded"></textarea>

        <label class="block mb-2">Fecha de Inicio</label>
        <input type="date" name="fecha_inicio" required class="w-full mb-4 p-2 border rounded" />

        <label class="block mb-2">Fecha de Fin</label>
        <input type="date" name="fecha_fin" required class="w-full mb-4 p-2 border rounded" />

        <label class="block mb-2">Cupos</label>
        <input type="number" name="cupos" required class="w-full mb-4 p-2 border rounded" />

        <button type="submit" class="bg-violet-600 text-white px-4 py-2 rounded hover:bg-violet-700">Guardar</button>
    </form>
</div>
    </main>

    <!-- Footer incluido -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>
