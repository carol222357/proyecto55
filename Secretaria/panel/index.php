<?php
session_start();

//Si nadie inció sesión vuelve a la pag de Login
if ($_SESSION["s_usuario"] === null) {
    header("Location: ../index.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <title>Control de Pagos</title>

    <link rel="stylesheet" href="estilos_1.css">

    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
</head>

<body id="body">

    <header>
        <div class="icon__menu">
            <img src="../iconos/bars-solid.svg" class="botones" id="btn_open"></img>
        </div>
        <div class="usuario">
            <img src="../iconos/user-solid.svg" class="botones"></img>
            <h4>Administrador</h4>
            <a href="../seccion.html">
                <img src="../iconos/right-to-bracket-solid.svg" class="botones"></img>
            </a>
        </div>
    </header>

    <div class="menu__side" id="menu_side">

        <div class="name__page">
            <img src="../iconos/house-solid.svg" class="botones"></img>
            <h4>CECAL</h4>
        </div>

        <div class="options__menu">

            <a href="index.html" class="selected">
                <div class="option">
                    <img src="../iconos/gauge-high-solid.svg" class="botones" title="Panel de Control"></img>
                    <h4>Panel de Control</h4>
                </div>
            </a>

            <a href="../banco/banco.html">
                <div class="option">
                    <img src="../iconos/landmark-solid.svg" class="botones" title="Bancos"></img>
                    <h4>Bancos</h4>
                </div>
            </a>

            <a href="../estudiantes/estudiantes.html">
                <div class="option">
                    <img src="../iconos/circle-user-solid.svg" class="botones" title="Estudiantes"></img>
                    <h4>Estudiantes</h4>
                </div>
            </a>

            <a href="../cursos/cursos.html">
                <div class="option">
                    <img src="../iconos/folder-open-solid.svg" class="botones" title="Cursos"></img>
                    <h4>Cursos</h4>
                </div>
            </a>

            <a href="../pagos/pagos.html">
                <div class="option">
                    <img src="../iconos/money-bill-solid.svg" class="botones" title="Pagos"></img>
                    <h4>Pagos</h4>
                </div>
            </a>

            <a href="../matricular/matricular.html">
                <div class="option">
                    <img src="../iconos/address-card-regular.svg" class="botones" title="Matricular"></img>
                    <h4>Matricular</h4>
                </div>
            </a>

            <a href="../seccion.html">
                <div class="option">
                    <img src="../iconos/right-to-bracket-solid.svg" class="botones" title="Cerrar Seccion"></img>
                    <h4>Cerrar Sección</h4>
                </div>
            </a>


        </div>

    </div>

    <main>
        <div class="bienvenido">
            <h1 class="letra">Bienvenidos<p> al Control de Pagos del Cecal-Salle</h1>
            <img class="imagen_1" src="hola.jpg">
        </div>
        <summary class="inicio__1">
            <div class="Matricula_1">
                <i class="fa-solid fa-window-maximize"></i>
                <h4>-----</h4>
                <h1>Matricula</h1>
                <a href="../matricular/matricular.html">
                    <button class="button">Matricular</button>
                </a>
            </div>

            <div class="Pagos_1">
                <i class="fa-solid fa-credit-card"></i>
                <h4>-----</h4>
                <h1>Pagos</h1>
                <a href="../pagos/pagos.html">
                    <button class="button_1">Pagos</button>
                </a>
            </div>

            <div class="Reportes_1">
                <i class="fa-solid fa-file-export"></i>
                <h4>-----</h4>
                <h1>Reportes</h1>
                <a href="../reportes/reportes.html">
                    <button class="button_2">Reportes</button>
                </a>
            </div>
        </summary>
    </main>

    <script src="script.js"></script>
</body>

</html>