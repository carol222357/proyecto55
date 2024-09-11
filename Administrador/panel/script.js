
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