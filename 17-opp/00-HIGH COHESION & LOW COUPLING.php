<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php
    class Producto
    {

        public $nombre;
        public $precio;
        public $disponible = true;


        public function __construct($nombre, $precio)
        {
            $this->nombre = $nombre;
            $this->precio = $precio;
        }


        public function mostrarPrecio()
        {
            return "El precio de " . $this->nombre . " es $" . $this->precio;
        }

        public function cambiarDisponibilidad()
        {
            $this->disponible = !$this->disponible;
        }
    }


    $producto1 = new Producto("Laptop", 1200);
    $producto2 = new Producto("Teléfono", 800);


    echo $producto1->mostrarPrecio();
    echo "<br>";
    echo $producto2->mostrarPrecio();
    echo "<br>";

    $producto1->cambiarDisponibilidad();
    var_dump($producto1->disponible);
    ?>

</body>

</html>