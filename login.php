<?php include 'includes/header.php'; ?>

<body class="bg-purple-100">
  <div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-bold mb-6 text-center text-purple-700">Iniciar Sesión</h2>
      <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
          <?php
            if ($_GET['error'] == 'contrasena') {
                echo "Contraseña incorrecta. Intenta nuevamente.";
            } elseif ($_GET['error'] == 'usuario') {
                echo "Usuario no encontrado.";
            }
          ?>
        </div>
      <?php endif; ?>

      <form action="acciones/proceso_login.php" method="POST" class="space-y-4">
        <div>
          <label for="usuario" class="block text-gray-700 font-semibold">Usuario:</label>
          <input type="text" name="usuario" id="usuario" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400">
        </div>
        <div>
          <label for="contrasena" class="block text-gray-700 font-semibold">Contraseña:</label>
          <div class="relative">
            <input type="password" name="contrasena" id="contrasena" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 pr-10">
            <button type="button" onclick="togglePassword()" class="absolute right-2 top-2.5 text-gray-600">
              <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 
                  4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
            </button>
          </div>
        </div>
        <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded hover:bg-purple-700 transition">Iniciar Sesión</button>
      </form>

      <p class="text-center mt-4 text-sm text-gray-950">
        ¿No tienes una cuenta?
        <a href="registro.php" class="text-blue-500 hover:underline">Regístrate aquí</a>
      </p>
    </div>
  </div>

  <script src="js/password.js"></script>
    <?php include 'includes/footer.php'; ?>
</body>
</html>

