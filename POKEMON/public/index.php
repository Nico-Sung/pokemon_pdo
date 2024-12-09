<?php
require_once '../src/Class/Pokemon.php';
require_once '../src/Class/PokemonFeu.php';
require_once '../src/Class/PokemonEau.php';
require_once '../src/Class/PokemonPlante.php';

// liste des Pokémon disponibles
$pokemonList = [
    new PokemonFeu('Salamèche', 'Feu', 100, 30, 10),
    new PokemonEau('Carapuce', 'Eau', 100, 28, 12),
    new PokemonPlante('Bulbizarre', 'Plante', 100, 25, 15),
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .background {
            background-image: url('./img/edward-art-heartmoon-illu-sd.gif');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .overlay {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
    <title>Choisissez vos Pokémon</title>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="background"></div>
    <div class="container mx-auto p-6">
        <div class="overlay">
            <h1 class="text-4xl font-bold text-center mb-6">Mini-Jeu Pokémon</h1>
            <form action="PageCombat.php" method="POST" class="space-y-4">
                <div>
                    <h2 class="text-2xl font-semibold mb-2">Sélectionnez le premier Pokémon :</h2>
                    <?php foreach ($pokemonList as $index => $pokemon): ?>
                        <div class="mb-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="pokemon1" value="<?= $index ?>" required>
                                <span class="ml-2"><?= $pokemon->getNom() ?> (<?= $pokemon->getType() ?>)</span>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div>
                    <h2 class="text-2xl font-semibold mb-2">Sélectionnez le second Pokémon :</h2>
                    <?php foreach ($pokemonList as $index => $pokemon): ?>
                        <div class="mb-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="pokemon2" value="<?= $index ?>" required>
                                <span class="ml-2"><?= $pokemon->getNom() ?> (<?= $pokemon->getType() ?>)</span>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Lancer le Combat</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>