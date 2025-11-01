<?php 
session_start();

$title = '30- Sesiones';
$description = 'Mecanismo para almacenar y recuperar datos entre múltiples peticiones de un usuario.';

include 'template/header.php';
?>

<section>
    <?php 
    // Verificar si se envió el formulario para cerrar sesión
    $cerrarSesion = !empty($_POST);
    
    if ($cerrarSesion) {
        unset($_SESSION['visitas']);
        session_destroy();
    }
    
    // Incrementar contador de visitas
    $existeContador = isset($_SESSION['visitas']);
    
    if ($existeContador) {
        $_SESSION['visitas']++;
    } else {
        $_SESSION['visitas'] = 1;
    }
    
    $numeroVisitas = $_SESSION['visitas'];
    $textoVisitas = ($numeroVisitas === 1) ? 'vez' : 'veces';
    ?>
    
    <p>
        <strong>Has visitado esta página:</strong>
        <?php echo $numeroVisitas . ' ' . $textoVisitas; ?>
    </p>
    
    <form action="" method="POST">
        <input type="submit" value="Cerrar Sesión" class="btn btn-danger" name="eliminar">
    </form>
</section>

<?php include 'template/footer.php'; ?>