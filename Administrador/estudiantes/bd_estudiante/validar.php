<?php
$conexion = mysqli_connect("localhost", "root", "", "cecal");

if (isset($_POST['registrar'])) {
    if (strlen($_POST['doc']) >= 1 && strlen($_POST['nombre']) >= 1 && strlen($_POST['apellido']) >= 1 && strlen($_POST['genero']) >= 1&& strlen($_POST['edad']) >= 1&& strlen($_POST['telefono']) >= 1&& strlen($_POST['correo']) >= 1) {
        $doc = trim($_POST['doc']);
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $genero = trim($_POST['genero']);
        $edad = trim($_POST['edad']);
        $telefono = trim($_POST['telefono']);
        $correo = trim($_POST['correo']);


        $consulta = "INSERT INTO propietario (doc, nombre, apellido, genero, edad, telefono, correo)
        VALUES ('$doc','$nombre','$apellido','$genero','$edad','$telefono','$correo')";
        mysqli_query($conexion, $consulta);
        mysqli_close($conexion);
        header('Location: ../estudiantes.php');
    }
};
