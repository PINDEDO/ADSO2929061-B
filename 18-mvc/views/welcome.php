<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pokemones - MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-base-200 min-h-screen">
    <div class="container mx-auto py-8 px-4">
        <!-- Header -->
        <header class="text-center mb-8">
            <h1 class="text-5xl font-bold mb-2">Pokédex MVC</h1>
            <p class="text-base-content/70">Sistema de gestión de Pokemones</p>
        </header>

        <!-- Botón Agregar Pokemon (fuera de la lista) -->
        <div class="flex justify-center mb-8">
            <button onclick="document.getElementById('modal-create').showModal()" class="btn btn-primary btn-lg">
                <i class="fas fa-plus-circle mr-2"></i>
                Agregar Pokemon
            </button>
        </div>

        <!-- Lista de Pokemones -->
        <main class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($data['pokemons'] as $pokemon): 
                    // Usar image_url si existe, sino calcular desde el nombre
                    if (!empty($pokemon['image_url'])) {
                        $imageUrl = $pokemon['image_url'];
                    } else {
                        $pokemonMap = [
                            'pikachu' => 25, 'charmander' => 4, 'bulbasaour' => 1, 'bulbasaur' => 1,
                            'squirtle' => 7, 'snorlax' => 143, 'vaporeon' => 134, 'lapras' => 131,
                            'blastoise' => 9, 'golem' => 76, 'dragonite' => 149, 'exeggutor' => 103,
                            'omaster' => 139, 'omastar' => 139, 'muk' => 89, 'onix' => 95,
                            'poliwag' => 60, 'mankey' => 56, 'magnemite' => 81, 'pidgey' => 16,
                            'gastly' => 92, 'rattata' => 19
                        ];
                        $pokemonId = $pokemonMap[strtolower($pokemon['name'])] ?? 25;
                        $imageUrl = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$pokemonId}.png";
                    }
                    $typeClass = match($pokemon['type']) {
                        'Water' => 'badge-info',
                        'Fire' => 'badge-error',
                        'Grass' => 'badge-success',
                        'Electric' => 'badge-warning',
                        'Normal' => 'badge-neutral',
                        'Poison' => 'badge-primary',
                        'Ghost' => 'badge-primary',
                        'Dragon' => 'badge-secondary',
                        'Rock' => 'badge-neutral',
                        default => 'badge-neutral'
                    };
                ?>
                <article class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                    <figure class="px-6 pt-6">
                        <img src="<?= htmlspecialchars($imageUrl) ?>" 
                             alt="<?= htmlspecialchars($pokemon['name']) ?>" 
                             class="w-32 h-32 object-contain mx-auto"
                             onerror="this.src='https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png'">
                    </figure>
                    <div class="card-body items-center text-center">
                        <h2 class="card-title text-xl"><?= htmlspecialchars(ucfirst($pokemon['name'])) ?></h2>
                        <p class="text-sm text-base-content/70">ID: #<?= str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT) ?></p>
                        <div class="badge badge-outline <?= $typeClass ?> badge-lg">
                            <?= htmlspecialchars($pokemon['type']) ?>
                        </div>
                        <div class="card-actions justify-center gap-2 mt-4">
                            <!-- Botón Inspeccionar -->
                            <button onclick="openViewModal(<?= htmlspecialchars(json_encode($pokemon)) ?>)" 
                                    class="btn btn-sm btn-info">
                                <i class="fas fa-search"></i>
                            </button>
                            <!-- Botón Editar -->
                            <button onclick="openEditModal(<?= htmlspecialchars(json_encode($pokemon)) ?>)" 
                                    class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </button>
                            <!-- Botón Eliminar -->
                            <button onclick="deletePokemon(<?= $pokemon['id'] ?>, '<?= htmlspecialchars($pokemon['name']) ?>')" 
                                    class="btn btn-sm btn-error">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </article>
      <?php endforeach; ?>
