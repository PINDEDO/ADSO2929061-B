<?php 

    $title = '19- Functions';
    $description = 'A block of code designed to perform a specific, reusable task.';

    include 'template/header.php';
    echo "<section>";

    function mostrarInformacion() {
        echo "<p> <b>Bienvenido:</b> John Wick </p>";
        echo "<p> Es una serie de películas de acción estadounidense protagonizada por Keanu Reeves como un legendario asesino retirado que vuelve a la acción para vengarse tras el robo de su auto y la muerte de su perrita, un regalo final de su esposa fallecida. </p>";
    }


    mostrarInformacion();
    mostrarInformacion();


    echo "</section>";

    include 'template/footer.php'; 
?>