<?php

require_once('libs/smarty-3.1.39/libs/Smarty.class.php');

class TurnosView
{
    function __construct()
    {
        $this->smarty = new Smarty();
    }

    //DisplayLogin()
    //esta funcion muestra el login para elegir si ingresar como paciente o secretaria
    public function DisplayLogin()
    {
        $this->smarty->assign('titulo', "Login");
        $this->smarty->display('Template/login.tpl');
    }
    //turnos($turnos,$medicos)
    //esta funcion recibe una lista de turnos y medicos
    //carga el template con los turnos venideros de la Base de Datos
    function showTurnosSecretaria($turnos, $medicos)
    {
        $this->smarty->assign('titulo', 'Administracion de Turnos');
        $this->smarty->assign('turnos', $turnos);
        $this->smarty->assign('medicos', $medicos);
        $this->smarty->display('Template/secretaryTurns.tpl');
    }
    function showTurnosPacient($Turnos, $Medicos)
    {
        $this->smarty->assign('titulo', 'Turno Disponibles');
        $this->smarty->assign('lista', $Turnos);
        $this->smarty->assign('medicos', $Medicos);
        $this->smarty->display('Template/pacientTurns.tpl');
    }

    function showTurnosByMedic($turnos, $medicos)
    {
        $this->smarty->assign('titulo', 'Turnos De Medico');
        $this->smarty->assign('lista', $turnos);
        $this->smarty->assign('medicos', $medicos);
        $this->smarty->display('Template/turnsByMedico.tpl');
    }


    function renderError($error)
    {
        $this->smarty->assign('error', $error);
        $this->smarty->display('Template/error.tpl');
    }
    //Esta función, "showConfirmTurn($medicalName, $medicalSpeciality, $date, $id_turno, $imagen = null)"
    //carga el template que muestra la pantalla del turno confirmado
    //Paráetros que recibe: nombre del médico, especialidad del médico, fecha del turno, imagen del médico.
    //sin retorno.
    function showConfirmTurn($medicalName, $medicalSpeciality, $date, $id_turno, $imagen = null)
    {
        $this->smarty->assign('titulo', 'confirmedTurn');
        $this->smarty->assign('medico', $medicalName);
        $this->smarty->assign('especialidad', $medicalSpeciality);
        $this->smarty->assign('date', $date);
        $this->smarty->assign('id_turno', $id_turno);
        $this->smarty->assign('imagen', $imagen);
        $this->smarty->display('Template/confirmedTurn.tpl');
    }
}
