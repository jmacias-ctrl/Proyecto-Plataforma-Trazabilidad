<?php
//bd-user-pass-id
require('view\partials\gestion_equipos_componentes\conexion.php');
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
        <form action="prueba.php?p=gestion_departamentos_edificios/insert" method="POST">
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
                        $id_consultado= $row["ID_EDIFICIO"];
                        $nombre_consultado= $row["NOMBRE_EDIFICIO"];
                        $tipo_consultado= $row["TIPO_EDIFICIO"];
                        $org_consultada= $row["ID_ORGANIZACIONES"];
                        $comuna_consultada= $row["COD_INE_COM"];
                        echo "<tr>";
                        echo "<td>" .$id_consultado. "</td>";
                        echo  "<td>" .$nombre_consultado. "</td>";
                        echo  "<td>" .$tipo_consultado. "</td>";
                        echo  "<td>" .$org_consultada. "</td>";
                        echo  "<td>" .$comuna_consultada. "</td>";
                        echo  "<td> <a href='prueba.php?p=gestion_departamentos_edificios/delete&id=".$id_consultado."'>Eliminar </a></td>";
                        echo  "<td> <a href='prueba.php?p=gestion_departamentos_edificios/edit-tab&id=".$id_consultado."'>Editar </a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tr>
            </tbody>
        </table>

        <form action="prueba.php?p=gestion_departamentos_edificios/insert2" method="POST">
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
                        $id_consultado= $row["ID_DEPARTAMENTO"];
                        $edificio_consultado= $row["ID_EDIFICIO"];
                        $nombre_consultado= $row["NOMBRE_DEPARTAMENTO"];
                        echo "<tr>";
                        echo "<td>" .$id_consultado. "</td>";
                        echo  "<td>" .$edificio_consultado. "</td>";
                        echo  "<td>" .$nombre_consultado. "</td>";
                        echo  "<td> <a href='prueba.php?p=gestion_departamentos_edificios/delete2&id_departamento=".$id_consultado."'>Eliminar </a></td>";
                        echo  "<td> <a href='prueba.php?p=gestion_departamentos_edificios/edit-tab2&id=".$id_consultado."'>Editar </a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tr>
            </tbody>
        </table>

        <?php
        
        $consulta= "SELECT * FROM departamentos";
        $resultado= mysqli_query($conexion, $consulta);
        ?>
    </body>
</html>