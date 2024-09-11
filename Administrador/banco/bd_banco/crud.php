<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$Banco = (isset($_POST['Banco'])) ? $_POST['Banco'] : '';
$Codigo = (isset($_POST['Codigo'])) ? $_POST['Codigo'] : '';
$Cedula = (isset($_POST['Cedula'])) ? $_POST['Cedula'] : '';
$Telefono = (isset($_POST['Telefono'])) ? $_POST['Telefono'] : '';
$Beneficiario = (isset($_POST['Beneficiario'])) ? $_POST['Beneficiario'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch ($opcion) {
    case 2: //modificación
        $consulta = "UPDATE bancos SET Banco='$Banco', Codigo='$Codigo',Cedula='$Cedula', Telefono='$Telefono', Beneficiario='$Beneficiario' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, Banco, Codigo, Cedula, Telefono, Beneficiario FROM bancos WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3: //baja
        $consulta = "DELETE FROM bancos WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
