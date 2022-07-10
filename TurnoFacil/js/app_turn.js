//"use strict";
//document.querySelector(".btn_print").addEventListener('click', printInfo);

//let id_paciente = 11223344;

document.addEventListener("DOMContentLoaded", function (e) {
  //GetTurns(id_paciente);
  try {
    //agrega funcionalidad de confirmar turno a botones
    let btn_confirm = document.querySelectorAll(".btn_confirm");
    btn_confirm.forEach(btn => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        //si el botón es clickeado esta función se ejecuta
        ConfirmTurn(btn.id);
      });
    });
  } catch (error) { }
  try {
    let btn_print = document.querySelectorAll(".btn_print");
    btn_print.forEach(btn => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        printInfo(btn.id);
      });
    });
  } catch (error) { }
  
  let form = document.getElementById("form_agregar_turno");
  if (form) {
    //si el formulario se dispara se ejecuta la funcion createTurn
    form.addEventListener("submit", function (e) {
      createTurn(form)
    })
  }

});

async function createTurn(form) {
  //guardo los datos del formulario
  let data = new FormData(form);
  let turn = {
    id_medico: data.get("medico"),
    fecha: data.get("turnDate"),
    fecha_inicio: data.get("turnBeginning"),
    fecha_fin: data.get("turnEnd")
  };
  try {
    //envio una peticion a la API para crear los turnos con los datos del formulario
    await fetch('api/createTurnBySecretary/', {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(turn)
    })
  }
  catch (t) {
    console.log(t);
  }
}

//Esta función "ConfirmTurn(id_turn)" confirna un turno en específico
//recibe el id del turno a confirmar
//sin retorno
async function ConfirmTurn(id_turn) {
  try {
    //modifica la base de datos, confirmando el turno
    await fetch('api/confirmarTurno/' + id_turn, {
      "method": 'POST',
      "headers": { "Content-Type": "application/json" },
    });
    //cambio de pantalla, mostrando detalles del turno confirmado
    GetConfirmTurn(id_turn);
  }
  catch (t) {
    console.log(t);
  }
}
//Esta función "GetConfirmTurn(id_turn)" muestra por pantalla un turno confirmado, luego de que este fue confirmado
//Recibe "id_turn", este es el id de un turno en específico
async function GetConfirmTurn(id_turn) {
  try {
    //consulta la base de datos para obtener los datos del turno confrimado
    let recibido = await fetch('api/turnoConfirmado/' + id_turn);
    console.log(recibido);
    let json = await recibido.json();
    //llamo a un frmulario auxiliar
    //este permite que se active una ruta del router que cambia la pantalla
    console.log(json);
    ShowConfirmTurn(json);
  }
  catch (t) {
    console.log(t);
  }
}
//Esta función "ShowConfirmTurn(json)" crea un formulario auxiliar, este permite que se active una ruta del router que cambia la pantalla.
//recibe un json, este contiene todos los datos del turno que fue confirmado
    //nombre del médico, especialidad del médico, id del turno, imagen del médico, fecha del turno
    //email del paciente, nombre del paciente del paciente y estado de confirmación delturno.
//sin retorno
function ShowConfirmTurn(json) {
  //crea elemento formulario
  let form = document.createElement("form");
  form.action = "verTurnoConfirmado";
  form.method = "POST";
  //crea elemento input text que guarda el nombre del médico.
  let medicalName = document.createElement("input");
  medicalName.name = "medicalName";
  medicalName.type = "text";
  medicalName.value = json[0].Nombre;
  //crea elemento input text que guarda la especialidad del médico.
  let medicalSpeciality = document.createElement("input");
  medicalSpeciality.name = "medicalSpeciality";
  medicalSpeciality.type = "text";
  medicalSpeciality.value = json[0].Especialidad;
  //crea elemento input text que guarda el id del turno.
  let idTurno = document.createElement("input");
  idTurno.name = "id_turno";
  idTurno.type = "text";
  idTurno.value = json[0].id_turno;
  //crea elemento input text que guarda la imagen del médico
  let imagen = document.createElement("input");
  imagen.name = "imagen";
  imagen.type = "text";
  imagen.value = json[0].Imagen;
  //crea elemento input text que guarda la fecha del turno
  let date = document.createElement("input");
  date.name = "date";
  date.type = "text";
  date.value = json[0].fecha;
  //crea elemento input text que guarda el email del paciente
  let mail = document.createElement("input");
  mail.name = "mail";
  mail.type = "text";
  mail.value = json[0].Email;
  //crea elemento input text que guarda el nombre del paciente
  let nombrePaciente = document.createElement("input");
  nombrePaciente.name = "nombre_paciente";
  nombrePaciente.type = "text";
  nombrePaciente.value = json[0].nombre_paciente;
  //crea botón tipo submit para efectuar envio del formulario
  let btn = document.createElement("button");
  btn.id = "btn_form_confirm_turn";
  btn.type = "submit";
  //inserta inputs y el botón prebiamente creado en el formulario
  form.appendChild(medicalName);
  form.appendChild(medicalSpeciality);
  form.appendChild(date);
  form.appendChild(btn);
  form.appendChild(idTurno);
  form.appendChild(imagen);
  form.appendChild(mail);
  form.appendChild(nombrePaciente);
  //busca el div donde se va a colocar el formulario en el DOM
  let div = document.querySelector("#div_cont_form_Confirm_turn");
  //inserta el formulario, permitiendo ser leído desde el DOM
  div.appendChild(form);
  //Activa ruta del router que muestra una pantalla con el turno confirmado
  btn.click();
}

//La funcion printInfo(trname), intercambia el contenido de los divs para poder imprimir el contenido del turno
//recibe el id de la fila a intercambiar
//sin retorno
async function printInfo(trname) {
  //Se guarda la fila de la tabla
  let tr = document.getElementById(trname).innerHTML;
  console.log(document.getElementById(trname));
  //Se guarda el contenido original del html
  let original = document.body.innerHTML;
  console.log(trname);

  //Intercambia el contenido del body por la nueva fila
  document.body.innerHTML = tr
  //Llama a la funcion print() que abre el panel de impresion del browser
  window.print();
  //Se intercambia nuevamente el contenido del body por el contenido original
  document.body.innerHTML = original;
}

