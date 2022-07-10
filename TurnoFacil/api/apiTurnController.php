<?php
require_once("./Model/TurnModel.php");
require_once("./api/apiView.php");

class ApiTurnController
{

    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new TurnModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    public function  getTurnsByPatientId($params = null)
    {
        $id_paciente = $params[':ID_PACIENTE'];
        $turns = $this->model->getTurnsByPatientId($id_paciente);
        $this->view->response($turns, 200);
    }

    public function  getTurnsByMedicalId($params = null)
    {
        $id_medico = $params[':ID_MEDICO'];
        $turns = $this->model->getTurnsByMedicalId($id_medico);
        $this->view->response($turns, 200);
    }

    public function confirmTurn($params = null)
    {
        $id_turno = $params[':ID_TURNO'];
        $turns = $this->model->confirmTurn($id_turno);
        $this->view->response($turns, 200);
    }

    public function getTurnsById($params = null)
    {
        $id_turno = $params[':ID_TURNO'];
        $turns = $this->model->getTurnsById($id_turno);
        $this->view->response($turns, 200);
    }

    //esta función, "createTurnBySecretary()", crea un turno en la base de datos segun los datos enviados por el form
    //sin retorno

    public function createTurnBySecretary()
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        //guardo la informacion del formulario
        $formData = json_decode($this->data);
        $id_medico = $formData->id_medico;
        $fecha = $formData->fecha;
        $inicio = $formData->fecha_inicio;
        $fin = $formData->fecha_fin;
        
        //obtengo las horas de los extremo del tramo de tiempo
        $time1 = explode(':', $inicio);
        $hours1 = intval($time1[0]);
        $time2 = explode(':', $fin);
        $hours2 = intval($time2[0]);
        //calculo la cantidad de turnos a crear en base a la diferencia horaria de los extremos del tramo de tiempo dado
        $cant = $hours2 - $hours1;
        
        for ($i = 0; $i < $cant; $i++) {
            //combino la fecha con el inicio del tramo de tiempo dado
            $increment = "$hours1:$time1[1]";
            $fechaTurno = "$fecha $increment";
            //creo un turno disponible a partir del medico y la fecha del mismo
            $this->model->createTurnBySecretary($id_medico, $fechaTurno);
            //aumento el inicio del tramo de tiempo dado en una hora
            $hours1++;
        }
    }
}
