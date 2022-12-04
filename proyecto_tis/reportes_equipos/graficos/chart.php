<?php
    $funcionando = $_SESSION['funcionando'];
    $bodega = $_SESSION['bodega'];
    $malo = $_SESSION['malo'];
?>

<div>
    <canvas id="myChart"></canvas>
</div>

<div>
    <canvas id="myChart_2"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');
    const ctx2 = document.getElementById('myChart_2');

    let data2 = {
        labels: [
            'Funcionando',
            'En bodega',
            'Malo'
        ],
        datasets: [{
            label: 'Cantidad:',
            
            <?php echo "data: [$funcionando, $bodega, $malo]," ?>
            //data: [300, 50, 100],

            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    let config2 = {
        type: 'pie',
        data: data2,
    };

    new Chart(ctx2, config2)

    //NEW

    let data = {
        labels: [
            'Funcionando',
            'En bodega',
            'Malo'
        ],
        datasets: [{
            label: 'Cantidad:',
            
            <?php echo "data: [$funcionando, $bodega, $malo]," ?>
            //data: [300, 50, 100],

            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    let config = {
        type: 'bar', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
        data: data,
    };

    new Chart(ctx, config);

</script>

<button class="btn btn-outline-primary" onclick="createChart()">GENERAR GRAFICO</button>