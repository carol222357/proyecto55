<?php
$conexion = mysqli_connect("localhost", "root", "", "cecal");

if (isset($_POST['registrar'])) {
    if (strlen($_POST['Banco']) >= 1 && strlen($_POST['Cedula']) >= 1 && strlen($_POST['Telefono'] >= 1 && strlen($_POST['Beneficiario']) >= 1)) {
        $Banco = trim($_POST['Banco']);
        $Codigo = trim($_POST['Codigo']);
        $Cedula = trim($_POST['Cedula']);
        $Telefono = trim($_POST['Telefono']);
        $Beneficiario = trim($_POST['Beneficiario']);


        $consulta = "INSERT INTO bancos (Banco, Codigo, Cedula, Telefono, Beneficiario)
        VALUES ('$Banco','$Codigo','$Cedula','$Telefono','$Beneficiario')";
        mysqli_query($conexion, $consulta);
        mysqli_close($conexion);
        header('Location: ../banco.php');
    }
};
