<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

    <?php
        require_once 'header.php';
    ?>

<div class="div_form">
<form method="POST" action="api.php">
    <label for="pokemon">Nombre de pokemon:</label>
    <input name="pokemon" type="text" id="pokemon">
    <button type="submit">Buscar</button>
</form>
</div>

<div class="pokemon-card">
<?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pokemon']) && !empty($_POST['pokemon'])) {
            $nombrePokemon = strtolower($_POST['pokemon']);

            $url = "https://pokeapi.co/api/v2/pokemon/$nombrePokemon";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            $datos_pokemon = json_decode($result, true);
            curl_close($ch);

            if (isset($datos_pokemon["name"])) {
                $name = $datos_pokemon["name"];
                $numPokedex = $datos_pokemon["id"];
                $sprite = $datos_pokemon["sprites"]["front_default"];
                $type = $datos_pokemon["types"][0]["type"]["name"];
                $hp = $datos_pokemon["stats"][0]["base_stat"];
                $attack = $datos_pokemon["stats"][1]["base_stat"];
                $defense = $datos_pokemon["stats"][2]["base_stat"];
                $specialAttack = $datos_pokemon["stats"][3]["base_stat"];
                $specialDefense = $datos_pokemon["stats"][4]["base_stat"];

                $color = match ($type) {
                    "water" => "#6890f0",
                    "fire" => "#f08030",
                    "grass" => "#78c850",
                    "electric" => "#f8d030",
                    "psychic" => "#f85888",
                    "ice" => "#98d8d8",
                    "dragon" => "#7038f8",
                    "dark" => "#705848",
                    "fairy" => "#ee99ac",
                    "normal" => "#a8a878",
                    "fighting" => "#c03028",
                    "flying" => "#a890f0",
                    "poison" => "#a040a0",
                    "ground" => "#e0c068",
                    "rock" => "#b8a038",
                    "bug" => "#a8b820",
                    "ghost" => "#705898",
                    "steel" => "#b8b8d0",
                    default => "#68a090",
                };

                echo "<div class='pokemon-image' style='background-color: $color;'>";
                echo "<img src='$sprite' alt='$name'>";
                echo "</div>";
                echo "<h1>" . "#".$numPokedex . " " . ucfirst($name) . "</h1>";
                echo "<p class='type'><strong>Type:</strong> " . ucfirst($type) . "</p>";
                echo "<p><strong>HP:</strong> $hp</p>";
                echo "<p><strong>Attack:</strong> $attack</p>";
                echo "<p><strong>Defense:</strong> $defense</p>";
                echo "<p><strong>Special attack:</strong> $specialAttack</p>";
                echo "<p><strong>Special defense:</strong> $specialDefense</p>";
            } else {
                echo "<p>El Pokémon no se encontró. Por favor, verifica el nombre.</p>";
            }
        }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
