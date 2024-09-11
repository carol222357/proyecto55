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

    <link rel="stylesheet" href="../../../estilos/plugins/sweet_alert2/sweetalert2.min.css">
    <link rel="stylesheet" href="usuarios.css">

    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
</head>

<body id="body">

    <header>
        <div class="icon__menu">
            <img src="../../iconos/bars-solid.svg" class="botones" id="btn_open"></img>
        </div>
        <div class="usuario">
            <img src="../../iconos/user-solid.svg" class="botones"></img>
            <h2 class="secion"><span class="badge badge-success">
                    <?php echo $_SESSION["s_usuario"]; ?>
                </span></h2>
            <a class="btn btn-danger btn-lg" href="../../conexion/logout.php" role="button">
                <img src="../../iconos/right-to-bracket-solid.svg" class="botones1"></img>
            </a>
        </div>
    </header>

    <div class="menu__side" id="menu_side">

        <div class="name__page">
            <img src="../../iconos/house-solid.svg" class="botones"></img>
            <h4>CECAL</h4>
        </div>

        <div class="options__menu">

            <a href="../../panel/index.php">
                <div class="option">
                    <img src="../../iconos/gauge-high-solid.svg" class="botones" title="Panel de Control"></img>
                    <h4>Panel de Control</h4>
                </div>
            </a>

            <a href="../../banco/banco.php">
                <div class="option">
                    <img src="../../iconos/landmark-solid.svg" class="botones" title="Bancos"></img>
                    <h4>Bancos</h4>
                </div>
            </a>

            <a href="../../estudiantes/estudiantes.php">
                <div class="option">
                    <img src="../../iconos/circle-user-solid.svg" class="botones" title="Estudiantes"></img>
                    <h4>Estudiantes</h4>
                </div>
            </a>

            <a href="../../cursos/cursos.php">
                <div class="option">
                    <img src="../../iconos/folder-open-solid.svg" class="botones" title="Cursos"></img>
                    <h4>Cursos</h4>
                </div>
            </a>

            <a href="../../pagos/pagos.php">
                <div class="option">
                    <img src="../../iconos/money-bill-solid.svg" class="botones" title="Pagos"></img>
                    <h4>Pagos</h4>
                </div>
            </a>

            <a href="../../reportes/reportes.php">
                <div class="option">
                    <img src="../../iconos/file-regular.svg" class="botones" title="Reportes"></img>
                    <h4>Reportes</h4>
                </div>
            </a>

            <a href="../../matricular/matricular.php">
                <div class="option">
                    <img src="../../iconos/address-card-regular.svg" class="botones" title="Matricular"></img>
                    <h4>Matricular</h4>
                </div>
            </a>

            <details>
                <summary>
                    <div class="option_1">
                        <img src="../../iconos/gears-solid.svg" class="botones" title="Administrador"></img>
                        <h4>----OPCIONES</h4>
                    </div>
                </summary>
                <a href="../../administrador/administrador.php">
                    <div class="option">
                        <img src="../../iconos/gear-solid.svg" class="botones" title="Administrar"></img>
                        <h4>Administrar</h4>
                    </div>
                </a>
            </details>

            <div class="option">
                <a class="btn btn-danger btn-lg" href="../../conexion/logout.php" role="button">
                    <img src="../../iconos/right-to-bracket-solid.svg" class="botones1"></img>
                </a>
                <h4>Cerrar Sección</h4>
            </div>


        </div>

    </div>

    <main>


        <summary class="registro">
            <form id="formPersonas" action="../../conexion/validar.php" method="post">
                <center>
                    <h1>Usuario Nuevo</h1>
                </center>
                <table class="tablereistre">
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label for="usuario">Usuario:</label></td>
                        <td><input type="text" id="usuario" name="usuario" required minlength="5"></td>
                    </tr>
                    <tr>
                        <td><label for="password">Contraseña:</label></td>
                        <td><input type="password" id="password" name="password" required minlength="8"></td>
                    </tr>
                    <tr>
                        <td><label for="idRol">Rol:</label></td>
                        <td>
                            <select class="rol" id="idRol" name="idRol">
                                <option>1</option>
                                <option>2</option>
                            </select>
                    </tr>
                </table>
                <input class="si" type="submit" value="Guardar" name="registrar"></input>
                <button class="no" type="button" onclick="location.href='usuarios.php';">Cancelar</button>
            </form>

        </summary>

    </main>

    <script src="../../../estilos1/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../../estilos/plugins/sweet_alert2/sweetalert2.all.min.js"></script>
    <script src="usuarios.js"></script>
</body>

</html>