<?php 
    setcookie('nombre', 'Jeremias Springfield', time()+60);
?>
<?php 
    $title = '29- Cookies';
    $description = 'Mechanism for storing data in the remote browser.';

    include 'template/header.php';
    echo "<section>";
?>

<div class="msg">
    <small> Ver Cookies: Ve a consola/storage/cookies</small>
    <br>
    <?php if (isset($_COOKIE['nombre'])): ?>
        <p> 
            <strong>nombre:</strong>
            <?php echo $_COOKIE['nombre'] ?> 
        </p>
    <?php else: ?>
        <p>
            Bienvenido Invitado!
        </p>
    <?php endif ?>
</div>

<?php 
    echo "</section>";
    include 'template/footer.php' 
?>