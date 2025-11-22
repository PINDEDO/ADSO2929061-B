<?php
abstract class Database{

    protected static $host = 'localhost';
    protected static $db = 'pokemondb';
    protected static $user = 'root';
    protected static $pass = '';
    protected static $charset = 'utf8mb4';

    protected static $pdo;
    protected static function connect(): PDO
    {

        if (self::$pdo !== null) {
            return self::$pdo;
        }
        $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            self::$pdo = new PDO($dsn, self::$user, self::$pass, $options);
            return self::$pdo;
        } catch (\PDOException $e) {

            throw new \PDOException("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }
}

class Tipo{
    protected $tipo;
    public function __construct(string $tipo){
        $this->tipo = $tipo;
    }
    public function getTipo(): string{
        return $this->tipo;
    }
    public function getDescripcionTipo(): string{
        return "Este Pokémon es de tipo: " . $this->tipo;
    }
}
class Pokemon extends Tipo{
    private $id;
    private $nombre;
    public function __construct(int $id, string $nombre, string $tipo){

        parent::__construct($tipo);
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getNombre(): string{
        return $this->nombre;
    }
}

class PokemonFetcher extends Database{
    public function fetchAllPokemons(): array{
        $pokemonesObjetos = [];
        $pdo = self::connect();
        $stmt = $pdo->query('SELECT id, nombre, tipo FROM pokemones');
        $datosPokemones = $stmt->fetchAll();

        foreach ($datosPokemones as $dato) {       
            $pokemon = new Pokemon(
                $dato['id'],
                $dato['nombre'],
                $dato['tipo'],
                
            );
            $pokemonesObjetos[] = $pokemon;
        }
        return $pokemonesObjetos;
    }
}

$pokemonesObjetos = [];
$errorPDO = null;

try {
    
    $fetcher = new PokemonFetcher();
    
    $pokemonesObjetos = $fetcher->fetchAllPokemons();

} catch (\PDOException $e) {
    
    $errorPDO = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio POO, Herencia y Clase Abstracta</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <h1>Listado de Pokemones (POO con Clase Abstracta)</h1>

    <div class="pokemon-container">
        <?php if ($errorPDO): ?>
            <p style="color: red; text-align: center; font-family: 'Fira Code', monospace;"><?= $errorPDO ?></p>
            <p style="color: var(--text-secondary); text-align: center;">Por favor, asegúrate de que tu base de datos
                'pokemondb' y la tabla 'pokemones' existan y que la configuración de usuario/contraseña sea correcta en la
                clase Abstracta Database.</p>
        <?php else: ?>
           
            <table class="pokemon-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo (Clase Padre)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   
                    foreach ($pokemonesObjetos as $pokemonObj):
                        ?>
                        <tr>
                            <td data-label="ID"><?= $pokemonObj->getId() ?></td>
                            <td data-label="Nombre"><?= $pokemonObj->getNombre() ?></td>
                            <td data-label="Tipo" class="tipo-cell"><?= $pokemonObj->getTipo() ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>