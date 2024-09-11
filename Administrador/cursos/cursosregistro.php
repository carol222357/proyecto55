<?php
session_start();

// Si nadie inció sesión vuelve a la pag de Login
if ($_SESSION["s_usuario"] === null) {
    header("Location: ../../index.php");
    exit;
} elseif ($_SESSION["s_idRol"] != 1) {
    header("Location: ../../../Secretaria/panel/index.php");
    exit;
}

// Update the session time
$_SESSION['time'] = time();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Control de Pagos</title>

    <link rel="stylesheet" href="../../estilos/plugins/sweet_alert2/sweetalert2.min.css">
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


        <summary class="registro">
            <form enctype="multipart/form-data" action="bd_cursos/validar.php" method="post">
                <h1>Nuevo Curso</h1>
                <table class="tablereistre">
                    <tr>
                        <td><label for="nombre">Nombre de Curso:</label></td>
                        <td><input type="text" id="nombre" name="nombre"></td>
                    </tr>
                    <tr>
                        <td><label for="docente">Docente:</label></td>
                        <td><input type="text" id="docente" name="docente"></td>
                    </tr>
                    <tr>
                        <td><label for="capacidad">Capacidad:</label></td>
                        <td><input type="text" id="capacidad" name="capacidad"></td>
                    </tr>
                    <tr>
                        <td><label for="fecha_inicio">Fecha de Inicio:</label></td>
                        <td><input class="fecha" type="date" id="fecha_inicio" name="fecha_inicio"></td>
                    </tr>
                    <tr>
                        <td><label for="fecha_cierre">Fecha de Culminación:</label></td>
                        <td><input class="fecha" type="date" id="fecha_cierre" name="fecha_cierre"></td>
                    </tr>
                    <tr>
                        <td><label for="costo">Costo:</label></td>
                        <td><input type="text" id="costo" name="costo"></td>
                    </tr>
                    <tr>
                        <td><label for="imagen" class="col-form-label">Imagen:</label></td>
                        <td><input type="file" class="form-control" id="imagen" name="imagen"></td>
                    </tr>
                </table>
                <input class="si" type="submit" value="Guardar" name="registrar"></input>
                <button class="no" type="button" onclick="location.href='curso.php';">Cancelar</button>
            </form>

        </summary>

    </main>

    <script src="../../estilos1/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../estilos/plugins/sweet_alert2/sweetalert2.all.min.js"></script>
    <script src="cursos.js"></script>
</body>

</html>