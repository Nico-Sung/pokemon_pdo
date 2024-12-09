<?php

require_once 'Pokemon.php';

class PokemonPlante extends Pokemon {
    public function capaciteSpeciale(Pokemon $adversaire): int {
        $degats = $this->puissanceAttaque * 1.5;
        if ($adversaire instanceof PokemonEau) {
            $degats *= 2; // bonus contre Eau
        }
        $adversaire->recevoirDegats((int) round($degats));
        return (int) round($degats);
    }
}