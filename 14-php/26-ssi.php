<?php 
$title = '26- Inclusión del Lado del Servidor';
$description = 'Se usa para incluir el contenido de un archivo en otro.';

include 'template/header.php';
?>

<section>
    <?php
    // require: Incluye archivo y genera error fatal si no existe
    require 'template/footer.php';
    
    // include_once: Incluye solo una vez
    include_once 'template/content.php';
    
    // require_once: Requiere solo una vez
    require_once 'template/header.php';
    ?>
</section>

<?php include 'template/footer.php'; ?>