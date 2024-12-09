<?php

abstract class Pokemon {
    protected string $nom;
    protected string $type;
    protected int $pointsDeVie;
    protected int $pointsDeVieMax;
    protected int $puissanceAttaque;
    protected int $defense;
    protected array $log = [];

    // constructeur de la classe pokemon
    public function __construct(string $nom, string $type, int $pointsDeVie, int $puissanceAttaque, int $defense) {
        $this->nom = $nom;
        $this->type = $type;
        $this->pointsDeVie = $pointsDeVie;
        $this->pointsDeVieMax = $pointsDeVie;
        $this->puissanceAttaque = $puissanceAttaque;
        $this->defense = $defense;
    }

    // retourne le nom du pokemon
    public function getNom(): string {
        return $this->nom;
    }

    // retourne le type du pokemon
    public function getType(): string {
        return $this->type;
    }

    // retourne les points de vie du pokemon
    public function getPointsDeVie(): int {
        return $this->pointsDeVie;
    }

    // retourne la puissance d'attaque du pokemon
    public function getPuissanceAttaque(): int {
        return $this->puissanceAttaque;
    }

    // méthode pour attaquer un autre pokemon
    public function attaquer(Pokemon $adversaire): int {
        $variation = rand(90, 110) / 100; // variation de ±10%
        $degats = ($this->puissanceAttaque - $adversaire->defense) * $variation;
        if ($degats > 0) {
            $adversaire->recevoirDegats((int) round($degats));
        } else {
            $degats = 0;
        }
        return (int) round($degats);
    }

    // méthode pour recevoir des dégâts
    public function recevoirDegats(int $degats): void {
        $this->pointsDeVie -= $degats;
        $this->pointsDeVie = max(0, $this->pointsDeVie);
    }

    // vérifie si le pokemon est KO
    public function estKO(): bool {
        return $this->pointsDeVie <= 0;
    }

    // méthode pour se battre contre un autre pokemon
    public function seBattre(Pokemon $adversaire): string {
        while (!$this->estKO() && !$adversaire->estKO()) {
            // attaquer l'adversaire
            $this->attaquer($adversaire);
            if ($adversaire->estKO()) break;

            // l'adversaire attaque
            $adversaire->attaquer($this);
        }

        return $this->estKO() ? "{$adversaire->getNom()} a gagné !" : "{$this->getNom()} a gagné !";
    }

    // méthode pour utiliser une attaque spéciale
    public function utiliserAttaqueSpeciale(Pokemon $adversaire): int {
        return $this->capaciteSpeciale($adversaire);
    }

    // méthode abstraite pour la capacité spéciale
    abstract public function capaciteSpeciale(Pokemon $adversaire): int;

    // retourne le log des actions
    public function getLog(): array {
        return $this->log;
    }

    // ajoute un message au log
    public function ajouterLog(string $message): void {
        $this->log[] = $message;
    }
}