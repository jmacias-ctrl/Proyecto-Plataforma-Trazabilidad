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
    <form class="needs-validation" action="create_selection.php" method="post">
        <div class="container-sm">
            <H1 class="mx-auto">AGREGAR COMPONENTE</H1>
            <div class="input-group mb-3">
                <span class="input-group-text">ID Equipo</span>
                <input type="text" aria-label="idEquipo" name="idEquipo" class="form-control" required value=<?php isset($_GET["id_equipo"]) ? print $_GET["id_equipo"] : ""; ?> >
                <div class="invalid-feedback">
                    Por favor introduzca un ID para el equipo
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Nombre Componente</span>
                <input type="text" class="form-control" aria-label="nComponente" name="nComponente" aria-describedby="inputGroup-sizing-default" required>
                <div class="invalid-feedback">
                    Por favor introduzca el nombre para el componente.
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Marca</span>
                <input type="text" class="form-control" aria-label="mComponente" name="mComponente" aria-describedby="inputGroup-sizing-default" required>
                <div class="invalid-feedback">
                    Por favor introduzca la marca del componente
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Modelo</span>
                <input type="text" class="form-control" aria-label="modComponente" name="modComponente" aria-describedby="inputGroup-sizing-default" required>
                <div class="invalid-feedback">
                    Por favor introduzca el modelo del componente
                </div>
            </div>
            <select class="form-selec mb-3" required aria-label="Tipo de Componente" name="selectComponente">
                <option selected value="">Seleccionar tipo de componente</option>
                <option value="form2">Procesador</option>
                <option value="form3">Placa Base</option>
                <option value="form4">Memorias RAM</option>
                <option value="form5">Disco Interno</option>
                <option value="none">Otro</option>
                <input class="btn btn-outline-dark" type="submit" value="SIGUIENTE">
            </select>
        </div>
    </form>
</body>

</html>