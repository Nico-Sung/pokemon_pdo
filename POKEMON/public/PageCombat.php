<?php
require_once '../src/Class/Pokemon.php';
require_once '../src/Class/PokemonFeu.php';
require_once '../src/Class/PokemonEau.php';
require_once '../src/Class/PokemonPlante.php';
require_once '../src/Class/Attaque.php';
require_once '../src/Class/Combat.php';

// liste des pokémon disponibles
$pokemonList = [
    new PokemonFeu('Salamèche', 'Feu', 100, 30, 10),
    new PokemonEau('Carapuce', 'Eau', 100, 28, 12),
    new PokemonPlante('Bulbizarre', 'Plante', 100, 25, 15),
];

// récupération des choix du formulaire
if (isset($_POST['pokemon1'], $_POST['pokemon2'])) {
    $pokemon1Index = (int) $_POST['pokemon1'];
    $pokemon2Index = (int) $_POST['pokemon2'];

    $pokemon1 = $pokemonList[$pokemon1Index];
    $pokemon2 = $pokemonList[$pokemon2Index];

    // initialisation et démarrage du combat
    $combat = new Combat($pokemon1, $pokemon2);
    $resultat = $combat->demarrerCombat();
    $log = $combat->getLog();
} else {
    die('erreur : sélection de pokémon invalide.');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .background {
            background-image: url('https://i.giphy.com/media/v1.Y2lkPTc5MGI3NjExa3dzaGpwc3RqZWtvOHZ6cnJjZ3BsZGtqYXlwOHZlYndkcDBlZm96OSZlcD12MV9pbnRlcm5naWZfYnlfaWQmY3Q9Zw/j5mdEyURiNkA0/giphy.gif');
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
    <title>résultat du combat</title>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="background"></div>
    <div class="container mx-auto p-6">
        <div class="overlay">
            <h1 class="text-4xl font-bold text-center mb-6">résultat du combat</h1>
            <div class="bg-white shadow-md rounded p-4">
                <h2 class="text-2xl font-semibold mb-4">combat entre <?= $pokemon1->getNom() ?> et <?= $pokemon2->getNom() ?></h2>
                <p class="text-lg"><?= $resultat ?></p>
                <div class="mt-4">
                    <h3 class="text-xl font-semibold mb-2">détails du combat :</h3>
                    <ul class="list-disc list-inside">
                        <?php foreach ($log as $entry): ?>
                            <li><?= $entry ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <a href="index.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">rejouer</a>
            </div>
        </div>
    </div>
</body>
</html>