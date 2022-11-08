<?php include('iniciar.php'); ?>
<?php include('header.php'); ?>
<?php //logica para capturar la pagina que queremos abrir
$pagina = isset($_GET['p']) ? strtolower($_GET['p']) : 'inicio';

$isInAppMode = false;

// require_once "view/partials/header.php";
// require_once "view/partials/" . $pagina . '.php';
// require_once "view/partials/footer.php";

if ($isInAppMode) {
    // require_once "view\partials\modules\sidebar\index.php";
    require "view\partials\modules\sidebar\index.php";
    require "view\partials\modules\page_container\up.php";
    if(isset($_GET['id'])){
        require_once "view/partials/" . $pagina . '.php?id_departamento='.$_GET['id'];
    }else if(isset($_GET['id_departamento'])){
        require_once "view/partials/" . $pagina . '.php?id_departamento='.$_GET['id_departamento'];
    }else{
        require_once "view/partials/" . $pagina . '.php';
    }
    require "view\partials\modules\page_container\down.php";
    require_once "view/partials/footer.php";
} else {
    require_once "view/partials/header.php";
    require_once "view/partials/" . $pagina . '.php';
    require_once "view/partials/footer.php";
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="view/public/js/main.js"></script>