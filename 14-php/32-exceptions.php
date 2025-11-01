<?php 
$title = '32- Excepciones';
$description = 'Es un objeto que describe un error o comportamiento inesperado.';

include 'template/header.php';
?>

<section>
    <form action="" method="POST">
        <div class="row">
            <input type="number" class="form-control" name="edad" placeholder="Ingresa tu edad" required>
        </div>
        <div class="row">
            <input type="submit" value="Validar" class="btn btn-success">
        </div>
    </form>

    <?php 
    $formularioEnviado = !empty($_POST);
    
    if ($formularioEnviado) {
        function validarEdad($edad) {
            $edadMinima = 18;
            $esMenorDeEdad = $edad < $edadMinima;
            
            if ($esMenorDeEdad) {
                throw new Exception("No puedes votar!");
            }
            
            return true;
        }
        
        try {
            $edad = intval($_POST['edad']);
            validarEdad($edad);
            ?>
            <div class="msg">
                ¡Puedes votar!
            </div>
        <?php } catch (Exception $error) { ?>
            <div class="error">
                Error: <?php echo $error->getMessage(); ?>
            </div>
        <?php }
    } ?>
</section>

<?php include 'template/footer.php'; ?>