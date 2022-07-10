<?php
class TurnModel
{
    private $db;
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=turnofacil;charset=utf8', 'root', '');
    }
    function getTurnsByPatientId($id)
    {
        $queryString = "SELECT * FROM turno t INNER JOIN medico m ON m.id_medico = t.id_medico WHERE t.dni_paciente = ? GROUP BY id_turno ORDER BY t.fecha";
        $query = $this->db->prepare($queryString);
        $query->execute(array($id));
        $turns = $query->fetchAll(PDO::FETCH_OBJ);
        return $turns;
    }

    // la funcion "getTurnsBySecretaryId($id)"
    // Selecciona de la base de datos los turnos donde el medico sea parte del
    // grupo que administra la secretaria(tenga id_secretaria igual al de esta secretaria)
    // retorna esta lista de turnos.
    function getTurnsBySecretaryId($id)
    {
        $queryString = "SELECT m.Nombre,m.Imagen,m.Especialidad,t.fecha,t.id_turno,p.Nombre AS'nombrePaciente',p.ObraSocial,t.dni_paciente,m.urgencia FROM turno t INNER JOIN medico m ON m.id_medico = t.id_medico JOIN paciente p on p.DNI=t.dni_paciente  WHERE m.id_secretaria = ? GROUP BY id_turno ORDER BY t.fecha";
        $query = $this->db->prepare($queryString);
        $query->execute(array($id));
        $turns = $query->fetchAll(PDO::FETCH_OBJ);
        return $turns;
    }

    function getTurnsByMedicalId($id)
    {
        $queryString = "SELECT t.*,m.*,p.Nombre AS 'nombrePaciente', p.ObraSocial FROM turno t INNER JOIN medico m ON m.id_medico = t.id_medico JOIN paciente p on p.DNI=t.dni_paciente WHERE m.id_medico = ? GROUP BY id_turno ORDER BY t.fecha";
        $query = $this->db->prepare($queryString);
        $query->execute(array($id));
        $turns = $query->fetchAll(PDO::FETCH_OBJ);
        return $turns;
    }

    function getMedicalsByPatientId($id)
    {
        $queryString = "SELECT DISTINCT m.Nombre, t.id_medico FROM turno t INNER JOIN medico m ON m.id_medico = t.id_medico WHERE t.dni_paciente = ? GROUP BY id_turno ORDER BY m.nombre";
        $query = $this->db->prepare($queryString);
        $query->execute(array($id));
        $turns = $query->fetchAll(PDO::FETCH_OBJ);
        return $turns;
    }


    function getTurnsById($id)
    {

        /* $queryString = "SELECT t.id_turno, m.Nombre as nombre_medico,
                        p.Nombre as nombre_paciente, p.Email as mail_paciente
                        FROM turno t
                        INNER JOIN medico m ON m.id_medico = t.id_medico
                        INNER JOIN paciente p ON p.DNI = t.dni_paciente
                        WHERE t.id_turno = ?"; */

        $queryString = "SELECT t.id_turno, t.fecha, m.Nombre, m.Imagen, p.Email, m.Especialidad, p.Nombre as nombre_paciente
                        FROM turno t INNER JOIN medico m ON m.id_medico = t.id_medico
                        INNER JOIN paciente p ON t.dni_paciente = p.DNI WHERE id_turno = ?";
        $query = $this->db->prepare($queryString);
        $query->execute(array($id));
        $turns = $query->fetchAll(PDO::FETCH_OBJ);
        return $turns;
    }

    function getMedicalById($id)
    {
        $queryString = "SELECT * FROM medico m WHERE m.id_medico = ?";
        $query = $this->db->prepare($queryString);
        $query->execute(array($id));
        $turns = $query->fetchAll(PDO::FETCH_OBJ);
        return $turns;
    }

    //Esta función, "getAllMedicals()", busca en la base de datos todos los médicos cargados
    //No recibe parámetros
    //retorna todos los médicos guardados en la base de datos
    function getAllMedicals()
    {
        $queryString = "SELECT * FROM medico";
        $query = $this->db->prepare($queryString);
        $query->execute();
        $medicals = $query->fetchAll(PDO::FETCH_OBJ);
        return $medicals;
    }

    //Esta función, "confirmTurn($id)", cambia en la base de datos el estado de confirmación de un turno en específico.
    //lo cambia de no confirmado a confirmado.
    //parametro que recibe: id del turno a cambiar confirmación.
    //sin retorno.
    function confirmTurn($id)
    {
        $queryString = "UPDATE turno SET confirmado = ? WHERE id_turno = ?";
        $query = $this->db->prepare($queryString);
        $query->execute(array(1, $id));
    }
    //Esta function, "deleteTurn($id)", elimina el turno de un paciente, ya que el medico entra en urgencias.
    //parametro que recibe:id del turno del paciente
    //sin retorno
    function deleteTurn($id)
    {
        $queryString = "DELETE FROM turno WHERE id_turno = ?";
        $query = $this->db->prepare($queryString);
        $query->execute(array($id));
    }

    //Esta function, "createTurnBySecretary($id_medico, $fecha)", crea un turno en la DB
    //parametros que recibe:id del medio y fecha
    //sin retorno
    function createTurnBySecretary($id_medico, $fecha)
    {
        $queryString = "INSERT INTO turno(id_medico, fecha, confirmado) VALUES (?,?,?)";
        $query = $this->db->prepare($queryString);
        $query->execute(array($id_medico, $fecha, 0));
    }
}
