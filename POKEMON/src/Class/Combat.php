<?php

require_once 'Pokemon.php';
require_once 'Attaque.php';

class Combat {
    private Pokemon $pokemon1;
    private Pokemon $pokemon2;
    private array $log = [];
    private int $tour = 0;

    public function __construct(Pokemon $pokemon1, Pokemon $pokemon2) {
        $this->pokemon1 = $pokemon1;
        $this->pokemon2 = $pokemon2;
    }

    public function demarrerCombat(): string {
        while (!$this->pokemon1->estKO() && !$this->pokemon2->estKO()) {
            $this->tour++;
            $this->tourDeCombat($this->pokemon1, $this->pokemon2);
            if ($this->pokemon2->estKO()) break;

            $this->tourDeCombat($this->pokemon2, $this->pokemon1);
        }

        return $this->determinerVainqueur();
    }

    private function tourDeCombat(Pokemon $attaquant, Pokemon $defenseur): void {
        // utiliser une attaque spéciale tous les 3 tours
        if ($this->tour % 3 == 0) {
            $degatsSpeciale = $attaquant->utiliserAttaqueSpeciale($defenseur);
            $this->log[] = "{$attaquant->getNom()} utilise une attaque spéciale et inflige {$degatsSpeciale} dégâts à {$defenseur->getNom()}. points de vie restants de {$defenseur->getNom()}: {$defenseur->getPointsDeVie()}";
        } else {
            $attaque = new Attaque("Attaque", $attaquant->getPuissanceAttaque(), 90); // exemple avec une précision de 90%
            $attaque->executerAttaque($attaquant, $defenseur);
        }

        $this->log = array_merge($this->log, $attaquant->getLog());
        $this->log = array_merge($this->log, $defenseur->getLog());
    }

    private function determinerVainqueur(): string {
        if ($this->pokemon1->estKO()) {
            $this->log[] = "{$this->pokemon2->getNom()} a gagné !";
            return $this->pokemon2->getNom() . " a gagné !";
        } else {
            $this->log[] = "{$this->pokemon1->getNom()} a gagné !";
            return $this->pokemon1->getNom() . " a gagné !";
        }
    }

    public function getLog(): array {
        return $this->log;
    }
}