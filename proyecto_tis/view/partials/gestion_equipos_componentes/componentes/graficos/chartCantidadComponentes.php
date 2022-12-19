<?php
    $cRam = $_SESSION['cRam'];
    $cDiscos = $_SESSION['cDiscos'];
    $cPB = $_SESSION['cPB'];
    $cCPU = $_SESSION['cCPU'];
    $cOtros = $_SESSION['cOtros'];
?>

<div>
    <canvas id="graficosCantidadComponentes"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctxCantidadComponentes= document.getElementById('graficosCantidadComponentes');

    let dataCantidadComponentes = {
        labels: [
            'Memorias Ram',
            'Discos Internos',
            'CPU',
            'Placa Base',
            'Otros'
        ],
        datasets: [{
            label: 'Cantidad', 
            
            <?php echo "data: [$cRam, $cDiscos, $cCPU, $cPB, $cOtros]," ?>

            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(255, 151, 0)',
                'rgb(245, 140, 248)'
            ],
            hoverOffset: 5
        }]
    };

    let configCantidadComponentes = {
        type: 'bar',
        data: dataCantidadComponentes,
    };

    new Chart(ctxCantidadComponentes, configCantidadComponentes)
</script>

