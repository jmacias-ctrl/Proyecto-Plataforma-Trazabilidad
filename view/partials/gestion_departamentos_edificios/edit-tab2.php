<?php
require('view\partials\gestion_departamentos_edificios\conexion.php');


?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title> database</title>
        <meta charset= "utf-8">
        <link rel="stylesheet" href="test1-2022.css">

    </head>
    <body>
        <h1> edit (departamento)</h1>
        <br>
        <?php
        $id_consultado= $_GET["id"];
        echo "<form action='prueba.php?p=gestion_departamentos_edificios/edit_dep&id=".$id_consultado."' method='POST'>";
            
            
            $consulta= "SELECT * FROM departamentos WHERE id_departamento='".$id_consultado."';";
            $resultado= mysqli_query($conexion, $consulta);
            $row= mysqli_fetch_assoc($resultado);
            
            
                
                $edificio_consultado= $row["ID_EDIFICIO"];
                $nombre_consultado= $row["NOMBRE_DEPARTAMENTO"];
                echo "<input type='text' name='id_edificio' value='".$edificio_consultado."'><br>";
                echo "<input type='text' name='nombre_departamento' value='".$nombre_consultado."'><br>";
                echo "<input type='submit' value='Save'><br>";
                                

            ?>
            
            
            
        </form>
    
    </body>
</html>