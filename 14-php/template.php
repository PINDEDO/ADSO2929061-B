<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Ejercicio PHP'; ?></title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Estilo personalizado (opcional) -->
    <link rel="stylesheet" href="css/master.css">
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <!-- Navegación -->
    <nav class="controls fixed top-4 left-4 z-50">
        <a href="index.html" class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 448 512">
                <path fill="currentColor" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
            </svg>
        </a>
    </nav>

    <!-- Contenido principal -->
    <main class="max-w-4xl mx-auto px-6 py-12 pt-20">
        <!-- Header dinámico -->
        <header class="mb-10 text-center">
            <h1 class="text-4xl font-bold text-blue-700"><?php echo $title ?? 'Título no definido'; ?></h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                <?php echo $description ?? 'Descripción no disponible.'; ?>
            </p>
        </header>

        <!-- Zona de contenido del ejercicio -->
        <section class="bg-white p-8 rounded-xl shadow-md mb-12 min-h-[300px]">
            <?php
            // Aquí irá el contenido específico de cada ejercicio
            ?>
        </section>

        <!-- Footer dinámico -->
        <footer class="text-center text-gray-500 text-sm border-t pt-6">
            <p>
                Ejercicio práctico de <span class="font-semibold">PHP Básico</span> 
                — <?php echo $title ?? 'un ejercicio'; ?>.
            </p>
            <p class="mt-1">© 2025 AprendePHP. Todos los derechos reservados.</p>
        </footer>
    </main>

</body>
</html>