<?php

require_once 'Pokemon.php';

// classe attaque
class Attaque {
    private string $nom;
    private int $puissance;
    private int $precision; // en pourcentage

    // constructeur de la classe attaque
    public function __construct(string $nom, int $puissance, int $precision) {
        $this->nom = $nom;
        $this->puissance = $puissance;
        $this->precision = $precision;
    }

    // méthode pour exécuter l'attaque
    public function executerAttaque(Pokemon $attaquant, Pokemon $adversaire): void {
        if (rand(1, 100) <= $this->precision) {
            $degats = $attaquant->attaquer($adversaire);
            $attaquant->ajouterLog("{$attaquant->getNom()} utilise {$this->nom} et inflige {$degats} dégâts à {$adversaire->getNom()}. points de vie restants de {$adversaire->getNom()}: {$adversaire->getPointsDeVie()}");
        } else {
            $attaquant->ajouterLog("{$attaquant->getNom()} utilise {$this->nom} mais rate son attaque !");
        }
    }
}