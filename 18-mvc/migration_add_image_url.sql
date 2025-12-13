-- Agregar columna image_url a la tabla pokemons
ALTER TABLE `pokemons` 
ADD COLUMN `image_url` VARCHAR(500) NULL DEFAULT NULL AFTER `trainer_id`;


