<?php
session_start();
include 'includes/header.php';
include("config/conexion.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];

// Obtener el id_usuario desde la base de datos
$sql_id = "SELECT id_usuario FROM usuarios WHERE usuario = ?";
$stmt_id = $conexion->prepare($sql_id);
$stmt_id->bind_param("s", $usuario);
$stmt_id->execute();
$result_id = $stmt_id->get_result();

if ($result_id->num_rows !== 1) {
    header("Location: login.php");
    exit;
}

$fila_id = $result_id->fetch_assoc();
$id_usuario = $fila_id['id_usuario'];

// Consulta para obtener cursos inscritos del usuario
$sql = "SELECT c.id_curso, c.nombre, c.descripcion, c.fecha_inicio, c.fecha_fin, c.cupos
        FROM cursos c
        INNER JOIN inscripciones i ON c.id_curso = i.id_curso
        WHERE i.id_usuario = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!-- Estructura general: flex column y min-h-screen -->
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Contenido principal -->
    <main class="flex-grow">
        <div class="max-w-6xl mx-auto px-6 py-6">
            <h1 class="text-3xl font-bold mb-6">Mis Cursos Inscritos</h1>

            <?php if ($resultado->num_rows > 0): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php while ($curso = $resultado->fetch_assoc()): ?>
                        <div class="bg-white p-4 rounded shadow relative">
                            <h2 class="text-xl font-semibold mb-2"><?= htmlspecialchars($curso['nombre']) ?></h2>
                            <p class="text-gray-700 mb-2"><?= nl2br(htmlspecialchars($curso['descripcion'])) ?></p>
                            <p><strong>Inicio:</strong> <?= htmlspecialchars($curso['fecha_inicio']) ?></p>
                            <p><strong>Fin:</strong> <?= htmlspecialchars($curso['fecha_fin']) ?></p>
                            <p><strong>Cupos:</strong> <?= htmlspecialchars($curso['cupos']) ?></p>

                            <form action="acciones/eliminar_inscripcion.php" method="POST" class="mt-4">
                                <input type="hidden" name="id_curso" value="<?= $curso['id_curso'] ?>" />
                                <button type="submit"
                                    onclick="return confirm('¿Seguro que quieres eliminar esta inscripción?');"
                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                    Eliminar inscripción
                                </button>
                            </form>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>No estás inscrito en ningún curso aún.</p>
            <?php endif; ?>
        </div>
    </main>

    <!-- Footer incluido -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>
