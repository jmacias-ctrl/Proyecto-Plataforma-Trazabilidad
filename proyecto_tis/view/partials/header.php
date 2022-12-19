<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a href="prueba.php?p=inicio" style="width:40px" class="col-md-1 d-flex align-items-center justify-content-center mb-3 mb-md-0 mx-3 me-md-auto link-dark text-decoration-none">
      <img style="width:150px" class="img-fluid" src="view/public/images/heritech/logo/heritech_logo_white.png" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mx-5" id="navbarNavDarkDropdown" style="color:white">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestión
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="prueba.php?p=gestion_equipos_componentes\equipos\gestion_equipos">Equipos</a></li>
            <li><a class="dropdown-item" href="prueba.php?p=gestion_equipos_componentes\componentes\gestion_componentes_general">Componentes</a></li>
            <li><a class="dropdown-item" href="prueba.php?p=gestion_mantenciones/gestion_mantenciones">Mantenciones</a></li>
            <li><a class="dropdown-item" href="prueba.php?p=gestion_mantenedores/gestion_mantenedores">Mantenedores</a></li>
            <li><a class="dropdown-item" href="prueba.php?p=gestion_departamentos_edificios/gestion_edificios">Edificios y Departamentos</a></li>
            <li><a class="dropdown-item" href="prueba.php?p=gestion_funcionarios/gestion_funcionarios">Funcionarios</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Trazabilidad
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="prueba.php?p=reportes_equipos\graficos\main">Equipo</a></li>
            <li><a class="dropdown-item" href="prueba.php?p=gestion_equipos_componentes\componentes\trazabilidad_componentes">Componentes</a></li>
            <li><a class="dropdown-item" href="prueba.php?p=visualizar_equipos\1equipo">Visualizar equipos</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="cerrarse.php">
            <span class="material-symbols-outlined">login</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>