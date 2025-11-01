<?php 

$nombreCookie = 'nombre';
$valorCookie = 'Abelardo presidente';
$tiempoExpiracion = time() + 30;

setcookie($nombreCookie, $valorCookie, $tiempoExpiracion);
?>

<?php 
$title = '29- Cookies';
$description = 'Mecanismo para almacenar datos en el navegador remoto.';

include 'template/header.php';
?>

<section>
    <div class="msg">
        <small>Ver Cookies: Ve a consola/storage/cookies</small>
        <br>
        <?php 
        $existeCookie = isset($_COOKIE['nombre']);
        
        if ($existeCookie) { 
            $nombreUsuario = $_COOKIE['nombre'];
            ?>
            <p> 
                <strong>Nombre:</strong> <?php echo $nombreUsuario; ?> 
            </p>
        <?php } else { ?>
            <p>¡Bienvenido Invitado!</p>
        <?php } ?>
    </div>
</section>

<?php include 'template/footer.php'; ?>