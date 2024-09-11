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
    <link rel="stylesheet" href="reportes.css">

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

            <a href="../cursos/cursos.php">
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

            <a href="reportes.php" class="selected">
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
        <div>
            <center>
                <h1>Reportes</h1>
            </center>
        </div>
        <summary class="inicio__1">
            <div class="Matricula_1">
                <img class="imagen" src="imagen1.jpg">
                <h1>Estudiantes</h1><br>
                <h4><b>Inscritos:</b> 30 Alumnos</h4>
                <button class="button">Mas</button>
            </div>

            <div class="Pagos_1">
                <img class="imagen" src="imagen2.jpg">
                <h1>Cursos</h1><br>
                <h4><b>Realizados:</b> 10 </h4>
                <button class="button_1">Mas</button>
            </div>

            <div class="Reportes_1">
                <img class="imagen" src="imagen3.jpg">
                <h1>Pagos</h1><br>
                <h4><b>Recibidos:</b> 100$</h4>
                <button class="button_2">Mas</button>
            </div>
        </summary>
        <section>
            <div class="Genero_1">
                <img class="imagen" src="imagen4.jpg">
                <h1>Genero</h1><br>
                <table>
                    <td>
                        <h4><b>M:</b> 40</h4>
                    </td>
                    <td>
                        <h4><b>F:</b> 40</h4>
                    </td>
                </table>
                <button class="button_3">Mas</button>
            </div>

            <div class="Tasa_1">
                <img class="imagen" src="imagen5.jpg">
                <h1>Tasa</h1><br>
                <h4><b>Última:</b> 36,23</h4>
                <button class="button_4">Mas</button>
            </div>
        </section>
    </main>

    <script src="../../estilos1/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../estilos/plugins/sweet_alert2/sweetalert2.all.min.js"></script>
    <script src="reportes.js"></script>
</body>

</html>