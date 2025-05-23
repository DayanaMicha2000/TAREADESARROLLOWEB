<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cursos Online</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="flex flex-col min-h-screen bg-gray-100 text-gray-800">
  <!-- Barra de navegación -->
  <nav class="bg-violet-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex items-center">
          <i class="fas fa-graduation-cap text-white text-2xl mr-2"></i>
          <a href="index.php" class="text-xl font-bold text-white">CursosOnline</a>
        </div>
        <div class="flex items-center space-x-4">
          <?php if (isset($_SESSION['usuario'])): ?>
            <span class="text-white font-semibold">Hola, <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>

            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
              <!-- Menú para Administrador -->
              <a href="admin_cursos.php" class="<?= ($current_page == 'admin_cursos.php') ? 'text-white font-bold border-b-2 border-white' : 'text-gray-950 font-bold hover:text-white'; ?>">Gestión de Cursos</a>
              <a href="inscriptos.php" class="<?= ($current_page == 'ver_inscriptos.php') ? 'text-white font-bold border-b-2 border-white' : 'text-gray-950 font-bold hover:text-white'; ?>">Inscriptos</a>
              <a href="usuarios.php" class="<?= ($current_page == 'usuarios.php') ? 'text-white font-bold border-b-2 border-white' : 'text-gray-950 font-bold hover:text-white'; ?>">Usuarios</a>
            <?php else: ?>
              <!-- Menú para Usuario común -->
              <a href="cursos.php" class="<?= ($current_page == 'cursos.php') ? 'text-white font-bold border-b-2 border-white' : 'text-gray-950 font-bold hover:text-white'; ?>">Cursos</a>
              <a href="miscursos.php" class="<?= ($current_page == 'miscursos.php') ? 'text-white font-bold border-b-2 border-white' : 'text-gray-950 font-bold hover:text-white'; ?>">Mis Cursos</a>
            <?php endif; ?>

            <a href="perfil.php" class="<?= ($current_page == 'perfil.php') ? 'text-white font-bold border-b-2 border-white' : 'text-gray-950 font-bold hover:text-white'; ?>">Perfil</a>

            <form action="acciones/logout.php" method="POST" class="inline">
              <button type="submit" class="text-gray-950 font-bold hover:text-white">Cerrar Sesión</button>
            </form>

          <?php else: ?>
            <!-- Menú para visitante no logueado -->
            <a href="index.php" class="<?= ($current_page == 'index.php') ? 'text-white font-bold border-b-2 border-white' : 'text-gray-950 font-bold hover:text-white'; ?>">Inicio</a>
            <a href="registro.php" class="<?= ($current_page == 'registro.php') ? 'text-white font-bold border-b-2 border-white' : 'text-gray-950 font-bold hover:text-white'; ?>">Registrarse</a>
            <a href="login.php" class="<?= ($current_page == 'login.php') ? 'text-white font-bold border-b-2 border-white' : 'text-gray-950 font-bold hover:text-white'; ?>">Iniciar sesión</a>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </nav>