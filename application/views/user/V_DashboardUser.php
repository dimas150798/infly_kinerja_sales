<?php header('Access-Control-Allow-Origin: *');

$months = array(1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
} ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- full center -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Total Card -->
                    <div class="col-xxl-3 col-md-3">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Total Aktif <span>| <?php echo $months[(int)$bulan] ?></span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $Total ?></h6>
                                        <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Total Card -->

                    <!-- Kebonsari Card -->
                    <div class="col-xxl-3 col-md-3">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Kebonsari <span>| <?php echo $months[(int)$bulan] ?></span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $TotalKBS ?></h6>

                                        <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Kebonsari Card -->

                    <!-- Triwung Card -->
                    <div class="col-xxl-3 col-md-3">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Triwung <span>| <?php echo $months[(int)$bulan] ?></span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $TotalTRW ?></h6>
                                        <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Triwung Card -->

                    <!-- Aktif Card -->
                    <div class="col-xxl-3 col-md-3">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Terminasi <span>| <?php echo $months[(int)$bulan] ?></span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>0</h6>
                                        <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Aktif Card -->

                </div>
            </div>
            <!-- end full center -->

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Reports Sales -->
                    <div class="col-6">
                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Reports Sales Monthly <span>| <?php echo $months[(int)$bulan] ?></span></h5>

                                <!-- Line Chart -->
                                <canvas id="bar"></canvas>

                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports Sales -->

                    <!-- Top Selling -->
                    <div class="col-6">

                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Report Status <span>| <?php echo $months[(int)$bulan] ?></span></span></h5>

                                <canvas id="pie"></canvas>

                            </div>
                        </div><!-- End Website Traffic -->
                    </div>
                    <!-- End Top Selling -->

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Website Traffic -->
                <div class="card top-selling overflow-auto">

                    <div class="card-body pb-0 mb-3">
                        <h5 class="card-title">Top Sales <span>| <?php echo $months[(int)$bulan] ?></span></span></h5>

                        <table id="topSelling" class="table table-bordered responsive nowrap">
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

            </div><!-- End Right side columns -->

        </div>
    </section>

</main><!-- End #main -->

</html>