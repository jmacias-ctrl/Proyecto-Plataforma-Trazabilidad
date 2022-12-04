<div class="graph_container col-4">
    <?php
        //Estado del equipo
        $funcionando = 24;
        $bodega = 12;
        $malo = 6;

        //Cantidad de revisiones
        //array -> 0 cantRevisiones, cantEquipos

        $_SESSION['funcionando'] = $funcionando;
        $_SESSION['bodega'] = $bodega;
        $_SESSION['malo'] = $malo;

        require_once "view\partials\chart.php";

        $array = array("1", "4", "5", "2");

        // echo $array;

        echo "[";
        foreach ($array as $key => $element)
        {
            echo $element;
            if ($key < count($array) - 1)
            {
                echo ", ";
            }
        }
        echo "]";
    ?>
</div>