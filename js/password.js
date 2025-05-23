function togglePassword() {
  const input = document.getElementById("contrasena");
  const icono = document.getElementById("eyeIcon");

  if (input.type === "password") {
    input.type = "text";
    icono.innerHTML = `
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7
        a9.956 9.956 0 012.177-3.294m1.64-1.64A9.956 9.956 0 0112 5c4.478 0 
        8.268 2.943 9.542 7a9.956 9.956 0 01-4.21 5.042M15 12a3 3 0 11-6 0 
        3 3 0 016 0z" />
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
        d="M3 3l18 18" />`;
  } else {
    input.type = "password";
    icono.innerHTML = `
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 
        9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
  }
}
