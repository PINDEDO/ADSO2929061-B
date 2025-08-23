<?php
$title = "PHP Info";
$description = "Muestra la configuración actual de PHP usando la función <code>phpinfo()</code>. Ideal para depuración.";
include 'template.php';
?>

<!-- Contenido del ejercicio -->
<div class="mt-6 text-sm">
    <p class="mb-4 text-gray-700">
        A continuación se muestra la información técnica de tu entorno PHP.
    </p>
    <?php phpinfo(); ?>
</div>