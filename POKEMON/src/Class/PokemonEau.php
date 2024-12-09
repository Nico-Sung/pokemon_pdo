<?php

require_once 'Pokemon.php';

class PokemonEau extends Pokemon {
    public function capaciteSpeciale(Pokemon $adversaire): int {
        $degats = $this->puissanceAttaque * 1.5;
        if ($adversaire instanceof PokemonFeu) {
            $degats *= 2; // bonus contre feu
        }
        $adversaire->recevoirDegats((int) round($degats));
        return (int) round($degats);
    }
}