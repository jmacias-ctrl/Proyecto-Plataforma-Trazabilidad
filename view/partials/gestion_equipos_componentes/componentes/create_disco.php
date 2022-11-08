<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <?php session_start();?>
    
    <form class="needs-validation" action="post_create_componente.php" method="post">
        <div class="container-sm">
            <H1 class="mx-auto">AGREGAR COMPONENTE</H1>
            <div class="input-group mb-3">
                <span class="input-group-text">ID Equipo</span>
                <input type="text" aria-label="idEquipo" name="idEquipo" class="form-control" readonly value=<?php isset($_SESSION["id_equipo"]) ? print $_SESSION["id_equipo"] : ""; ?> >
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Nombre Componente</span>
                <input type="text" class="form-control" aria-label="nComponente" name="nComponente" readonly aria-describedby="inputGroup-sizing-default" value=<?php isset($_SESSION["nComponente"]) ? print str_replace(' ', '', $_SESSION["nComponente"]) : ""; ?> >
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Marca</span>
                <input type="text" class="form-control" aria-label="mComponente" name="mComponente" readonly aria-describedby="inputGroup-sizing-default" value=<?php isset($_SESSION["mComponente"]) ? print str_replace(' ', '', $_SESSION["mComponente"]) : ""; ?> >
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Modelo</span>
                <input type="text" class="form-control" aria-label="modComponente" name="modComponente" readonly aria-describedby="inputGroup-sizing-default" value=<?php isset($_SESSION["modComponente"]) ? print  str_replace(' ', '', $_SESSION["modComponente"]) : ""; ?>>
            </div>
            <select class="form-selec mb-3" aria-label="Tipo de Componente"readonly>
                <option selected>Disco Interno</option>
            </select>
            <div class="input-group mb-3">
                <span class="input-group-text">Capacidad</span>
                <input type="number" required aria-label="discoCapacidad" name="discoCapacidad" class="form-control">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Tipo Disco</span>
                <input type="number" required aria-label="idDisco" name="idDisco" class="form-control">
            </div>
                <input class="btn btn-outline-dark" type="submit" value="GUARDAR">
            </div>
    </form>
</body>
</html>