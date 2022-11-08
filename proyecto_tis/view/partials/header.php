<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- dark light -->
  <div class="container-fluid">
    <a href="index.php" class="col-md-1 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <img style="width:150px" class="img-fluid" src="view/public/images/heritech/ht_logo.png" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestion de Equipos
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="prueba.php?p=gestion_equipos_componentes\equipos\create_equipo">Ingresar equipo</a>
            </li>
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="prueba.php?p=gestion_equipos_componentes\equipos\modify_equipo_1">Modificar Equipo</a>
            </li>
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="prueba.php?p=gestion_equipos_componentes\equipos\delete_equipo">Eliminar Equipo</a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestion de Componentes
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="view\partials\gestion_equipos_componentes\componentes\create_componente.php">Ingresar equipo</a>
            </li>
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="gestion_equipos_componentes\equipos/modify_equipo_1">Modificar Equipo</a>
            </li>
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="prueba.php?p=gestion_equipos_componentes\componentes\delete_componente">Eliminar Equipo</a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestion de Edificios y Departamentos
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="prueba.php?p=gestion_departamentos_edificios\index">Gestion de Departamentos y Edificios</a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestion de Mantenedores
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="prueba.php?p=">Insertar funcionario</a>
            </li>
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="prueba.php?p=">Modificar funcionario</a>
            </li>
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="prueba.php?p=">Eliminar funcionario</a>
            </li>
          </ul>
        </li>  
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestion de Manteciones
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="prueba.php?p=gestion_mantenciones\C/create_mantenciones_form">Insertar mantenciones</a>
            </li>
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="prueba.php?p=gestion_mantenciones\U/update_mantenciones">Modificar mantenciones</a>
            </li>
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="prueba.php?p=gestion_mantenciones\D/delete_mantenciones">Eliminar mantenciones</a>
            </li>
          </ul>
        </li>   
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestion de Funcionarios
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="prueba.php?p=gestion_funcionarios\C/create_funcionarios_form">Insertar Mantenedor</a>
            </li>
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="prueba.php?p=gestion_funcionarios\U/update_funcionarios_form">Modificar Mantenedor</a>
            </li>
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="prueba.php?p=gestion_funcionarios\D/delete_funcionarios_form">Eliminar Mantenedor</a>
            </li>
          </ul>
        </li>  
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="cerrarse.php">
            <span class="material-symbols-outlined">login</span>
          </a>
        </li>

       
</nav>