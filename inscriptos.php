<?php
session_start();
include 'includes/header.php';
include 'config/conexion.php';

// Verificar que el usuario es admin
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Obtener lista de cursos para el select
$sql_cursos = "SELECT id_curso, nombre FROM cursos ORDER BY nombre";
$result_cursos = $conexion->query($sql_cursos);

// Curso seleccionado
$id_curso_seleccionado = $_GET['id_curso'] ?? null;
$inscritos = [];

if ($id_curso_seleccionado) {
    $stmt = $conexion->prepare(" SELECT u.id_usuario, u.usuario, u.correo, u.nombres, u.apellidos FROM usuarios u INNER JOIN inscripciones i ON u.id_usuario = i.id_usuario WHERE i.id_curso = ?");
    $stmt->bind_param("i", $id_curso_seleccionado);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $inscritos[] = $row;
    }
}
?>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Contenido principal -->
    <main class="flex-grow">
<div class="max-w-5xl mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold mb-6 text-purple-800">Inscritos por Curso</h1>

    <form method="GET" class="mb-6">
        <label for="id_curso" class="block mb-2 font-semibold">Seleccione un curso:</label>
        <select name="id_curso" id="id_curso" class="border rounded px-4 py-2 w-full max-w-md" onchange="this.form.submit()">
            <option value="">-- Seleccione --</option>
            <?php while ($curso = $result_cursos->fetch_assoc()): ?>
                <option value="<?= $curso['id_curso'] ?>" <?= ($id_curso_seleccionado == $curso['id_curso']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($curso['nombre']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>

    <?php if ($id_curso_seleccionado): ?>
        <h2 class="text-3xl font-bold mb-6 text-purple-800">Inscritos en: 
            <?php
                // Mostrar nombre del curso seleccionado
                $stmt_nombre = $conexion->prepare("SELECT nombre FROM cursos WHERE id_curso = ?");
                $stmt_nombre->bind_param("i", $id_curso_seleccionado);
                $stmt_nombre->execute();
                $res_nombre = $stmt_nombre->get_result()->fetch_assoc();
                echo htmlspecialchars($res_nombre['nombre']);
            ?>
        </h2>

        <?php if (count($inscritos) > 0): ?>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-violet-600 text-white">
                        <th class="p-2 border">ID Usuario</th>
                        <th class="p-2 border">Usuario</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Nombres</th>
                        <th class="p-2 border">Apellidos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inscritos as $inscrito): ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="p-2 border"><?= $inscrito['id_usuario'] ?></td>
                            <td class="p-2 border"><?= htmlspecialchars($inscrito['usuario']) ?></td>
                            <td class="p-2 border"><?= htmlspecialchars($inscrito['correo']) ?></td>
                            <td class="p-2 border"><?= htmlspecialchars($inscrito['nombres']) ?></td>
                            <td class="p-2 border"><?= htmlspecialchars($inscrito['apellidos']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay inscritos en este curso.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>

</main>

    <!-- Footer incluido -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>


