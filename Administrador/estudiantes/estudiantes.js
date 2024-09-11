
document.getElementById("btn_open").addEventListener("click", open_close_menu);


var side_menu = document.getElementById("menu_side");
var btn_open = document.getElementById("btn_open");
var body = document.getElementById("body");


    function open_close_menu(){
        body.classList.toggle("body_move");
        side_menu.classList.toggle("menu__side_move");
    }



if (window.innerWidth < 760){

    body.classList.add("body_move");
    side_menu.classList.add("menu__side_move");
}



window.addEventListener("resize", function(){

    if (window.innerWidth > 760){

        body.classList.remove("body_move");
        side_menu.classList.remove("menu__side_move");
    }

    if (window.innerWidth < 760){

        body.classList.add("body_move");
        side_menu.classList.add("menu__side_move");
    }

});


$(document).ready(function(){
    tablaEstudiantes = $("#tablaEstudiantes").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],     
        language: {
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
            },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel"></i> ',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
			{
				extend:    'pdfHtml5',
				text:      '<i class="fas fa-file-pdf"></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-danger'
			},
			{
				extend:    'print',
				text:      '<i class="fa fa-print"></i> ',
				titleAttr: 'Imprimir',
				className: 'btn btn-info'
			},
		]	        
    });     
});

var fila; //capturar la fila para editar o borrar el registro

//botón EDITAR
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    doc = fila.find('td:eq(1)').text();
    nombre = fila.find('td:eq(2)').text();
    apellido = fila.find('td:eq(3)').text();
    edad = fila.find('td:eq(4)').text();
    genero = fila.find('td:eq(5)').text();
    telefono = fila.find('td:eq(6)').text();
    correo = fila.find('td:eq(7)').text();

    $("#doc").val(doc);
    $("#nombre").val(nombre);
    $("#apellido").val(apellido);
    $("#edad").val(edad);
    $("#genero").val(genero);
    $("#telefono").val(telefono);
    $("#correo").val(correo);
    opcion = 2; //editar

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Estudiante");
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
            url: "bd_estudiante/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaEstudiantes.row(fila.parents('tr')).remove().draw();
            }
        });
    }
});
$("#formEstudiantes").submit(function(e){
    e.preventDefault();
    doc = $.trim($("#doc").val());
    nombre = $.trim($("#nombre").val());
    apellido = $.trim($("#apellido").val());
    edad = $.trim($("#edad").val());
    genero = $.trim($("#genero").val());
    telefono = $.trim($("#telefono").val());
    correo = $.trim($("#correo").val());
    $.ajax({
        url: "bd_estudiante/crud.php",
        type: "POST",
        dataType: "json",
        data: {doc:doc, nombre:nombre, apellido:apellido, edad:edad, genero:genero, telefono:telefono, correo:correo, id:id, opcion:opcion},
        success: function(data){
            console.log(data);
            id = data[0].id;
            doc = data[0].doc;
            nombre = data[0].nombre;
            apellido = data[0].apellido;
            edad = data[0].edad;
            genero = data[0].genero;
            telefono = data[0].telefono;
            correo = data[0].correo;
            if(opcion == 1){tablaEstudiantes.row.add([id,doc,nombre,apellido,edad,genero,telefono,correo]).draw();}
            else{tablaEstudiantes.row(fila).data([id,doc,nombre,apellido,edad,genero,telefono,correo]).draw();}
        }
    });
$("#modalCRUD").modal("hide");
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