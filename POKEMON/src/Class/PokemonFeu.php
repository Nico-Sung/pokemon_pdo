<?php

require_once 'Pokemon.php';

class PokemonFeu extends Pokemon {
    public function capaciteSpeciale(Pokemon $adversaire): int {
        $degats = $this->puissanceAttaque * 1.5;
        if ($adversaire instanceof PokemonPlante) {
            $degats *= 2; // bonus contre Plante
        }
        $adversaire->recevoirDegats((int) round($degats));
        return (int) round($degats);
    }
}