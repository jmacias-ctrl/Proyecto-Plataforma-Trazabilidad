<?php
require('view\partials\gestion_departamentos_edificios\conexion.php');

$id_recibido= $_POST["id_edificio"];
$nombre_recibido= $_POST["nombre_edificio"];
$tipo_recibido= $_POST["tipo_edificio"];
$org_recibida= $_POST["id_organizaciones"];
$comuna_recibida= $_POST["cod_ine_com"];

$sql_o="SELECT id FROM organizaciones WHERE id='$org_recibida'";
$sql_c="SELECT cod_ine_com FROM comunas WHERE cod_ine_com='$comuna_recibida'";
$check_o= mysqli_query($conexion, $sql_o);
$check_c= mysqli_query($conexion, $sql_c);

if(mysqli_num_rows($check_o)!=0 && mysqli_num_rows($check_c)!=0){
    echo "true";
    $sql="INSERT INTO edificios(id_edificio, nombre_edificio, tipo_edificio, id_organizaciones, cod_ine_com) VALUES('$id_recibido ', '$nombre_recibido ',' $tipo_recibido','$org_recibida', '$comuna_recibida')";
    $resultado= mysqli_query($conexion, $sql);
}else{
    echo "Error, la organizacion o la comuna no son correctas, intente nuevamente";
    sleep(10);
}
?>