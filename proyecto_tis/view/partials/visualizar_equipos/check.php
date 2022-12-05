<?php
require("conexion.php");

$id_recibido= $_POST["ID_EQUIPO"];

$sql_e="SELECT * FROM equipos ";
$check_e= mysqli_query($conexion, $sql_e);

if(mysqli_num_rows($check_e)!=0){
    echo "true";
    while($row= mysqli_fetch_assoc($check_e)){
        $id_consultado= $row["ID_EQUIPO"];
        $departamento_consultado= $row["ID_DEPARTAMENTO"];
        $rut_consultado= $row["RUT_FUNCIONARIO"];
        $nombre_consultado= $row["NOMBRE_EQUIPO"];
        $fecha_consultada= $row["FECHA_ADQUISICION"];
        $costo_consultado= $row["COSTO_ADQUISICION"];
        $caracteristica_consultada= $row["CARACTERISTICAS_ADQUISICION"];
        $forma_consultada= $row["FORMA_ADQUISICION"];
        echo "<h1>" .$id_consultado.", ".$departamento_consultado.", ".$rut_consultado.",".$nombre_consultado.", 
        ".$fecha_consultada.", ".$costo_consultado.", ".$caracteristica_consultada.", ".$forma_consultada."</h1>";
    }
}else{
    echo "<p>Error, intente nuevamente</p>";
}

?>
<form action="1equipo.php" method="POST">
    <input type="submit" value= "Regresar"><br>
</form>