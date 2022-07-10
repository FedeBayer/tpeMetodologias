{include file="Template/head.tpl"}
{include file="Template/header.tpl"}
    <h1 class="titulo">{$titulo}</h1>
    <div class = "div_turn_confirm" id="{$id_turno}">

        <tr id="{$id_turno}">
        {if $imagen != null}
          <td>
          <img src={$imagen} alt={$medico} class="imagen-tabla">
          </td>
        {else}
          <td>
          <img src="publico/img/user_image.png" alt="Imagen no disponible" class="imagen-tabla">
          </td>
        {/if}
        <td class="table-success">
            <p>{$medico}</p>
            <p>{$especialidad}</p>
            <p id="turn_date">{$date}</p>
            <label><button class="btn_print btn_print_confirm" type="button" id="{$id_turno}">Imprimir</button></label>
          </td>
        </tr>

    </div>
<script src="js/app_turn.js"></script>
</body>

</html>