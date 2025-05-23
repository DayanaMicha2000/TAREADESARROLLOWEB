<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

include 'includes/header.php';
include("config/conexion.php");





$usuario = $_SESSION['usuario'];

$stmt = $conexion->prepare("SELECT cedula, nombres, apellidos, pais, ciudad, correo, telefono, direccion, usuario, fecha_nacimiento FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();
} else {
    echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4'>Usuario no encontrado.</div>";
    exit;
}


$stmt->close();
$conexion->close();
?>


<body class="bg-gray-100">
     <main class="flex-grow">
    <div class="max-w-6xl mx-auto my-8 px-4">
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            
            <div class="bg-violet-400 h-24 w-full"></div> 

            <!-- Contenedor -->
            <div class="flex flex-col lg:flex-row px-8 -mt-12">

                <!-- Sección de foto de perfil con icono SVG -->

                <div class="lg:w-1/5 mb-8 lg:mb-0 flex justify-center">
                    <div class="w-40 h-40 rounded-full bg-blue-100 border-4 border-white shadow-xl flex items-center justify-center">
                        <svg class="w-20 h-20 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>

                <!-- Sección de información -->
                <div class="lg:w-4/5 lg:pl-10 pb-8"> <!-- Añadido pb-8 para espacio inferior -->
                    <h2 class="text-3xl font-bold text-white mb-8">Información del Perfil</h2>

                    <form action="acciones/procesar_perfil.php" method="POST" class="space-y-6">
                        <!-- Primera fila de campos -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Grupo 1 -->
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-gray-700">Cédula</label>
                                <input type="text" name="cedula" value="<?php echo htmlspecialchars($fila['cedula']); ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>

                            <!-- Grupo 2 -->
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-gray-700">Nombres</label>
                                <input type="text" name="nombres" value="<?php echo htmlspecialchars($fila['nombres']); ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>

                            <!-- Grupo 3 -->
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-gray-700">Apellidos</label>
                                <input type="text" name="apellidos" value="<?php echo htmlspecialchars($fila['apellidos']); ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>

                        <!-- Segunda fila de campos -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Grupo 1 -->
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-gray-700">País</label>
                                <input type="text" name="pais" value="<?php echo htmlspecialchars($fila['pais']); ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>

                            <!-- Grupo 2 -->
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-gray-700">Ciudad</label>
                                <input type="text" name="ciudad" value="<?php echo htmlspecialchars($fila['ciudad']); ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>

                            <!-- Grupo 3 -->
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-gray-700">Fecha Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" value="<?php echo htmlspecialchars($fila['fecha_nacimiento']); ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>

                        <!-- Tercera fila de campos -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Grupo 1 -->
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                                <input type="email" name="correo" value="<?php echo htmlspecialchars($fila['correo']); ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>

                            <!-- Grupo 2 -->
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <input type="text" name="telefono" value="<?php echo htmlspecialchars($fila['telefono']); ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>

                        <!-- Campo de dirección (ancho completo) -->
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">Dirección</label>
                            <textarea name="direccion" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"><?php echo htmlspecialchars($fila['direccion']); ?></textarea>
                        </div>

                        <!-- Botones con margen inferior adicional -->
                        <div class="flex justify-end space-x-4 pt-8 pb-4"> <!-- Añadido pb-4 -->
                            <button type="submit" class="px-8 py-3 bg-violet-400 text-white rounded-lg hover:bg-violet-500 transition focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 font-medium">
                                Guardar Cambios
                            </button>
                        </div>
                </div>
            </div>

            <!-- Borde inferior decorativo -->
            <div class="border-t border-gray-200 mx-8"></div> <!-- Línea divisoria añadida -->
        </div>
    </div>

    
       </main>

    <!-- Footer incluido -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>