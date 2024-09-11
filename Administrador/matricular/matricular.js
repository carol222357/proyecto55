$(document).ready(function(){
    $('.cargando').hide();
  });  

function buscar_datos()
{
doc = $("#doc").val();


var parametros = 
{
  "buscar": "1",
  "doc" : doc
};
$.ajax(
{
  data:  parametros,
  dataType: 'json',
  url:   'codigos_php.php',
  type:  'post',
  beforeSend: function() 
  {
    $('.formulario').hide();
    $('.cargando').show();
    
  }, 
  error: function()
  {alert("Error");},
  complete: function() 
  {
    $('.formulario').show();
    $('.cargando').hide();
   
  },
  success:  function (valores) 
  {
    if(valores.existe=="1") //Aqui usamos la variable que NO use en el vídeo
    {
      $("#nombre").val(valores.nombre);
      $("#dir").val(valores.direccion);
      $("#tel").val(valores.telefono);
    }
    else
    {
      alert("El propietario no existe, ¡Crealo!")
    }

  }
}) 
}

function limpiar()
{
$("#doc").val("");
$("#nombre").val("");
$("#dir").val("");
$("#tel").val("");
}

function guardar()
{
var parametros = 
{
  "guardar": "1",
  "doc" : $("#doc").val(),
  "nombre" : $("#nombre").val(),
  "tel" : $("#tel").val(),
  "dir" : $("#dir").val()
};
$.ajax(
{
  data:  parametros,
  url:   'codigos_php.php',
  type:  'post',
  beforeSend: function() 
  {
    $('.formulario').hide();
    $('.cargando').show();
    
  }, 
  error: function()
  {alert("Error");},
  complete: function() 
  {
    $('.formulario').show();
    $('.cargando').hide();
   
  },
  success:  function (mensaje) 
  {$('.resultados').html(mensaje);}
}) 
limpiar();
}


document.getElementById("btn_open").addEventListener("click", open_close_menu);


var side_menu = document.getElementById("menu_side");
var btn_open = document.getElementById("btn_open");
var body = document.getElementById("body");


function open_close_menu() {
    body.classList.toggle("body_move");
    side_menu.classList.toggle("menu__side_move");
}



if (window.innerWidth < 760) {

    body.classList.add("body_move");
    side_menu.classList.add("menu__side_move");
}



window.addEventListener("resize", function () {

    if (window.innerWidth > 760) {

        body.classList.remove("body_move");
        side_menu.classList.remove("menu__side_move");
    }

    if (window.innerWidth < 760) {

        body.classList.add("body_move");
        side_menu.classList.add("menu__side_move");
    }

});



$(document).ready(function(){
    $('.cargando').hide('');
});
function buscar_datos()
{
    cedula = $("#cedula").val();

    var parametros =
    {
        "buscar": "1",
        "cedula": cedula
    };
    $.ajax(
    {
        data: parametros,
        dataType: 'json',
        url: 'bd_matricular/buscar.php',
        type: 'post',
        beforeSend: function()
        { alert("enviando");},
        error: function()
        {alert("Error");},
        complete: function()
        {alert("¡Listo!");},
        success: function(valores)
        {
            alert(valores.nombre);
        }

    }
    )
}


  var formSubmitted = false;
  var token = Math.random().toString(36).substr(2);
  var solicitudEnviada = false;
  
  $('#formLogin').on('submit', function (e) {
    e.preventDefault();
    e.stopPropagation();
    if (formSubmitted || solicitudEnviada) return;
    formSubmitted = true;
    solicitudEnviada = true;
    $('#submitButton').prop('disabled', true);
    
    var doc = $.trim($("#doc").val());
    var nombre = $.trim($("#nombre").val());
    var dir = $.trim($("#dir").val());
    var tel = $.trim($("#tel").val());
    var curso = $.trim($("#curso").val());
    var costo = $.trim($("#costo").val());
    
    $.ajax({
        url: "bd/validar.php",
        type: "POST",
        dataType: "json",
        data: { 
            doc: doc, 
            nombre: nombre, 
            dir: dir, 
            tel: tel, 
            curso: curso, 
            costo: costo, 
            registrar: true,
            token: token
        },
        success: function (data) {
            if (data.status == "success") {
                Swal.fire({
                    type: 'success',
                    title: 'Matriculación correcta',
                    showConfirmButton: false,
                    timer: 1500,  
                });
                // Limpiar campos del formulario
                $('#formLogin')[0].reset();
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Matriculación incorrecta',
                });
            }
            formSubmitted = false;
            solicitudEnviada = false;
            $('#submitButton').prop('disabled', false);
        }
    });
    return false; // Prevenir el doble envío
});


//tiempo de inactividad//

let timeout = setTimeout(function() {
  Swal.fire({
      title: "Sesión cerrada",
      text: "Sesión cerrada debido a inactividad",
      icon: "info"
  }).then(() => {
      // Llamar al archivo PHP que destruye la sesión
      fetch('../conexion/destroy_session.php')
          .then(response => response.text())
          .then(() => {
              window.location.href = '../../index.php';
          });
  });
}, 600000); // 10 minutos de inactividad

// Resetear el timeout cuando el usuario hace algo
document.addEventListener('mousemove', resetTimeout);
document.addEventListener('keypress', resetTimeout);
document.addEventListener('scroll', function(event) {
  if (!event.target.classList.contains('menu__side')) {
      resetTimeout();
  }
});

function resetTimeout() {
  clearTimeout(timeout);
  timeout = setTimeout(function() {
      Swal.fire({
          title: "Sesión cerrada",
          text: "Sesión cerrada debido a inactividad",
          icon: "info"
      }).then(() => {
          fetch('../conexion/destroy_session.php')
              .then(response => response.text())
              .then(() => {
                  window.location.href = '../../index.php';
              });
      });
  }, 600000); // 10 minutos de inactividad
}