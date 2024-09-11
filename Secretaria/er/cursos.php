<?php
session_start();

//Si nadie inció sesión vuelve a la pag de Login
if ($_SESSION["s_usuario"] === null) {
    header("Location: ../index.php");
} else {
    if ($_SESSION["s_idRol"] != 1) {
        header("Location: ../../Secretaria/panel/index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Control de Pagos</title>

    <link rel="stylesheet" href="cursos.css">

    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
</head>

<body id="body">

    <header>
        <div class="icon__menu">
            <img src="../iconos/bars-solid.svg" class="botones" id="btn_open"></img>
        </div>
        <div class="usuario">
            <img src="../iconos/user-solid.svg" class="botones"></img>
            <h2 class="secion"><span class="badge badge-success">
                    <?php echo $_SESSION["s_usuario"]; ?>
                </span></h2>
            <a class="btn btn-danger btn-lg" href="../conexion/logout.php" role="button">
                <img src="../iconos/right-to-bracket-solid.svg" class="botones1"></img>
            </a>
        </div>
    </header>
    <div class="menu__side" id="menu_side">

        <div class="name__page">
            <img src="../iconos/house-solid.svg" class="botones"></img>
            <h4>CECAL</h4>
        </div>

        <div class="options__menu">

            <a href="../panel/index.php">
                <div class="option">
                    <img src="../iconos/gauge-high-solid.svg" class="botones" title="Panel de Control"></img>
                    <h4>Panel de Control</h4>
                </div>
            </a>

            <a href="../banco/banco.php">
                <div class="option">
                    <img src="../iconos/landmark-solid.svg" class="botones" title="Bancos"></img>
                    <h4>Bancos</h4>
                </div>
            </a>

            <a href="../estudiantes/estudiantes.php">
                <div class="option">
                    <img src="../iconos/circle-user-solid.svg" class="botones" title="Estudiantes"></img>
                    <h4>Estudiantes</h4>
                </div>
            </a>

            <a href="cursos.php" class="selected">
                <div class="option">
                    <img src="../iconos/folder-open-solid.svg" class="botones" title="Cursos"></img>
                    <h4>Cursos</h4>
                </div>
            </a>

            <a href="../pagos/pagos.php">
                <div class="option">
                    <img src="../iconos/money-bill-solid.svg" class="botones" title="Pagos"></img>
                    <h4>Pagos</h4>
                </div>
            </a>

            <a href="../reportes/reportes.php">
                <div class="option">
                    <img src="../iconos/file-regular.svg" class="botones" title="Reportes"></img>
                    <h4>Reportes</h4>
                </div>
            </a>

            <a href="../matricular/matricular.php">
                <div class="option">
                    <img src="../iconos/address-card-regular.svg" class="botones" title="Matricular"></img>
                    <h4>Matricular</h4>
                </div>
            </a>

            <details>
                <summary>
                    <div class="option_1">
                        <img src="../iconos/gears-solid.svg" class="botones" title="Administrador"></img>
                        <h4>----OPCIONES</h4>
                    </div>
                </summary>
                <a href="../administrador/administrador.php">
                    <div class="option">
                        <img src="../iconos/gear-solid.svg" class="botones" title="Administrar"></img>
                        <h4>Administrar</h4>
                    </div>
                </a>
            </details>

            <div class="option">
                <a class="btn btn-danger btn-lg" href="../conexion/logout.php" role="button">
                    <img src="../iconos/right-to-bracket-solid.svg" class="botones1"></img>
                </a>
                <h4>Cerrar Sección</h4>
            </div>


        </div>

    </div>

    <main>
        <form class="Buscador" id="buscar">
            <button type="submit">Buscar</button>
            <input type="text" id="buscador" placeholder="Buscar...">
        </form>
        <a href="cursosregistro.php">
            <div class="agregar_cursos">
                <h4>+ Agregar Curso</h4>
            </div>
        </a>
        <summary class="inicio__1">
            <div class="Matricula_1">
                <img class="imagen" src="imagen1.jpg">
                <h1>Ofimática</h1>
                <h4><b>Capacidad:</b> 30 Alumnos</h4>
                <h4><b>Costo:</b> 10$</h4>
                <button class="button">Editar</button>
            </div>

            <div class="Pagos_1">
                <img class="imagen" src="imagen1.jpg">
                <h1>Farmacéutica</h1>
                <h4><b>Capacidad:</b> 40 Alumnos</h4>
                <h4><b>Costo:</b> 5$</h4>
                <button class="button_1">Editar</button>
            </div>

            <div class="Reportes_1">
                <img class="imagen" src="imagen1.jpg">
                <h1>Agropecuaria</h1>
                <h4><b>Capacidad:</b> 20 Alumnos</h4>
                <h4><b>Costo:</b> 12$</h4>
                <button class="button_2">Editar</button>
            </div>
        </summary>
    </main>

    <script src="cursos.js"></script>
</body>

</html>