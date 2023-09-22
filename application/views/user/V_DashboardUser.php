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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kinerja Sales</title>
    <!-- Favicons -->
    <link href="<?php echo base_url(); ?>assets/img/inflynetworks_LogoOnly.png" rel="icon">
    <link href="<?php echo base_url(); ?>assets/img/inflynetworks_LogoOnly.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Mengimpor Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link href="<?php echo base_url(); ?>assets/css/style_new.css" rel="stylesheet">

</head>

<body>
    <div class="container mt-4">
        <div class="row">

            <!-- Card 1 -->
            <div class="col-12 col-md-4 col-lg-4 col-xl-4 mb-3">
                <div class="card info-card sales-card card-1">

                    <div class="card-body">
                        <h4 class="card-title">Informasi Penjualan <span>| <?php echo $months[(int)$bulanNow] ?></span></h4>

                        <!-- Card 1 - Aktif -->
                        <div class="info-item mt-3">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <?php
                                    $changeAktif = $JumlahAktif - $OneMonthAgo_Aktif;
                                    $percentageChangeAktif = ($changeAktif / $OneMonthAgo_Aktif) * 100;

                                    if ($changeAktif < 0) {
                                        echo '<i class="bi bi-arrow-down"></i>';
                                    } elseif ($changeAktif > 0) {
                                        echo '<i class="bi bi-arrow-up"></i>';
                                    } else {
                                        echo '<i class="bi bi-arrow-right"></i>';
                                    }
                                    ?>
                                </div>
                                <div class="ps-3">
                                    <h5>Total Aktif</h5>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h1><?php echo $JumlahAktif ?></h1>
                                        </div>
                                        <?php
                                        $changeAktif = $JumlahAktif - $OneMonthAgo_Aktif;
                                        $percentageChangeAktif = ($changeAktif / $OneMonthAgo_Aktif) * 100;

                                        if ($changeAktif < 0) {
                                            echo '<div class="text-white ms-3"><strong>' . number_format(abs($percentageChangeAktif), 2) . '% Penurunan</strong></div>';
                                        } elseif ($changeAktif > 0) {
                                            echo '<div class="text-success ms-3"><strong>' . number_format($percentageChangeAktif, 2) . '% Kenaikan</strong></div>';
                                        } else {
                                            echo '<div class="text-info ms-3"><strong>Tidak Berubah</strong></div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 - Kebonsari -->
                        <div class="info-item mt-3">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <?php
                                    $changeKBS = $JumlahKBS - $OneMonthAgo_KBS;
                                    $percentageChangeKBS = ($changeKBS / $OneMonthAgo_KBS) * 100;

                                    if ($changeKBS < 0) {
                                        echo '<i class="bi bi-arrow-down"></i>';
                                    } elseif ($changeKBS > 0) {
                                        echo '<i class="bi bi-arrow-up"></i>';
                                    } else {
                                        echo '<i class="bi bi-arrow-right"></i>';
                                    }
                                    ?>
                                </div>
                                <div class="ps-3">
                                    <h5>Kebonsari</h5>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h1><?php echo $JumlahKBS ?></h1>
                                        </div>
                                        <?php
                                        $changeKBS = $JumlahKBS - $OneMonthAgo_KBS;
                                        $percentageChangeKBS = ($changeKBS / $OneMonthAgo_KBS) * 100;

                                        if ($changeKBS < 0) {
                                            echo '<div class="text-white ms-3"><strong>' . number_format(abs($percentageChangeKBS), 2) . '% Penurunan</strong></div>';
                                        } elseif ($changeKBS > 0) {
                                            echo '<div class="text-success ms-3"><strong>' . number_format($percentageChangeKBS, 2) . '% Kenaikan</strong></div>';
                                        } else {
                                            echo '<div class="text-info ms-3"><strong>Tidak Berubah</strong></div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Card 3 - Triwung -->
                        <div class="info-item mt-3">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <?php
                                    $changeTRW = $JumlahTRW - $OneMonthAgo_TRW;
                                    $percentageChangeTRW = ($changeTRW / $OneMonthAgo_TRW) * 100;

                                    if ($changeTRW < 0) {
                                        echo '<i class="bi bi-arrow-down"></i>';
                                    } elseif ($changeTRW > 0) {
                                        echo '<i class="bi bi-arrow-up"></i>';
                                    } else {
                                        echo '<i class="bi bi-arrow-right"></i>';
                                    }
                                    ?>
                                </div>
                                <div class="ps-3">
                                    <h5>Triwung</h5>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h1><?php echo $JumlahTRW ?></h1>
                                        </div>
                                        <?php
                                        $changeTRW = $JumlahTRW - $OneMonthAgo_TRW;
                                        $percentageChangeTRW = ($changeTRW / $OneMonthAgo_TRW) * 100;

                                        if ($changeTRW < 0) {
                                            echo '<div class="text-white ms-3"><strong>' . number_format(abs($percentageChangeTRW), 2) . '% Penurunan</strong></div>';
                                        } elseif ($changeTRW > 0) {
                                            echo '<div class="text-success ms-3"><strong>' . number_format($percentageChangeTRW, 2) . '% Kenaikan</strong></div>';
                                        } else {
                                            echo '<div class="text-info ms-3"><strong>Tidak Berubah</strong></div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 - Terminasi -->
                        <div class="info-item mt-3">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>Terminasi</h6>
                                    <h1>0</h1>
                                    <!-- Masukkan logika perubahan persentase di sini -->
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-12 col-md-8 col-lg-8 col-xl-8 mb-3">
                <div class="card info-card card-4 h-100">
                    <div class="card-body">
                        <h5 class="card-title">Top Sales <span>| <?php echo $months[(int)$bulanNow] ?></span></h5>

                        <div class="table-responsive">
                            <table id="topSelling" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Sales</th>
                                        <th class="text-center">Total Aktif</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-3">
                <div class="card info-card card-4 h-100">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Status <span>| <?php echo $months[(int)$bulanNow] ?></span></h5>
                        <div class="d-flex align-items-center">
                            <!-- Line Chart -->
                            <canvas id="pie" style="max-width: 500%; height: 500px;"></canvas>
                            <!-- End Line Chart -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-6 col-xl-6 mt-3">
                <div class="card info-card card-4 h-100">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Perbulan <span>| <?php echo $months[(int)$bulanNow] ?></span></h5>
                        <div class="d-flex align-items-center">
                            <!-- Line Chart -->
                            <canvas id="bar" style="max-width: 500%; height: 500px;"></canvas>
                            <!-- End Line Chart -->
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


    </div>

    <!-- Mengimpor Bootstrap JavaScript (Opsional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

    <!-- Chart -->
    <script src="<?php echo base_url(); ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/chart.js/chart.umd.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/quill/quill.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/php-email-form/validate.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        const baseUrl = "<?php echo base_url(); ?>";

        const myChart = (chartType) => {
            $.ajax({
                url: baseUrl + 'user/C_DashboardUser/reports_sales',
                dataType: 'json',
                method: 'get',
                success: (response) => {
                    if (response.length === 0) {
                        console.error("Data tidak ditemukan.");
                        return;
                    }

                    const chartX = [];
                    const chartY = [];

                    response.forEach(item => {
                        chartX.push(item.nama_bulan);
                        chartY.push(item.jumlah_perolehan);
                    });

                    const chartData = {
                        labels: chartX,
                        datasets: [{
                            label: 'Perolehan',
                            data: chartY,
                            backgroundColor: ['#03C988'],
                            borderColor: ['#03C988'],
                            borderWidth: 4
                        }]
                    };

                    const ctx = document.getElementById(chartType);

                    if (!ctx) {
                        console.error(`Elemen dengan ID '${chartType}' tidak ditemukan.`);
                        return;
                    }

                    const config = {
                        type: chartType,
                        data: chartData
                    };

                    const chart = new Chart(ctx, config);
                },
                error: (xhr, status, error) => {
                    console.error(`Terjadi kesalahan: ${error}`);
                }
            });
        };

        myChart('bar');
    </script>

    <script>
        const baseUrlStatus = "<?php echo base_url(); ?>"
        const myChartstatus = (chartTypeStatus) => {
            $.ajax({
                url: baseUrlStatus + 'user/C_DashboardUser/reports_status',
                dataType: 'json',
                method: 'get',
                success: data => {
                    let chartA = []
                    let chartB = []
                    data.map(data => {
                        chartA.push(data.status_customer)
                        chartB.push(data.jumlah_customer)
                    })
                    const chartDataStatus = {
                        labels: chartA,
                        datasets: [{
                            label: 'Perolehan',
                            data: chartB,
                            backgroundColor: ['#03C988'],
                            borderColor: ['#03C988'],
                            borderWidth: 4
                        }]
                    }
                    const ctxStatus = document.getElementById(chartTypeStatus).getContext('2d')
                    const configStatus = {
                        type: chartTypeStatus,
                        data: chartDataStatus
                    }
                    switch (chartTypeStatus) {
                        case 'pie':
                            const pieColorStatus = ['#03C988', '#FF6969', '#F6FA70', '#E4A5FF', '#FFB84C']
                            chartDataStatus.datasets[0].backgroundColor = pieColorStatus
                            chartDataStatus.datasets[0].borderColor = pieColorStatus
                            break;
                        default:
                            configStatus.options = {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                responsive: true, // Menjadikan grafik responsif
                                maintainAspectRatio: false // Menghilangkan rasio aspek default
                            }
                    }

                    // Mengatur lebar dan tinggi canvas
                    const canvasStatus = document.getElementById(chartTypeStatus);
                    canvasStatus.width = 300; // Atur sesuai kebutuhan Anda
                    canvasStatus.height = 200; // Atur sesuai kebutuhan Anda

                    const chart = new Chart(ctxStatus, configStatus)
                }
            })
        }
        myChartstatus('pie')
    </script>

    <!-- Ajax Show Data Akun -->
    <script>
        var table = $('#topSelling').DataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "lengthChange": false,
            "paging": false,
            "searching": false,
            "ajax": {
                "url": "<?= base_url('user/C_DashboardUser/getTopSelling'); ?>",
            },
            "createdRow": function(row, data, dataIndex) {
                // Tambahkan kelas CSS sesuai dengan indeks data
                if (dataIndex == 0) {
                    $('td', row).addClass('green');
                    $('td:eq(0)', row).html('<div class="text-center"><i class="bi bi-star-fill text-warning"></i> 1 </div>');
                } else if (dataIndex == 1) {
                    $('td', row).addClass('blue');
                    $('td:eq(0)', row).html('<div class="text-center"><i class="bi bi-star-fill text-warning"></i> 2 </div>');
                } else if (dataIndex == 2) {
                    $('td', row).addClass('yellow');
                    $('td:eq(0)', row).html('<div class="text-center"><i class="bi bi-star-fill text-warning"></i> 3 </div>');
                }
            }

        });

        setInterval(function() {
            table.ajax.reload(null, false);
        }, 1000);
    </script>

    <script>
        setTimeout(function() {
            window.location.reload(1);
        }, 60000);
    </script>
</body>

</html>