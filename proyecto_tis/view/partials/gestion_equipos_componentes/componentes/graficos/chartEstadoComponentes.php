<?php
    $enUso = $_SESSION['enUso'];
    $enBodega = $_SESSION['enBodega'];
    $malEstado = $_SESSION['MalEstado'];
?>

<div>
    <canvas id="graficoEstadosComponentes"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctxEstadosComponentes = document.getElementById('graficoEstadosComponentes');

    let dataEstadosComponentes = {
        labels: [
            'En Uso',
            'En Bodega',
            'Mal Estado'
        ],
        datasets: [{
            label: 'Cantidad:',
            
            <?php echo "data: [$enUso, $enBodega, $malEstado]," ?>

            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    let configEstadosComponentes = {
        type: 'pie',
        data: dataEstadosComponentes,
    };

    new Chart(ctxEstadosComponentes, configEstadosComponentes)
</script>

