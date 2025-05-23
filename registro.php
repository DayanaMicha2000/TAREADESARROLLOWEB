<?php
 
  include('includes/header.php');
?>

<body class="bg-purple-100 py-10">
 <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-xl my-12 w-full">
    <h2 class="text-2xl font-bold mb-6 text-center text-purple-700">Formulario de Registro</h2>

      <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
          <?php
            if ($_GET['error'] == 'usuario_existente') {
                echo "El nombre de usuario ya está registrado. Por favor, elige otro.";
            }
          ?>
        </div>
      <?php endif; ?>
    
    <form action="acciones/proceso_registro.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
      
      
      <div class="md:col-span-1 w-full">
        <label class="block mb-1 font-semibold">Cédula</label>
        <input type="text" name="cedula" class="w-full border border-gray-300 px-4 py-2 rounded-md" placeholder="Número de cédula" pattern="\d{10}" maxlength="10" minlength="10" inputmode="numeric" title="Debe contener solo 10 dígitos" required>
      </div>

      <div class="md:col-span-1 w-full">
        <label class="block mb-1 font-semibold">Nombre</label>
        <input type="text" name="nombres" class="w-full border border-gray-300 px-4 py-2 rounded-md" placeholder="Nombres" required>
      </div>

      <div class="md:col-span-1 w-full">
        <label class="block mb-1 font-semibold">Apellido</label>
        <input type="text" name="apellidos" class="w-full border border-gray-300 px-4 py-2 rounded-md" placeholder="Apellidos" required>
      </div>

      <div class="md:col-span-1 w-full">
        <label class="block mb-1 font-semibold">Correo electrónico</label>
        <input type="email" name="correo" class="w-full border border-gray-300 px-4 py-2 rounded-md" placeholder="Dirección de correo electrónico" required>
      </div>

      <div class="md:col-span-1 w-full">
        <label class="block mb-1 font-semibold">País</label>
        <input type="text" name="pais" class="w-full border border-gray-300 px-4 py-2 rounded-md" placeholder="País" required>
      </div>
      
      <div class="md:col-span-1 w-full">
        <label class="block mb-1 font-semibold">Ciudad</label>
        <input type="text" name="ciudad" class="w-full border border-gray-300 px-4 py-2 rounded-md" placeholder="Ciudad" required>
      </div>

      <div class="md:col-span-1 w-full">
        <label class="block mb-1 font-semibold">Teléfono</label>
        <input type="text" name="telefono" class="w-full border border-gray-300 px-4 py-2 rounded-md" placeholder="Número de teléfono" pattern="\d{10}" maxlength="10" minlength="10" inputmode="numeric" title="Debe contener solo 10 dígitos" required>
      </div>

      <div class="md:col-span-1 w-full">
        <label class="block mb-1 font-semibold">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" class="w-full border border-gray-300 px-4 py-2 rounded-md">
      </div>

      
      <div class="md:col-span-2 w-full"> 
        <label class="block mb-1 font-semibold">Dirección</label>
        <textarea name="direccion" rows="2" class="w-full border border-gray-300 px-4 py-2 rounded-md" placeholder="Dirección domiciliaria" required></textarea>
      </div>

      <div class="md:col-span-1 w-full">
        <label class="block mb-1 font-semibold">Nombre de Usuario</label>
        <input type="text" name="usuario" class="w-full border border-gray-300 px-4 py-2 rounded-md" placeholder="Usuario" required>
      </div>

      <div class="md:col-span-1 w-full">
        <label class="block mb-1 font-semibold">Contraseña</label>
        <div class="relative">
          <input type="password" id="contrasena" name="contrasena" class="w-full p-2 border border-gray-300 rounded-lg pr-10" placeholder="Contraseña" required>
          <button type="button" onclick="togglePassword()" class="absolute right-2 top-2 text-gray-600">
            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Botón de envío -->
      <div class="md:col-span-2 w-full">
        <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-md hover:bg-purple-700 transition">Registrarse</button>
        <p class="mt-4 text-center text-sm text-gray-950">
          ¿Ya tienes una cuenta?
          <a href="login.php" class="text-blue-500 hover:underline">Inicia sesión aquí</a>
        </p>
      </div>
    </form>
  </div>

  <script src="js/password.js"></script>
    <?php include 'includes/footer.php'; ?>
</body>
</html>