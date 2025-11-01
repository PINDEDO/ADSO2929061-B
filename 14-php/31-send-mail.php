<?php 
$title = '31- Enviar Correo';
$description = 'Función para enviar correos electrónicos directamente desde el servidor.';

include 'template/header.php';
?>

<section>
    <form action="" method="POST">
        <div class="row">
            <input type="email" name="correo" placeholder="Correo" required>
        </div>
        <div class="row">
            <input type="text" name="asunto" placeholder="Asunto" required>
        </div>
        <div class="row">
            <textarea name="mensaje" rows="4" placeholder="Mensaje" required></textarea>
        </div>
        <div class="row">
            <input type="submit" value="Enviar" class="btn btn-outline-success">
            <input type="reset" value="Limpiar Formulario" class="btn btn-outline-secondary">
        </div>
    </form>

    <?php 
    $formularioEnviado = !empty($_POST);
    
    if ($formularioEnviado) {
        $correoRemitente = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
        $asunto = htmlspecialchars($_POST['asunto']);
        $mensaje = htmlspecialchars($_POST['mensaje']);
        
        $correoDestino = 'pinedo7u7@gmail.com';
        $asuntoCompleto = "Asunto: $asunto";
        $mensajeCompleto = "Mensaje: $mensaje";
        $encabezados = "From: $correoRemitente";
        
        $correoEnviado = mail($correoDestino, $asuntoCompleto, $mensajeCompleto, $encabezados);
        
        if ($correoEnviado) { ?>
            <div class="msg">
                ¡El correo ha sido enviado exitosamente!
            </div>
        <?php } else { ?>
            <div class="error">
                ¡El correo no pudo ser enviado!
            </div>
        <?php }
    } ?>
</section>

<?php include 'template/footer.php'; ?>