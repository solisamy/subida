<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$empresa = (isset($_POST['empresa'])) ? $_POST['empresa'] : '';
$celular = (isset($_POST['celular'])) ? $_POST['celular'] : '';
$cedula = (isset($_POST['cedula'])) ? $_POST['cedula'] : '';
$realizado = (isset($_POST['realizado'])) ? $_POST['realizado'] : '';
$herramienta = (isset($_POST['herramienta'])) ? $_POST['herramienta'] : '';
$monto = (isset($_POST['monto'])) ? $_POST['monto'] : '';
$abona = (isset($_POST['abona'])) ? $_POST['abona'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO inventario (nombre, empresa, celular, cedula, realizado, herramienta, monto, abona) VALUES('$nombre', '$empresa', '$celular', '$cedula', '$realizado', '$herramienta', '$monto', '$abona') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, nombre, empresa, celular, cedula, realizado, herramienta, monto, abona FROM inventario ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE inventario SET nombre='$nombre', empresa='$empresa', celular='$celular', cedula='$cedula', realizado='$realizado', herramienta='$herramienta', monto='$monto', abona='$abona' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, nombre, empresa, celular, cedula, realizado, herramienta, monto, abona FROM inventario WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM inventario WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}
$conexion = NULL;