</div>  
        </main>
    </div>

    <!-- Modal Inspeccionar -->
    <dialog id="modal-view" class="modal">
        <div class="modal-box max-w-3xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                    <i class="fas fa-times"></i>
                </button>
            </form>
            <h3 class="font-bold text-2xl mb-4">Detalles del Pokemon</h3>
            <div id="view-content" class="space-y-4">
                <!-- Contenido se llena dinámicamente -->
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <!-- Modal Editar -->
    <dialog id="modal-edit" class="modal">
        <div class="modal-box max-w-2xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                    <i class="fas fa-times"></i>
                </button>
            </form>
            <h3 class="font-bold text-2xl mb-4">Editar Pokemon</h3>
            <form id="edit-form" method="POST" action="index.php?method=update" onsubmit="handleFormSubmit(event, 'edit')">
                <input type="hidden" name="id" id="edit-id">
                <div class="space-y-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Nombre</span>
                            </label>
                            <input type="text" name="name" id="edit-name" class="input input-bordered" required>
                        </div>
                        <div class="divider">Imagen del Pokemon</div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Fuente de Imagen</span>
                            </label>
                            <select name="image_source" id="edit-image-source" class="select select-bordered" onchange="toggleImageInput('edit')">
                                <option value="keep">Mantener imagen actual</option>
                                <option value="auto">Automático (basado en nombre)</option>
                                <option value="url">URL personalizada</option>
                            </select>
                        </div>
                        <div class="form-control" id="edit-image-url-container" style="display: none;">
                            <label class="label">
                                <span class="label-text font-semibold">URL de la Imagen</span>
                            </label>
                            <input type="url" name="image_url" id="edit-image-url" class="input input-bordered" placeholder="https://ejemplo.com/imagen.png">
                            <label class="label">
                                <span class="label-text-alt">Ingresa la URL completa de la imagen</span>
                            </label>
                        </div>
                        <div class="form-control">
                            <div class="card bg-base-200 p-4">
                                <div class="text-center">
                                    <p class="text-sm font-semibold mb-2">Vista Previa:</p>
                                    <img id="edit-image-preview" src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png" 
                                         alt="Preview" class="w-32 h-32 object-contain mx-auto border rounded-lg bg-base-100">
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Tipo</span>
                            </label>
                            <select name="type" id="edit-type" class="select select-bordered" required>
                                <option value="Water">Water</option>
                                <option value="Fire">Fire</option>
                                <option value="Grass">Grass</option>
                                <option value="Electric">Electric</option>
                                <option value="Normal">Normal</option>
                                <option value="Poison">Poison</option>
                                <option value="Ghost">Ghost</option>
                                <option value="Dragon">Dragon</option>
                                <option value="Rock">Rock</option>
                            </select>
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Entrenador</span>
                            </label>
                            <select name="trainer_id" id="edit-trainer" class="select select-bordered" required>
                                <?php 
                                foreach ($data['trainers'] as $trainer): 
                                ?>
                                    <option value="<?= $trainer['id'] ?>"><?= htmlspecialchars($trainer['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="divider">Estadísticas</div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Fuerza</span>
                                <span class="label-text-alt" id="edit-strength-value">50</span>
                            </label>
                            <input type="range" name="strength" id="edit-strength" min="0" max="2000" value="50" class="range range-primary">
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Resistencia</span>
                                <span class="label-text-alt" id="edit-stamina-value">50</span>
                            </label>
                            <input type="range" name="staming" id="edit-stamina" min="0" max="2000" value="50" class="range range-secondary">
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Velocidad</span>
                                <span class="label-text-alt" id="edit-speed-value">50</span>
                            </label>
                            <input type="range" name="speed" id="edit-speed" min="0" max="2000" value="50" class="range range-accent">
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Precisión</span>
                                <span class="label-text-alt" id="edit-accuracy-value">50</span>
                            </label>
                            <input type="range" name="accuracy" id="edit-accuracy" min="0" max="2000" value="50" class="range range-warning">
                        </div>
                    </div>
                    <div class="modal-action">
                        <button type="button" onclick="document.getElementById('modal-edit').close()" class="btn btn-ghost">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Guardar Cambios
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <!-- Modal Crear -->
    <dialog id="modal-create" class="modal">
        <div class="modal-box max-w-2xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                    <i class="fas fa-times"></i>
                </button>
            </form>
            <h3 class="font-bold text-2xl mb-4">Agregar Nuevo Pokemon</h3>
            <form id="create-form" method="POST" action="index.php?method=store" onsubmit="handleFormSubmit(event, 'create')">
                <div class="space-y-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Nombre</span>
                        </label>
                        <input type="text" name="name" id="create-name" class="input input-bordered" required>
                    </div>
                    <div class="divider">Imagen del Pokemon</div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Fuente de Imagen</span>
                        </label>
                        <select name="image_source" id="create-image-source" class="select select-bordered" onchange="toggleImageInput('create')">
                            <option value="auto">Automático (basado en nombre)</option>
                            <option value="url">URL personalizada</option>
                        </select>
                    </div>
                    <div class="form-control" id="create-image-url-container" style="display: none;">
                        <label class="label">
                            <span class="label-text font-semibold">URL de la Imagen</span>
                        </label>
                        <input type="url" name="image_url" id="create-image-url" class="input input-bordered" placeholder="https://ejemplo.com/imagen.png">
                        <label class="label">
                            <span class="label-text-alt">Ingresa la URL completa de la imagen</span>
                        </label>
                    </div>
                    <div class="form-control">
                        <div class="card bg-base-200 p-4">
                            <div class="text-center">
                                <p class="text-sm font-semibold mb-2">Vista Previa:</p>
                                <img id="create-image-preview" src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png" 
                                     alt="Preview" class="w-32 h-32 object-contain mx-auto border rounded-lg bg-base-100">
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Tipo</span>
                            </label>
                            <select name="type" class="select select-bordered" required>
                                <option value="">Seleccionar tipo</option>
                                <option value="Water">Water</option>
                                <option value="Fire">Fire</option>
                                <option value="Grass">Grass</option>
                                <option value="Electric">Electric</option>
                                <option value="Normal">Normal</option>
                                <option value="Poison">Poison</option>
                                <option value="Ghost">Ghost</option>
                                <option value="Dragon">Dragon</option>
                                <option value="Rock">Rock</option>
                            </select>
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Entrenador</span>
                            </label>
                            <select name="trainer_id" class="select select-bordered" required>
                                <option value="">Seleccionar entrenador</option>
                                <?php 
                                foreach ($data['trainers'] as $trainer): 
                                ?>
                                    <option value="<?= $trainer['id'] ?>"><?= htmlspecialchars($trainer['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="divider">Estadísticas</div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Fuerza</span>
                                <span class="label-text-alt" id="create-strength-value">50</span>
                            </label>
                            <input type="range" name="strength" id="create-strength" min="0" max="2000" value="50" class="range range-primary">
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Resistencia</span>
                                <span class="label-text-alt" id="create-stamina-value">50</span>
                            </label>
                            <input type="range" name="staming" id="create-stamina" min="0" max="2000" value="50" class="range range-secondary">
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Velocidad</span>
                                <span class="label-text-alt" id="create-speed-value">50</span>
                            </label>
                            <input type="range" name="speed" id="create-speed" min="0" max="2000" value="50" class="range range-accent">
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Precisión</span>
                                <span class="label-text-alt" id="create-accuracy-value">50</span>
                            </label>
                            <input type="range" name="accuracy" id="create-accuracy" min="0" max="2000" value="50" class="range range-warning">
                        </div>
                    </div>
                    <div class="modal-action">
                        <button type="button" onclick="document.getElementById('modal-create').close()" class="btn btn-ghost">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus-circle mr-2"></i>Crear Pokemon
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <script>
        // Función para obtener datos completos del pokemon
        async function getPokemonData(id) {
            try {
                const response = await fetch(`index.php?method=api/pokemon/${id}`);
                if (response.ok) {
                    const data = await response.json();
                    return data;
                }
            } catch (error) {
                console.error('Error:', error);
            }
            return null;
        }

        // Función para mostrar/ocultar campo de URL de imagen
        function toggleImageInput(mode) {
            const sourceSelect = document.getElementById(`${mode}-image-source`);
            const urlContainer = document.getElementById(`${mode}-image-url-container`);
            const urlInput = document.getElementById(`${mode}-image-url`);
            
            if (sourceSelect.value === 'url') {
                urlContainer.style.display = 'block';
                urlInput.required = true;
            } else {
                urlContainer.style.display = 'none';
                urlInput.required = false;
                urlInput.value = '';
            }
            updateImagePreview(mode);
        }


        // Función para actualizar vista previa de imagen
        function updateImagePreview(mode) {
            const sourceSelect = document.getElementById(`${mode}-image-source`);
            const nameInput = document.getElementById(`${mode}-name`);
            const urlInput = document.getElementById(`${mode}-image-url`);
            const preview = document.getElementById(`${mode}-image-preview`);
            
            let imageUrl = '';
            
            if (sourceSelect.value === 'url' && urlInput.value) {
                imageUrl = urlInput.value;
            } else if (sourceSelect.value === 'auto' && nameInput.value) {
                imageUrl = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${getPokemonId(nameInput.value)}.png`;
            } else if (mode === 'edit' && sourceSelect.value === 'keep') {
                // Mantener la imagen actual (se actualizará cuando se abra el modal)
                return;
            } else {
                imageUrl = 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png';
            }
            
            preview.src = imageUrl;
            preview.onerror = function() {
                this.src = 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png';
            };
        }

        // Event listeners para actualizar vista previa
        document.addEventListener('DOMContentLoaded', function() {
            // Crear modal
            const createName = document.getElementById('create-name');
            const createUrl = document.getElementById('create-image-url');
            const createSource = document.getElementById('create-image-source');
            
            if (createName) {
                createName.addEventListener('input', () => updateImagePreview('create'));
            }
            if (createUrl) {
                createUrl.addEventListener('input', () => updateImagePreview('create'));
            }
            if (createSource) {
                createSource.addEventListener('change', () => toggleImageInput('create'));
            }

            // Editar modal
            const editName = document.getElementById('edit-name');
            const editUrl = document.getElementById('edit-image-url');
            const editSource = document.getElementById('edit-image-source');
            
            if (editName) {
                editName.addEventListener('input', () => updateImagePreview('edit'));
            }
            if (editUrl) {
                editUrl.addEventListener('input', () => updateImagePreview('edit'));
            }
            if (editSource) {
                editSource.addEventListener('change', () => toggleImageInput('edit'));
            }
        });

        // Abrir modal de inspección
        async function openViewModal(pokemon) {
            const modal = document.getElementById('modal-view');
            const content = document.getElementById('view-content');
            
            // Obtener datos completos
            const fullData = await getPokemonData(pokemon.id);
            const data = fullData || pokemon;
            
            const typeClass = data.type === 'Water' ? 'badge-info' :
                            data.type === 'Fire' ? 'badge-error' :
                            data.type === 'Grass' ? 'badge-success' :
                            data.type === 'Electric' ? 'badge-warning' :
                            data.type === 'Dragon' ? 'badge-secondary' : 'badge-neutral';
            
            content.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="card bg-base-200">
                        <figure class="px-6 pt-6">
                        <img src="${data.image_url || `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${getPokemonId(data.name)}.png`}" 
                             alt="${data.name}" 
                             class="w-48 h-48 object-contain mx-auto"
                             onerror="this.src='https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png'">
                    </figure>
                        <div class="card-body items-center text-center">
                            <h2 class="card-title text-2xl">${data.name}</h2>
                            <p class="text-sm">ID: #${String(data.id).padStart(3, '0')}</p>
                            <div class="badge badge-outline ${typeClass} badge-lg">${data.type}</div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="card bg-base-200">
                            <div class="card-body">
                                <h3 class="card-title text-lg mb-2">Información</h3>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="font-semibold">ID:</span>
                                        <span>#${String(data.id).padStart(3, '0')}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-semibold">Nombre:</span>
                                        <span>${data.name}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-semibold">Tipo:</span>
                                        <span class="badge ${typeClass}">${data.type}</span>
                                    </div>
                                    ${data.trainer_name ? `
                                    <div class="flex justify-between">
                                        <span class="font-semibold">Entrenador:</span>
                                        <span>${data.trainer_name}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-semibold">Nivel Entrenador:</span>
                                        <span>${data.trainer_level || 'N/A'}</span>
                                    </div>
                                    ` : ''}
                                    ${data.gym_name ? `
                                    <div class="flex justify-between">
                                        <span class="font-semibold">Gimnasio:</span>
                                        <span>${data.gym_name}</span>
                                    </div>
                                    ` : ''}
                                </div>
                            </div>
                        </div>
                        <div class="card bg-base-200">
                            <div class="card-body">
                                <h3 class="card-title text-lg mb-2">Estadísticas</h3>
                                <div class="space-y-3">
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="font-semibold">Fuerza</span>
                                            <span class="text-primary font-bold">${data.strength || 0}</span>
                                        </div>
                                        <progress class="progress progress-primary w-full" value="${data.strength || 0}" max="2000"></progress>
                                    </div>
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="font-semibold">Resistencia</span>
                                            <span class="text-secondary font-bold">${data.staming || 0}</span>
                                        </div>
                                        <progress class="progress progress-secondary w-full" value="${data.staming || 0}" max="2000"></progress>
                                    </div>
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="font-semibold">Velocidad</span>
                                            <span class="text-accent font-bold">${data.speed || 0}</span>
                                        </div>
                                        <progress class="progress progress-accent w-full" value="${data.speed || 0}" max="2000"></progress>
                                    </div>
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="font-semibold">Precisión</span>
                                            <span class="text-warning font-bold">${data.accuracy || 0}</span>
                                        </div>
                                        <progress class="progress progress-warning w-full" value="${data.accuracy || 0}" max="2000"></progress>
                                    </div>
                                    <div class="divider"></div>
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="font-bold text-lg">Poder Total</span>
                                            <span class="text-error font-bold text-lg">${(parseInt(data.strength || 0) + parseInt(data.staming || 0) + parseInt(data.speed || 0) + parseInt(data.accuracy || 0))}/8000</span>
                                        </div>
                                        <progress class="progress progress-error w-full h-4" 
                                                  value="${parseInt(data.strength || 0) + parseInt(data.staming || 0) + parseInt(data.speed || 0) + parseInt(data.accuracy || 0)}" 
                                                  max="8000"></progress>
                                    </div>
                                </div>
                            </div>
    </div>
  </div>
</div>
            `;
            modal.showModal();
        }

        // Abrir modal de edición
        function openEditModal(pokemon) {
            document.getElementById('edit-id').value = pokemon.id;
            document.getElementById('edit-name').value = pokemon.name;
            document.getElementById('edit-type').value = pokemon.type;
            document.getElementById('edit-trainer').value = pokemon.trainer_id || '';
            document.getElementById('edit-strength').value = pokemon.strength || 50;
            document.getElementById('edit-stamina').value = pokemon.staming || 50;
            document.getElementById('edit-speed').value = pokemon.speed || 50;
            document.getElementById('edit-accuracy').value = pokemon.accuracy || 50;
            
            // Configurar imagen
            const imageSource = document.getElementById('edit-image-source');
            const imageUrl = document.getElementById('edit-image-url');
            const imagePreview = document.getElementById('edit-image-preview');
            
            if (pokemon.image_url) {
                imageSource.value = 'keep';
                imagePreview.src = pokemon.image_url;
            } else {
                imageSource.value = 'auto';
                imagePreview.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${getPokemonId(pokemon.name)}.png`;
            }
            
            toggleImageInput('edit');
            updateEditValues();
            
            const form = document.getElementById('edit-form');
            form.action = `index.php?method=update&id=${pokemon.id}`;
            
            document.getElementById('modal-edit').showModal();
        }

        // Actualizar valores en tiempo real (editar)
        function updateEditValues() {
            document.getElementById('edit-strength-value').textContent = document.getElementById('edit-strength').value;
            document.getElementById('edit-stamina-value').textContent = document.getElementById('edit-stamina').value;
            document.getElementById('edit-speed-value').textContent = document.getElementById('edit-speed').value;
            document.getElementById('edit-accuracy-value').textContent = document.getElementById('edit-accuracy').value;
        }

        // Actualizar valores en tiempo real (crear)
        function updateCreateValues() {
            document.getElementById('create-strength-value').textContent = document.getElementById('create-strength').value;
            document.getElementById('create-stamina-value').textContent = document.getElementById('create-stamina').value;
            document.getElementById('create-speed-value').textContent = document.getElementById('create-speed').value;
            document.getElementById('create-accuracy-value').textContent = document.getElementById('create-accuracy').value;
        }

        // Event listeners para sliders
        document.getElementById('edit-strength').addEventListener('input', updateEditValues);
        document.getElementById('edit-stamina').addEventListener('input', updateEditValues);
        document.getElementById('edit-speed').addEventListener('input', updateEditValues);
        document.getElementById('edit-accuracy').addEventListener('input', updateEditValues);

        document.getElementById('create-strength').addEventListener('input', updateCreateValues);
        document.getElementById('create-stamina').addEventListener('input', updateCreateValues);
        document.getElementById('create-speed').addEventListener('input', updateCreateValues);
        document.getElementById('create-accuracy').addEventListener('input', updateCreateValues);

        // Función para eliminar pokemon con SweetAlert2
        function deletePokemon(id, name) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: `¿Quieres eliminar a ${name}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar la eliminación
                    fetch(`index.php?method=delete&id=${id}&confirm=1`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }).then(response => {
                        if (response.ok || response.redirected) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Eliminado!',
                                text: `${name} ha sido eliminado exitosamente`,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            throw new Error('Error en la respuesta');
                        }
                    }).catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un error al eliminar el pokemon'
                        });
                    });
                }
            });
        }

        // Función para manejar el submit de formularios con alert
        function handleFormSubmit(event, mode) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const action = form.action;
            const method = form.method;
            
            // Cerrar el modal primero
            const modal = document.getElementById(`modal-${mode}`);
            if (modal) {
                modal.close();
            }
            
            // Determinar el mensaje según el modo
            const messages = {
                'create': {
                    title: '¿Crear Pokemon?',
                    text: '¿Estás seguro de crear este pokemon?',
                    success: '¡Pokemon creado exitosamente!',
                    error: 'Hubo un error al crear el pokemon'
                },
                'edit': {
                    title: '¿Guardar cambios?',
                    text: '¿Estás seguro de guardar los cambios?',
                    success: '¡Pokemon actualizado exitosamente!',
                    error: 'Hubo un error al actualizar el pokemon'
                }
            };
            
            const msg = messages[mode];
            
            // Pequeño delay para que el modal se cierre completamente
            setTimeout(() => {
                Swal.fire({
                    title: msg.title,
                    text: msg.text,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Sí, continuar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Enviar el formulario
                        fetch(action, {
                            method: method,
                            body: formData
                        }).then(response => {
                            if (response.ok || response.redirected) {
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Éxito!',
                                    text: msg.success,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.href = 'index.php';
                                });
                            } else {
                                throw new Error('Error en la respuesta');
                            }
                        }).catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: msg.error
                            });
                        });
                    } else {
                        // Si cancela, volver a abrir el modal
                        if (modal) {
                            modal.showModal();
                        }
                    }
                });
            }, 300);
        }

        // Función auxiliar para obtener ID de pokemon
        function getPokemonId(name) {
            const map = {
                'pikachu': 25, 'charmander': 4, 'bulbasaour': 1, 'bulbasaur': 1,
                'squirtle': 7, 'snorlax': 143, 'vaporeon': 134, 'lapras': 131,
                'blastoise': 9, 'golem': 76, 'dragonite': 149, 'exeggutor': 103,
                'omaster': 139, 'omastar': 139, 'muk': 89, 'onix': 95,
                'poliwag': 60, 'mankey': 56, 'magnemite': 81, 'pidgey': 16,
                'gastly': 92, 'rattata': 19
            };
            return map[name.toLowerCase()] || 25;
        }
    </script>
</body>
</html>
