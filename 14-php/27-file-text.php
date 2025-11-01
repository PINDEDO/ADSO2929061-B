<?php 
$title = '27- Archivos de Texto';
$description = 'Se usa para abrir un archivo o URL.';

include 'template/header.php';
?>

<section>
    <?php
    // Leer archivo línea por línea
    $archivo = fopen('example.txt', 'r') or exit("No se puede abrir el archivo!");

    while (!feof($archivo)) {
        echo fgets($archivo);
    }
    
    fclose($archivo);
    ?>

    <br><br>

    <div class="msg">
        <?php 
        // Leer archivo carácter por carácter
        $archivo = fopen('example.txt', 'r') or exit("No se puede abrir el archivo!");

        while (!feof($archivo)) {
            $caracter = fgetc($archivo);
            echo $caracter . '😒';
        }
        
        fclose($archivo);
        ?>
    </div>
</section>

<?php include 'template/footer.php'; ?>