<?php
session_start();
require 'config/conexion.php';
include 'includes/header.php';

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: admin_cursos.php");
    exit;
}

$id_curso = $_GET['id'];

// Obtener datos del curso
$stmt = $conexion->prepare("SELECT * FROM cursos WHERE id_curso = ?");
$stmt->bind_param("i", $id_curso);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows !== 1) {
    header("Location: admin_cursos.php");
    exit;
}

$curso = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $cupos = $_POST['cupos'];

    $update = $conexion->prepare("UPDATE cursos SET nombre=?, descripcion=?, fecha_inicio=?, fecha_fin=?, cupos=? WHERE id_curso=?");
    $update->bind_param("ssssii", $nombre, $descripcion, $fecha_inicio, $fecha_fin, $cupos, $id_curso);
    $update->execute();

    header("Location: admin_cursos.php?mensaje=Curso actualizado exitosamente");
    exit;
}
?>


<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Contenido principal -->
    <main class="flex-grow">
        <div class="max-w-3xl mx-auto px-6 py-8">
            <!-- Botón de regreso alineado a la derecha -->
            <div class="mb-4 pl-2">
                <a href="admin_cursos.php" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
                    ← Volver a la lista de cursos
                </a>
            </div>
            <h1 class="text-2xl font-bold mb-6">Editar Curso</h1>
            <form method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <label class="block mb-2">Nombre:</label>
                <input type="text" name="nombre" class="w-full mb-4 p-2 border rounded" value="<?= htmlspecialchars($curso['nombre']) ?>" required>

                <label class="block mb-2">Descripción:</label>
                <textarea name="descripcion" class="w-full mb-4 p-2 border rounded" required><?= htmlspecialchars($curso['descripcion']) ?></textarea>

                <label class="block mb-2">Fecha de inicio:</label>
                <input type="date" name="fecha_inicio" class="w-full mb-4 p-2 border rounded" value="<?= $curso['fecha_inicio'] ?>" required>

                <label class="block mb-2">Fecha de fin:</label>
                <input type="date" name="fecha_fin" class="w-full mb-4 p-2 border rounded" value="<?= $curso['fecha_fin'] ?>" required>

                <label class="block mb-2">Cupos:</label>
                <input type="number" name="cupos" class="w-full mb-4 p-2 border rounded" value="<?= $curso['cupos'] ?>" required>

                <button type="submit" class="bg-violet-600 text-white px-4 py-2 rounded">Actualizar Curso</button>
            </form>
        </div>
    </main>

    <!-- Footer incluido -->
    <?php include 'includes/footer.php'; ?>
</body>

</html>