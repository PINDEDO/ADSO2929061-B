<?php 
    $title = '31- Send Mail';
    $description = 'Function for sending emails directly from the server.';

    include 'template/header.php';
    echo "<section>";
?>
<form action="" method="POST">
    <div class="row">
        <input type="email" name="correo" placeholder="Correo">
    </div>
    <div class="row">
        <input type="text" name="asunto" placeholder="Asunto">
    </div>
    <div class="row">
        <textarea name="mensaje" rows="4" placeholder="Mensaje"></textarea>
    </div>
    <div class="row">
        <input type="submit" value="Enviar" class="btn btn-outline-success">
        <input type="reset" value="Limpiar Formulario" class="btn btn-outline-secondary">
    </div>
</form>

<?php 
    if ($_POST) {
        $correo = $_POST['correo'];
        $asunto = $_POST['asunto'];
        $mensaje = $_POST['mensaje'];
?>
<?php if (mail('ofaczero@gmail.com', "Asunto: $asunto", "Mensaje: $mensaje", "From: $correo")): ?>
    <div class="msg">
        El correo ha sido enviado exitosamente!
    </div>
<?php else: ?>
    <div class="error">
        El correo no pudo ser enviado!
    </div>
<?php endif ?>
<?php } ?>

<?php 
    echo "</section>";
    include 'template/footer.php' 
?>