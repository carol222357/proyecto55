
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


//resolver//


$(document).ready(function(){
    tablaCursos = $("#tablaCursos").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });

var fila; //capturar la fila para editar o borrar el registro

//botón EDITAR
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    docente = fila.find('td:eq(2)').text();
    capacidad = fila.find('td:eq(3)').text();
    fecha_inicio = fila.find('td:eq(4)').text();
    fecha_cierre = fila.find('td:eq(5)').text();
    costo = fila.find('td:eq(6)').text();
    imagen = parseInt(fila.find('td:eq(7)').text());

    $("#nombre").val(nombre);
    $("#docente").val(docente);
    $("#capacidad").val(capacidad);
    $("#fecha_inicio").val(fecha_inicio);
    $("#fecha_cierre").val(fecha_cierre);
    $("#costo").val(costo);
    $("#imagen").val(imagen);
    opcion = 2; //editar

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Curso");
    $("#modalCRUD").modal("show");
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd_cursos/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaCursos.row(fila.parents('tr')).remove().draw();
            }
        });
    }
});
$("#formCursos").submit(function(e){
    e.preventDefault();
    nombre = $.trim($("#nombre").val());
    docente = $.trim($("#docente").val());
    capacidad = $.trim($("#capacidad").val());
    fecha_inicio = $.trim($("#fecha_inicio").val());
    fecha_cierre = $.trim($("#fecha_cierre").val());
    costo = $.trim($("#costo").val());
    imagen = $.trim($("#imagen").val());
    $.ajax({
        url: "bd_cursos/crud.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, docente:docente, capacidad:capacidad, fecha_inicio:fecha_inicio, fecha_cierre:fecha_cierre, costo:costo, imagen:imagen, id:id, opcion:opcion},
        success: function(data){
            console.log(data);
            id = data[0].id;
            nombre = data[0].nombre;
            docente = data[0].docente;
            capacidad = data[0].capacidad;
            fecha_inicio = data[0].fecha_inicio;
            fecha_cierre = data[0].fecha_cierre;
            costo = data[0].costo;
            imagen = data[0].imagen;
            if(opcion == 1){tablaCursos.row.add([id,nombre,docente,capacidad,fecha_inicio,fecha_cierre,costo,imagen]).draw();}
            else{tablaCursos.row(fila).data([id,nombre,docente,capacidad,fecha_inicio,fecha_cierre,costo,imagen]).draw();}
        }
    });
$("#modalCRUD").modal("hide");
});
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