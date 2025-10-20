<?php 
    $title = '27- File Text';
    $description = 'Is used to open a file or URL.';

    include 'template/header.php';
    echo "<section>";

    $archivo = fopen('text/lorem.txt', 'r') 
    or exit("No se puede abrir!");

    while (!feof($archivo)) {
        echo fgets($archivo);
    }
    fclose($archivo);
?>
    <br><br>
    <div class="msg">
    <?php 
        $archivo = fopen('text/lorem.txt', 'r') 
        or exit("No se puede abrir!");

        while (!feof($archivo)) {
            echo fgetc($archivo).'🐘';
        }
        fclose($archivo);
    ?>
    </div>
<?php
    echo "</section>";
    include 'template/footer.php'; 
?>