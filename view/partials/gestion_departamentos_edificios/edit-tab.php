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
        <h1> edit (edificio)</h1>
        <br>
        <?php
        $id_consultado= $_GET["id"];
        echo "<form action='prueba.php?p=gestion_departamentos_edificios/edit&id_edificio=".$id_consultado."' method='POST'>";
            
            
            $consulta= "SELECT * FROM edificios WHERE id_edificio='".$id_consultado."';";
            $resultado= mysqli_query($conexion, $consulta);
            $row= mysqli_fetch_assoc($resultado);
            
                
                $nombre_consultado= $row["NOMBRE_EDIFICIO"];
                $tipo_consultado= $row["TIPO_EDIFICIO"];
                $org_consultada= $row["ID_ORGANIZACIONES"];
                $comuna_consultada= $row["COD_INE_COM"];
                echo "<input type='text' name='nombre_edificio' value='".$nombre_consultado."'><br>";
                echo "<input type='text' name='tipo_edificio' value='".$tipo_consultado."'><br>";
                echo "<input type='text' name='id_organizaciones' value='".$org_consultada."'><br>";
                echo "<input type='text' name='cod_ine_com' value='".$comuna_consultada."'><br>";
                echo "<input type='submit' value='Save'><br>";
                                

            ?>
            
            
            
        </form>
    </body>
</html>