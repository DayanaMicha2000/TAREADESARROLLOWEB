<?php
session_start();
include 'includes/header.php';
include("config/conexion.php");

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit;
}
?>

<body>
    <main class="flex-grow">
        <div class="max-w-7xl mx-auto p-6">
            <h1 class="text-3xl font-bold mb-6 text-purple-800">Administrar Cursos</h1>

            <div class="mb-4">
                <a href="crear_curso.php" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    + Agregar Nuevo Curso
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded shadow-md">
                    <thead>
                        <tr class="bg-purple-600 text-white">
                            <th class="px-4 py-2 text-left">Nombre</th>
                            <th class="px-4 py-2 text-left">Inicio</th>
                            <th class="px-4 py-2 text-left">Fin</th>
                            <th class="px-4 py-2 text-left">Cupos</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM cursos";
                        $resultado = $conexion->query($sql);
                        while ($curso = $resultado->fetch_assoc()):
                        ?>
                            <tr class="border-t">
                                <td class="px-4 py-2"><?= htmlspecialchars($curso['nombre']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($curso['fecha_inicio']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($curso['fecha_fin']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($curso['cupos']) ?></td>
                                <td class="px-4 py-2 flex space-x-2 justify-center">
                                    <a href="editar_curso.php?id=<?= $curso['id_curso'] ?>" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                        Editar
                                    </a>
                                    <form action="acciones/eliminar_curso.php" method="POST" onsubmit="return confirm('¿Eliminar este curso?');">
                                        <input type="hidden" name="id_curso" value="<?= $curso['id_curso'] ?>">
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- Footer  -->
    <?php include 'includes/footer.php'; ?>
</body>

</html>