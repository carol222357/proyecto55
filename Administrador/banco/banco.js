
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



//resolver//


$(document).ready(function(){
    tablaBancos = $("#tablaBancos").DataTable({
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
    Banco = fila.find('td:eq(1)').text();
    Codigo = fila.find('td:eq(2)').text();
    Cedula = fila.find('td:eq(3)').text();
    Telefono = fila.find('td:eq(4)').text();
    Beneficiario = fila.find('td:eq(5)').text();

    $("#Banco").val(Banco);
    $("#Codigo").val(Codigo);
    $("#Cedula").val(Cedula);
    $("#Telefono").val(Telefono);
    $("#Beneficiario").val(Beneficiario);
    opcion = 2; //editar

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Banco");
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
            url: "bd_banco/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaBancos.row(fila.parents('tr')).remove().draw();
            }
        });
    }
});
$("#formBancos").submit(function(e){
    e.preventDefault();
    Banco = $.trim($("#Banco").val());
    Codigo = $.trim($("#Codigo").val());
    Cedula = $.trim($("#Cedula").val());
    Telefono = $.trim($("#Telefono").val());
    Beneficiario = $.trim($("#Beneficiario").val());
    $.ajax({
        url: "bd_banco/crud.php",
        type: "POST",
        dataType: "json",
        data: {Banco:Banco, Codigo:Codigo, Cedula:Cedula, Telefono:Telefono, Beneficiario:Beneficiario, id:id, opcion:opcion},
        success: function(data){
            console.log(data);
            id = data[0].id;
            Banco = data[0].Banco;
            Codigo = data[0].Codigo;
            Cedula = data[0].Cedula;
            Telefono = data[0].Telefono;
            Beneficiario = data[0].Beneficiario;
            if(opcion == 1){tablaBancos.row.add([id,Banco,Codigo,Cedula,Telefono,Beneficiario]).draw();}
            else{tablaBancos.row(fila).data([id,Banco,Codigo,Cedula,Telefono,Beneficiario]).draw();}
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