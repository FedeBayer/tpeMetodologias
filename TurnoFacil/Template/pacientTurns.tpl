{include file="Template/head.tpl"}
{include file="Template/header.tpl"}
    <h1 class="titulo">{$titulo}</h1>
    <form action="{BASE_URL}verTurnosMedico" method="post">
      <label>Seleccionar turnos de medico: </label>
      <select name="medico">
      {foreach from=$medicos item=medico}
        <option value="{$medico->id_medico}">{$medico->Nombre}</option>
      {/foreach}
      </select>
      <button type="submit">Buscar</button>
    </form>

    <div class="table-turnos">
      <table class="table">
      <thead class="table-success">
        <tr>
        <th scope="col">Medico</th>
      <th scope="col">Turnos</th>
    </tr>
  </thead>
  <tbody>
  {foreach from=$lista item=turno}
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
         {if $turno->confirmado == 0}
        <label class="table-success"><button class="btn_confirm" type="button" id="{$turno->id_turno}">confirmar</button></label>
        {else}
        <label class="table-success"><button class="btn_print" type="button" id="{$turno->id_turno}">Imprimir</button></label>
        {/if}
      </td>
    </tr>
    {/foreach}
  </tbody>
</table>
    </div>
    <div class="div_cont_form_Confirm_turn" id="div_cont_form_Confirm_turn" style="display:none"></div>

<footer>

</footer>
<script src="js/app_turn.js"></script>
</body>

</html>