<?php
$anio_menor_1 = $_SESSION['anio_menor_1'];
$anio_mayor_1 = $_SESSION['anio_mayor_1'];
$anio_mayor_3 = $_SESSION['anio_mayor_3'];
?>

<div>
    <canvas id="myChart_1"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart_1');

    let data = {
        labels: [
            'x<=1 años',
            '1<x<3 años',
            'x>=3 años'
        ],
        datasets: [{
            label: 'Años:',

            <?php echo "data: [$anio_menor_1, $anio_mayor_1, $anio_mayor_3]," ?>

            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    let config = {
        type: 'bar',
        data: data,
    };

    new Chart(ctx, config)
</script>