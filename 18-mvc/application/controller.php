<?php 

    class Controller {
        public $load;
        public $model;

        public function __construct() {
            $this->load  = new Load;
            $this->model = new Model;

            $this->handleRequest();

        }

        private function handleRequest() {
            // Manejar peticiones AJAX primero
            if (isset($_GET['method']) && strpos($_GET['method'], 'api/pokemon/') === 0) {
                $id = str_replace('api/pokemon/', '', $_GET['method']);
                $this->getPokemonData($id);
                return;
            }
            
            
            // Rutas amigables
            $requestUri = $_SERVER['REQUEST_URI'];
            $scriptName = $_SERVER['SCRIPT_NAME'];
            $path = parse_url($requestUri, PHP_URL_PATH);
            $path = str_replace(dirname($scriptName), '', $path);
            $path = trim($path, '/');
            
            $segments = explode('/', $path);
            
            // Si hay parámetros GET tradicionales, usarlos
            $method = $_GET['method'] ?? null;
            $id = $_GET['id'] ?? null;
            
            // Si no hay método en GET, intentar parsear de la URL
            if (!$method && !empty($segments[0])) {
                $method = $segments[0];
                if (!empty($segments[1])) {
                    $id = $segments[1];
                }
            }
            
            // Si aún no hay método, usar index
            $method = $method ?? 'index';
            
            // Manejar peticiones AJAX desde URL amigable
            if ($method === 'api' && isset($segments[1]) && $segments[1] === 'pokemon' && isset($segments[2])) {
                $this->getPokemonData($segments[2]);
                return;
            }

            switch($method) {
            case 'create':
                $this->create();
                break;
            case 'store':
                $this->store();
                break;
            case 'show':
                $this->show($id);
                break;
            case 'edit':
                $this->edit($id);
                break;
            case 'update':
                $this->update($id);
                break;
            case 'delete':
                $this->delete($id);
                break;
            default:
                $this->index();
            }
        }
        
        public function index() {
            $pokemons = $this->model->listPokemon();
            $trainers = $this->model->listTrainer();
            $data = ['pokemons' => $pokemons, 'trainers' => $trainers, 'model' => $this->model];
            $this->load->view('welcome.php', $data);
        }

        public function store() {
            $name = trim($_POST['name'] ?? '');
            $type = trim($_POST['type'] ?? '');
            $strength = trim($_POST['strength'] ?? '');
            $staming = trim($_POST['staming'] ?? '');
            $speed = trim($_POST['speed'] ?? '');
            $accuracy = trim($_POST['accuracy'] ?? '');
            $trainer_id = trim($_POST['trainer_id'] ?? '');
            $image_source = $_POST['image_source'] ?? 'auto';
            $image_url = null;

            // Determinar la URL de la imagen
            if ($image_source === 'url' && !empty($_POST['image_url'])) {
                $image_url = trim($_POST['image_url']);
            } elseif ($image_source === 'auto' && !empty($name)) {
                // Usar método automático basado en nombre
                $image_url = $this->model->getPokemonImageUrl($name);
            }

            if (!empty($name) && !empty($type) && !empty($trainer_id)) {
                $this->model->createPokemon($name, $type, $strength, $staming, $speed, $accuracy, $trainer_id, $image_url);
            }
            header('location: index.php');
            exit();
        }

        public function create() {
            $trainers = $this->model->listTrainer();
            $gyms = $this->model->listGyms();
            $data = ['trainers' => $trainers, 'gyms' => $gyms];
            $this->load->view("create.php", $data);
        }

        public function show($id) {
            $pokemon = $this->model->showPokemons($id);
            $this->load->view("show.php", $pokemon);
        }

        public function edit($id) {
            $pokemon = $this->model->showPokemons($id);
            $trainers = $this->model->listTrainer();
            $gyms = $this->model->listGyms();
            $pokemon['trainers'] = $trainers;
            $pokemon['gyms'] = $gyms;
            $this->load->view("edit.php", $pokemon);
        }

        public function update($id) {
            $image_source = $_POST['image_source'] ?? 'keep';
            $image_url = null;

            // Determinar la URL de la imagen
            if ($image_source === 'url' && !empty($_POST['image_url'])) {
                $image_url = trim($_POST['image_url']);
            } elseif ($image_source === 'auto' && !empty($_POST['name'])) {
                $image_url = $this->model->getPokemonImageUrl($_POST['name']);
            } elseif ($image_source === 'keep') {
                // Mantener la imagen actual - obtenerla de la BD
                $current = $this->model->showPokemons($id);
                $image_url = $current['image_url'] ?? null;
            }

            $this->model->updatePokemon(
                $id,
                $_POST['name'],
                $_POST['type'],
                $_POST['strength'],
                $_POST['staming'],
                $_POST['speed'],
                $_POST['accuracy'],
                $_POST['trainer_id'],
                $image_url
            );
            header('location: index.php');
            exit();
        }

        public function delete($id) {
            if (isset($_GET['confirm'])) {
                $this->model->deletePokemon($id);
                $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
                if ($isAjax) {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true]);
                    exit();
                }
            }
            header('location: index.php');
            exit();
        }

    public function getPokemonData($id) {
        $pokemon = $this->model->showPokemons($id);
        if ($pokemon) {
            // Si no tiene image_url, calcularla
            if (empty($pokemon['image_url'])) {
                $pokemon['image_url'] = $this->model->getPokemonImageUrl($pokemon['name']);
            }
            header('Content-Type: application/json');
            echo json_encode($pokemon);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Pokemon not found']);
        }
        exit();
    }

        
    }