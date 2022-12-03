<?php
require('view\partials\gestion_equipos_componentes\conexion.php');
$q1 = "SELECT componentes.*, count(componentes.estado) FROM componentes LEFT JOIN equipos using(id_equipo) JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones=organizaciones.id)  
WHERE organizaciones.id =".$_SESSION["id_organizacion"]."
AND componentes.estado = 'en uso';";
$q2 = "SELECT componentes.*, count(componentes.estado) FROM componentes LEFT JOIN equipos using(id_equipo) JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones=organizaciones.id)  
WHERE organizaciones.id =".$_SESSION["id_organizacion"]."
AND componentes.estado = 'no en uso';";
$q3 = "SELECT componentes.*, count(componentes.estado) FROM componentes LEFT JOIN equipos using(id_equipo) JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones=organizaciones.id)  
WHERE organizaciones.id =".$_SESSION["id_organizacion"]."
AND componentes.estado = 'sin funcionamiento';";
$resultado = mysqli_query($conexion, $query);
?>

<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <div class="container-sm align-items-center">
        <h1 class="my-3">Trazabilidad de Componentes</h1>
        <div class="container-sm d-flex align-items-center border border-primary-2 rounded py-3">
            <div class="container aling-self-center">
                <div class="container-sm d-flex align-items-center border border-primary-2 rounded py-3">
                    <div class="container aling-self-center">
                        <div class="row"></div>
                        <div class="row row-cols-auto d-flex align-items-center">
                            <div class="col">
                            </div>
                            <div class="col-8">
                            </div>
                            <div class="col">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-xl d-flex flex-column border border-primary rounded">
                    <div class="align-self-center">
                        <h4 class="my-4 ">Listado de Componentes</h4>
                    </div>

                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>