<!-- Vendor JS Files -->
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js">
    </script> -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js">
</script>


<script src="<?php echo base_url(); ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/chart.js/chart.umd.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/echarts/echarts.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/quill/quill.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/tinymce/tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/php-email-form/validate.js"></script>

<!-- JS dataTables -->

<!-- Template Main JS File -->
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>

<script>
    const baseUrl = "<?php echo base_url(); ?>"
    const myChart = (chartType) => {
        $.ajax({
            url: baseUrl + 'user/C_DashboardUser/reports_sales',
            dataType: 'json',
            method: 'get',
            success: data => {
                let chartX = []
                let chartY = []
                data.map(data => {
                    chartX.push(data.bulan_perolehan)
                    chartY.push(data.jumlah_perolehan)
                })
                const chartData = {
                    labels: chartX,
                    datasets: [{
                        label: 'Perolehan',
                        data: chartY,
                        backgroundColor: ['#03C988'],
                        borderColor: ['#03C988'],
                        borderWidth: 4
                    }]
                }
                const ctx = document.getElementById(chartType).getContext('2d')
                const config = {
                    type: chartType,
                    data: chartData
                }

                const chart = new Chart(ctx, config)
            }
        })
    }

    myChart('bar')
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
                    chartA.push(data.keterangan)
                    chartB.push(data.jumlah)
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
                            }
                        }
                }
                const chart = new Chart(ctxStatus, configStatus)
            }
        })
    }
    myChartstatus('pie')
</script>

<!-- Ajax Show Data Akun -->
<script>
    $(document).ready(function() {
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
                if (dataIndex == 0) {
                    $('td', row).addClass('green');
                }
                if (dataIndex == 1) {
                    $('td', row).addClass('blue');
                }
                if (dataIndex == 2) {
                    $('td', row).addClass('yellow');
                }
            }
        });


        setInterval(function() {
            table.ajax.reload(null, false);
        }, 1000);
    });
</script>

<script>
    setTimeout(function() {
        window.location.reload(1);
    }, 60000);
</script>
</body>