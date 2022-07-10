<?php
require_once './Controller/TurnosController.php';
define("BASE_URL", 'http://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"] . dirname($_SERVER["PHP_SELF"]) . '/');


if (!empty($_GET["action"])) {
    $action = $_GET["action"];
} else {
    $action = 'home';
}
$TurnosController = new TurnosController();

$params = explode('/', $action);
switch ($params[0]) {
    case 'home':
        $TurnosController->getLogin();
        break;
    case 'verTurnosMedico':
        $TurnosController->getTurnsOfMedical();
        break;
    case 'verTurnoConfirmado':
        //muestra pantalla con el turno que fue confirmado
        //también envia email al paciente con los datos del turno confirmado
        $TurnosController->showConfirmTurn();
        break;
    case 'viewSecretaria':
        $TurnosController->getTurnsOfMedicalsOfSecretary();
        break;
    case 'viewTurnsMedicoOfSecretaria':
        //muestra la misma view de secretaria pero solo con turnos de medico seleccionado
        $TurnosController->getTurnsOfMedicalOfSecretary();
        break;
    case 'eliminarTurno':
        $TurnosController->deleteTurn($params[1]);
        break;
    default:
        $TurnosController->getHomePacient();
        break;
}
