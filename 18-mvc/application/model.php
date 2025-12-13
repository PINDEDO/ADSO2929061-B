<?php 

class Model extends Database {
    protected $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function listPokemon() {
        $stmt = $this->db->query("
            SELECT p.*, t.name as trainer_name, t.level as trainer_level, g.name as gym_name, g.id as gym_id
            FROM pokemons p
            LEFT JOIN trainers t ON p.trainer_id = t.id
            LEFT JOIN gyms g ON t.gym_id = g.id
            ORDER BY p.id ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listTrainer() {
        $stmt = $this->db->query("SELECT * FROM trainers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listGyms() {
        $stmt = $this->db->query("SELECT * FROM gyms");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showPokemons($id) {
        $stmt = $this->db->prepare("
            SELECT p.*, t.name as trainer_name, t.level as trainer_level, t.id as trainer_id, 
                   g.name as gym_name, g.id as gym_id
            FROM pokemons p
            LEFT JOIN trainers t ON p.trainer_id = t.id
            LEFT JOIN gyms g ON t.gym_id = g.id
            WHERE p.id = ?
        ");
        $stmt->execute([intval($id)]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createPokemon($name, $type, $strength, $staming, $speed, $accuracy, $trainer_id, $image_url = null) {
        $stmt = $this->db->prepare("INSERT INTO pokemons (name, type, strength, staming, speed, accuracy, trainer_id, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $type, $strength, $staming, $speed, $accuracy, $trainer_id, $image_url]);
    }

    public function deletePokemon($id) {
        $stmt = $this->db->prepare("DELETE FROM pokemons WHERE id = ?");
        return $stmt->execute([intval($id)]);
    }

    public function updatePokemon($id, $name, $type, $strength, $staming, $speed, $accuracy, $trainer_id, $image_url = null) {
        $stmt = $this->db->prepare("
            UPDATE pokemons SET name=?, type=?, strength=?, staming=?, speed=?, accuracy=?, trainer_id=?, image_url=? 
            WHERE id=?
        ");
        return $stmt->execute([$name, $type, $strength, $staming, $speed, $accuracy, $trainer_id, $image_url, $id]);
    }

    public function getPokemonImageUrl($pokemonName) {
        // Usar PokeAPI para obtener la imagen del pokemon
        $pokemonNameLower = strtolower($pokemonName);
        return "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/" . $this->getPokemonIdFromName($pokemonNameLower) . ".png";
    }

    public function searchPokemonInAPI($pokemonName) {
        // Buscar pokemon en PokeAPI y obtener su imagen
        $pokemonNameLower = strtolower(trim($pokemonName));
        $apiUrl = "https://pokeapi.co/api/v2/pokemon/" . urlencode($pokemonNameLower);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode === 200 && $response) {
            $data = json_decode($response, true);
            if (isset($data['sprites']['other']['official-artwork']['front_default'])) {
                return $data['sprites']['other']['official-artwork']['front_default'];
            } elseif (isset($data['sprites']['front_default'])) {
                return $data['sprites']['front_default'];
            }
        }
        
        // Si no se encuentra, usar el método anterior
        return $this->getPokemonImageUrl($pokemonName);
    }

    private function getPokemonIdFromName($name) {
        // Mapeo de nombres comunes de pokemon a sus IDs en PokeAPI
        $pokemonMap = [
            'pikachu' => 25,
            'charmander' => 4,
            'bulbasaour' => 1,
            'bulbasaur' => 1,
            'squirtle' => 7,
            'snorlax' => 143,
            'vaporeon' => 134,
            'lapras' => 131,
            'blastoise' => 9,
            'golem' => 76,
            'dragonite' => 149,
            'exeggutor' => 103,
            'omaster' => 139,
            'omastar' => 139,
            'muk' => 89,
            'onix' => 95,
            'poliwag' => 60,
            'mankey' => 56,
            'magnemite' => 81,
            'pidgey' => 16,
            'gastly' => 92,
            'rattata' => 19
        ];
        
        return $pokemonMap[$name] ?? 25; // Default a Pikachu si no se encuentra
    }
}