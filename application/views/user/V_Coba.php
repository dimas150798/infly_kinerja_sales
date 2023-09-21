<?php header('Access-Control-Allow-Origin: *');

$months = array(1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <canvas id="line" height="100"></canvas>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-8">
                <canvas id="bar"></canvas>
            </div>
            <div class="col-4">
                <canvas id="pie"></canvas>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script>
        const baseUrl = "<?php echo base_url(); ?>"
        const myChart = (chartType) => {
            $.ajax({
                url: baseUrl + 'user/C_DashboardUser/chart_data',
                dataType: 'json',
                method: 'get',
                success: data => {
                    let chartV = []
                    let chartX = []
                    let chartY = []
                    data.map(data => {
                        chartV.push(data.bulan_perolehan)
                        chartX.push(data.bulan_perolehan)
                        chartY.push(data.jumlah_perolehan)
                    })
                    const chartData = {
                        labels: chartX,
                        datasets: [{
                            label: 'Sales',
                            data: chartY,
                            chartV,
                            backgroundColor: ['lightcoral'],
                            borderColor: ['lightcoral'],
                            borderWidth: 4
                        }]
                    }
                    const ctx = document.getElementById(chartType).getContext('2d')
                    const config = {
                        type: chartType,
                        data: chartData
                    }
                    switch (chartType) {
                        case 'pie':
                            const pieColor = ['salmon', 'red', 'green', 'blue', 'aliceblue', 'pink', 'orange', 'gold', 'plum', 'darkcyan', 'wheat', 'silver']
                            chartData.datasets[0].backgroundColor = pieColor
                            chartData.datasets[0].borderColor = pieColor
                            break;
                        case 'bar':
                            chartData.datasets[0].backgroundColor = ['skyblue']
                            chartData.datasets[0].borderColor = ['skyblue']
                            break;
                        default:
                            config.options = {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                    }
                    const chart = new Chart(ctx, config)
                }
            })
        }

        myChart('pie')
        myChart('line')
        myChart('bar')
    </script>
</body>

</html>