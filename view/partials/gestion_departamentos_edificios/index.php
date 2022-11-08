<?php
//bd-user-pass-id
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
        <h1> formulario</h1>
        <br>
        <form action="insert.php" method="POST">
            <input type="text" name="id_edificio" placeholder= "id edificio"><br>
            <input type="text" name="nombre_edificio" placeholder= "nombre edificio"><br>
            <input type="text" name="tipo_edificio" placeholder= "tipo edificio"><br>
            <input type="int" name=" id_organizaciones" placeholder= "id organizacion"><br>
            <input type="int" name="cod_ine_com" placeholder= "codigo comuna"><br>
            <input type="submit" value= "Save"><br>
            
        </form>
        <table>
            <thead>
                <th>id edificio</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Organizacion</th>
                <th>Comuna</th>
            </thead>
            <tbody>
                
                    <?php
                    $consulta= "SELECT * FROM edificios";
                    $resultado= mysqli_query($conexion, $consulta);

                    while($row= mysqli_fetch_assoc($resultado)){
                        $id_consultado= $row["id_edificio"];
                        $nombre_consultado= $row["nombre_edificio"];
                        $tipo_consultado= $row["tipo_edificio"];
                        $org_consultada= $row["id_organizaciones"];
                        $comuna_consultada= $row["cod_ine_com"];
                        echo "<tr>";
                        echo "<td>" .$id_consultado. "</td>";
                        echo  "<td>" .$nombre_consultado. "</td>";
                        echo  "<td>" .$tipo_consultado. "</td>";
                        echo  "<td>" .$org_consultada. "</td>";
                        echo  "<td>" .$comuna_consultada. "</td>";
                        echo  "<td> <a href='delete.php?id=".$id_consultado."'>Eliminar </a></td>";
                        echo  "<td> <a href='edit-tab.php?id=".$id_consultado."'>Editar </a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tr>
            </tbody>
        </table>

        <form action="insert2.php" method="POST">
            <input type="text" name= "id_departamento" placeholder= "id departamento"><br>
            <input type="text" name= "id_edificio" placeholder= "id edificio"><br>
            <input type="text" name= "nombre_departamento" placeholder= "nombre departamento"><br>
            <input type="submit" value= "Save"><br>

        </form>
        <table>
            <thead>
                <th>id departamento</th>
                <th>id edificio</th>
                <th>Nombre</th>
            </thead>
            <tbody>
                
                    <?php
                    $consulta= "SELECT * FROM departamentos";
                    $resultado= mysqli_query($conexion, $consulta);

                    while($row= mysqli_fetch_assoc($resultado)){
                        $id_consultado= $row["id_departamento"];
                        $edificio_consultado= $row["id_edificio"];
                        $nombre_consultado= $row["nombre_departamento"];
                        echo "<tr>";
                        echo "<td>" .$id_consultado. "</td>";
                        echo  "<td>" .$edificio_consultado. "</td>";
                        echo  "<td>" .$nombre_consultado. "</td>";
                        echo  "<td> <a href='delete2.php?id_departamento=".$id_consultado."'>Eliminar </a></td>";
                        echo  "<td> <a href='edit-tab2.php?id=".$id_consultado."'>Editar </a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tr>
            </tbody>
        </table>

        <?php
        
        $consulta= "SELECT * FROM departamentos";
        $resultado= mysqli_query($conexion, $consulta);

        while($row= mysqli_fetch_assoc($resultado)){
            $id_consultado= $row["id_departamento"];
            $edificio_consultado= $row["id_edificio"];
            $nombre_consultado= $row["nombre_departamento"];
            echo "<h1>" .$id_consultado. ", " .$edificio_consultado. ", " .$nombre_consultado. "</h1>";
        }
        echo "<h1>dentro del body </h1>";
        ?>
    </body>
</html>