<?php
session_start();
include 'includes/header.php';
include("config/conexion.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];

// Obtener el id_usuario
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

// Consulta para cursos no inscritos
$sql = "SELECT * FROM cursos 
        WHERE id_curso NOT IN (
            SELECT id_curso FROM inscripciones WHERE id_usuario = ?
        )";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<body class="bg-gray-100">
        <!-- Contenido principal -->
    <main class="flex-grow">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Cursos Disponibles</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php while($curso = $resultado->fetch_assoc()): ?>
                <div class="max-w-sm bg-white rounded-lg shadow-md p-4">
                    <h2 class="text-xl font-semibold text-purple-700 mb-2"><?php echo htmlspecialchars($curso['nombre']); ?></h2>
                    <p  class="text-gray-700 line-clamp-3 leading-relaxed mb-2"><?php echo htmlspecialchars($curso['descripcion']); ?></p>
                    <p class="text-sm text-gray-600 mb-1"><strong>Inicio:</strong> <?php echo htmlspecialchars($curso['fecha_inicio']); ?></p>
                    <p class="text-sm text-gray-600 mb-1"><strong>Fin:</strong> <?php echo htmlspecialchars($curso['fecha_fin']); ?></p>
                    <p class="text-sm text-gray-600 mb-4"><strong>Cupos:</strong> <?php echo htmlspecialchars($curso['cupos']); ?></p>
                    <form action="acciones/inscribirse.php" method="POST">
                        <input type="hidden" name="id_curso" value="<?php echo $curso['id_curso']; ?>">
                        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">
                            Inscribirse
                        </button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    </main>
      <?php include 'includes/footer.php'; ?>
</body>
 </html>
