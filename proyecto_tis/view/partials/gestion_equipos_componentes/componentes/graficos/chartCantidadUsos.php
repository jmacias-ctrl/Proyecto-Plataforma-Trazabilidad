<?php
    $uso_menor_5 = $_SESSION['uso_menor_5'];
    $uso_mayor_5 = $_SESSION['uso_mayor_5'];
    $uso_mayor_10 = $_SESSION['uso_mayor_10'];
?>

<div>
    <canvas id="graficoCantidadUsos"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctxCantidadUsos = document.getElementById('graficoCantidadUsos');

    let dataCantidadUsos = {
        labels: [
            'x>=5',
            '5<x<10',
            'x>=10'
        ],
        datasets: [{
            label: 'Cantidad Usos:',
            
            <?php echo "data: [$uso_menor_5, $uso_mayor_5, $uso_mayor_10]," ?>

            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    let configCantidadUsos = {
        type: 'bar',
        data: dataCantidadUsos,
    };

    new Chart(ctxCantidadUsos, configCantidadUsos)
</script>
