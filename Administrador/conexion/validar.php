<?php
$conexion = mysqli_connect("localhost", "root", "", "cecal");

if (isset($_POST['registrar'])) {
    if (strlen($_POST['usuario']) >= 1 && strlen($_POST['password']) >= 1 && strlen($_POST['idRol'] >= 1)) {
        $usuario = trim($_POST['usuario']);
        $password = trim($_POST['password']);
        $idRol = trim($_POST['idRol']);

        $pass = ($password);

        $consulta = "INSERT INTO usuarios (usuario, password, idRol)
        VALUES ('$usuario','$pass','$idRol')";
        mysqli_query($conexion, $consulta);
        mysqli_close($conexion);
        header('Location: ../administrador/usuario/usuarios.php');
    }
};
