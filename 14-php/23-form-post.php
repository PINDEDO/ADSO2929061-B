<?php 
$title = '23- Formularios POST';
$description = 'Recuperar datos desde una petición POST.';

include 'template/header.php';
?>

<section>
    <form action="" method="POST">
        <div class="row">
            <label for="nombre">Nombre Completo:</label>
            <input type="text" name="nombre" id="nombre">
        </div>
        <div class="row">
            <label for="correo">Correo:</label>
            <input type="email" name="correo" id="correo">
        </div>
        <div class="row">
            <input type="submit" value="Enviar Formulario">
            <input type="reset" value="Limpiar Formulario">
        </div>
    </form>

    <?php 
    $formularioEnviado = !empty($_POST);
    $camposCompletos = !empty($_POST['nombre']) && !empty($_POST['correo']);
    
    if ($formularioEnviado) {
        if ($camposCompletos) {
            $nombre = htmlspecialchars($_POST['nombre']);
            $correo = htmlspecialchars($_POST['correo']);
            ?>
            <div class="msg">
                <strong>Nombre Completo:</strong> <?php echo $nombre; ?>
                <br>
                <strong>Correo:</strong> <?php echo $correo; ?>
            </div>
        <?php } else { ?>
            <div class="error">
                <small>Por favor complete todos los campos</small>
            </div>
        <?php } ?>
    <?php } ?>
</section>

<?php include 'template/footer.php'; ?>