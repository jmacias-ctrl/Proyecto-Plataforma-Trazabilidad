<?php
require("connect.php");


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
        echo "<form action='edit.php?id_edificio=".$id_consultado."' method='POST'>";
            
            
            $consulta= "SELECT * FROM edificios WHERE id_edificio='".$id_consultado."';";
            $resultado= mysqli_query($conexion, $consulta);
            $row= mysqli_fetch_assoc($resultado);
            
                
                $nombre_consultado= $row["nombre_edificio"];
                $tipo_consultado= $row["tipo_edificio"];
                $org_consultada= $row["id_organizaciones"];
                $comuna_consultada= $row["cod_ine_com"];
                echo "<input type='text' name='nombre_edificio' value='".$nombre_consultado."'><br>";
                echo "<input type='text' name='tipo_edificio' value='".$tipo_consultado."'><br>";
                echo "<input type='text' name='id_organizaciones' value='".$org_consultada."'><br>";
                echo "<input type='text' name='cod_ine_com' value='".$comuna_consultada."'><br>";
                echo "<input type='submit' value='Save'><br>";
                                

            ?>
            
            
            
        </form>
       
        <footer>hola soy un footer</footer>
    </body>
</html>