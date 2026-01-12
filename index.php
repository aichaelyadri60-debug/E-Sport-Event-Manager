<?php

require_once 'core/kernel/Autoloading.php';
Autoloading::LoadClass();

$pdo = Database::getInstance()->getConnection();


$action         = $_GET['action'] ?? 'index';
$controllerName = $_GET['controller'] ?? 'joueur';

$controllers = [
    'joueur'   => JoueurController::class,
    'Personne' => PersonneController::class,
    'coach'    => CoachController::class,
    'equipe'    => EquipeController::class,
    'transfert'    => TransfertController::class,
    'contrat'    => ContratController::class,
];

if (!isset($controllers[$controllerName])) {
    die('Controller introuvable');
}

$controller = new $controllers[$controllerName]($pdo);

if (!method_exists($controller, $action)) {
    die('Action introuvable');
}

$controller->$action();


