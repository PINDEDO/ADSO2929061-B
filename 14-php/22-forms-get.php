<?php 
    $title = '22- Forms Get';
    $description = 'Retrieve data from a GET request.';

    include 'template/header.php';
    echo "<section>";
?>
<form action="" method="GET">
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

<?php if ($_GET): ?>
    <?php if (!empty($_GET['nombre']) && !empty($_GET['correo'])): ?>
    <div class="msg">
        <strong>Nombre Completo:</strong> <?php echo $_GET['nombre']; ?>
        <br>
        <strong>Correo:</strong> <?php echo $_GET['correo']; ?>
    </div>
    <?php else: ?>
        <div class="error">
            <small>Por favor complete los campos</small>
        </div>
    <?php endif ?>
<?php endif ?>

<?php 
    echo "</section>";
    include 'template/footer.php' 
?>