{include file="Template/head.tpl"}
    <h1 class="titulo">{$titulo}</h1>
    <form action="{BASE_URL}verTurnosMedico" method="post">
    </form>
    <div class="secretaria">
        <img src="publico/img/user_image.png" alt="Imagen no disponible" class="img-secretaria">
        <p class="nombre">Secretaria</p>
    </div>
    <!--form con select para elegir un medico por nombre y filtrar vista a turnos de este---->
    <form action="{BASE_URL}viewTurnsMedicoOfSecretaria" method="post">
      <label>Seleccionar turnos de medico: </label>
      <select name="medico">
      {foreach from=$medicos item=medico}
        <option value="{$medico->id_medico}">{$medico->Nombre}</option>
      {/foreach}
      </select>
      <button type="submit">Buscar</button>
    </form>
    <!--Div contenedor de columna para listar turnos y columna de formulario para agragar un turno---->
    <div class="div_cont_verTurno_crearTurno">
      <!--Div contenedor de lista de los turnos-->
      <div class="table-admin">
        <table class="table">
          <thead class="table-success">
            <tr>
              <th scope="col">Médico</th>
              <th scope="col">Turnos</th>
            </tr>
          </thead>
          <tbody>
            {foreach from=$turnos item=turno}
              <tr id="{$turno->id_turno}">
                {if $turno->Imagen != null}
                  <td>
                    <img src={$turno->Imagen} alt={$turno->Nombre} class="imagen-tabla">
                  </td>
                {else}
                  <td>
                    <img src="publico/img/user_image.png" alt="Imagen no disponible" class="imagen-tabla">
                  </td>
                {/if}
                <td class="table-success">
                  <p>{$turno->Nombre}</p>
                  <p>{$turno->Especialidad}</p>
                  <p id="turn_date">{$turno->fecha}</p>
                  <p class="dato_paciente">Datos Paciente :</p>
                  <p>{$turno->nombrePaciente}</p>
                  <p>{$turno->dni_paciente}</p>
                  <p>{$turno->ObraSocial}</p>
                  {if $turno->urgencia == 1}
                    <label class="table-success"><button type="button" id="{$turno->id_turno}"><a href="eliminarTurno/{$turno->id_turno}">eliminar</a></button></label>
                  {/if}
                </td>
              </tr>
            {/foreach}
          </tbody>
        </table>
      </div>
      <!--Div contenedor de formulario para cargar un turno-->
      <div class="contenedor_formulario_agregar_turno">
        <form class="form_agregar_turno" id="form_agregar_turno" >
          <legend>Cargar turno</legend>
              <label>Seleccionar médico: </label>
              <select name="medico">
              {foreach from=$medicos item=medico}
                <option value="{$medico->id_medico}">{$medico->Nombre}</option>
              {/foreach}
              </select>

              <label>Fecha: </label>
              <input type="date" id = "turnDate" name = "turnDate">

              <label>Inicio disponibilidad: </label>
              <input type="time" id = "turnBeginning" name = "turnBeginning">
              <label>Fin disponibilidad: </label>
              <input type="time" id = "turnEnd" name = "turnEnd">
          <button type="submit" name = "enviar">Cargar</button>
        </form>
    </div>
    <!--Div contenedor de formulario auxiliar para confirmar un turno-->
    <div class="div_cont_form_Confirm_turn" id="div_cont_form_Confirm_turn" style="display:none"></div>
<footer>

</footer>
<script src="js/app_turn.js"></script>
</body>

</html>