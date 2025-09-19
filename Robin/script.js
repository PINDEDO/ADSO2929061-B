// script.js
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que se envíe el formulario por defecto

    // Obtiene los valores del formulario
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Validación simple
    if (!email || !password) {
        alert('Por favor, complete todos los campos.');
        return;
    }

    // Aquí podrías agregar lógica para validar el usuario contra una API o base de datos
    console.log('Email:', email);
    console.log('Password:', password);

    // Simulación de inicio de sesión exitoso
    alert('Inicio de sesión exitoso!');
});