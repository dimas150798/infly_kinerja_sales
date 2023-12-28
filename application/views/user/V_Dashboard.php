<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- Chart -->

            <div class="row match-height">
                <div class="col-12">
                    <div class="">
                        <div id="gradient-line-chart1" class="height-250 GradientlineShadow1"></div>
                    </div>
                </div>
            </div>


            <!-- Statistics -->
            <div class="row match-height">
                <!-- Informasi Penjualan -->
                <div class="col-xl-6 col-lg-6">
                    <div class="informasi-card">

                        <div class="informasi-header">
                            <div class="row">
                                <div class="col-xl-7 col-lg-7">
                                    <h1 class="informasi-title">INFORMASI PENJUALAN</h1>
                                </div>
                                <div class="col-xl-5 col-lg-5">
                                    <h4 class="informasi-title" id="heading-multiple-thumbnails">(<?php echo $DateNow ?>)</h4>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="Informasi Penjualan"> -->
                        <div class="informasi-body">
                            <!-- Total Aktif -->
                            <div class="row">
                                <div class="informasi">
                                    <div class="col-xl-4 col-lg-4 col-4">
                                        <div class="informasi-icon">
                                            <?php
                                            $Total = $TotalPelangganAll_Now - $TotalPelangganAll_Before;
                                            $Total_Persentase = ($Total / $TotalPelangganAll_Before) * 100;

                                            if ($Total < 0) {
                                                echo '<img class="icon-card" src="' . base_url() . 'assets/img/informasi/jempol_turun.png" alt="icon-card">';
                                            } elseif ($Total > 0) {
                                                echo '<img class="icon-card" src="' . base_url() . 'assets/img/informasi/jempol_naik.png" alt="icon-card">';
                                            } else {
                                                echo '<img class="icon-card" src="' . base_url() . 'assets/img/informasi/jempol_turun.png" alt="icon-card">';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-xl-8 col-lg-8 col-8">
                                        <h3>Total Aktif</h3>

                                        <div class="informasi-persentase">
                                            <h1>
                                                <?php echo $TotalPelangganAll_Now ?>
                                            </h1>

                                            <?php
                                            $Total = $TotalPelangganAll_Now - $TotalPelangganAll_Before;
                                            $Total_Persentase = ($Total / $TotalPelangganAll_Before) * 100;

                                            if ($Total < 0) {
                                                echo '<div class="total-persentase"><strong>' . number_format($Total_Persentase, 2) . '% Turun</strong></div>';
                                            } elseif ($Total > 0) {
                                                echo '<div class="total-persentase"><strong>' . number_format($Total_Persentase, 2) . '% Naik</strong></div>';
                                            } else {
                                                echo '<div class="total-persentase"><strong>' . number_format($Total_Persentase, 2) . '% Stabil</strong></div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Kebonsari -->
                            <div class="row">
                                <div class="informasi">
                                    <div class="col-xl-4 col-lg-4 col-4">
                                        <div class="informasi-icon">
                                            <?php
                                            $Total = $TotalPelangganKBS_Now - $TotalPelangganKBS_Before;
                                            $Total_Persentase = ($Total / $TotalPelangganKBS_Before) * 100;

                                            if ($Total < 0) {
                                                echo '<img class="icon-card" src="' . base_url() . 'assets/img/informasi/jempol_turun.png" alt="icon-card">';
                                            } elseif ($Total > 0) {
                                                echo '<img class="icon-card" src="' . base_url() . 'assets/img/informasi/jempol_naik.png" alt="icon-card">';
                                            } else {
                                                echo '<img class="icon-card" src="' . base_url() . 'assets/img/informasi/jempol_turun.png" alt="icon-card">';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-xl-8 col-lg-8 col-8">
                                        <h3>Total Kebonsari</h3>

                                        <div class="informasi-persentase">
                                            <h1>
                                                <?php echo $TotalPelangganKBS_Now ?>
                                            </h1>

                                            <?php
                                            $Total = $TotalPelangganKBS_Now - $TotalPelangganKBS_Before;
                                            $Total_Persentase = ($Total / $TotalPelangganKBS_Before) * 100;

                                            if ($Total < 0) {
                                                echo '<div class="total-persentase"><strong>' . number_format($Total_Persentase, 2) . '% Turun</strong></div>';
                                            } elseif ($Total > 0) {
                                                echo '<div class="total-persentase"><strong>' . number_format($Total_Persentase, 2) . '% Naik</strong></div>';
                                            } else {
                                                echo '<div class="total-persentase"><strong>' . number_format($Total_Persentase, 2) . '% Stabil</strong></div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Triwung -->
                            <div class="row">
                                <div class="informasi">
                                    <div class="col-xl-4 col-lg-4 col-4">
                                        <div class="informasi-icon">
                                            <?php
                                            $Total = $TotalPelangganTRW_Now - $TotalPelangganTRW_Before;
                                            $Total_Persentase = ($Total / $TotalPelangganTRW_Before) * 100;

                                            if ($Total < 0) {
                                                echo '<img class="icon-card" src="' . base_url() . 'assets/img/informasi/jempol_turun.png" alt="icon-card">';
                                            } elseif ($Total > 0) {
                                                echo '<img class="icon-card" src="' . base_url() . 'assets/img/informasi/jempol_naik.png" alt="icon-card">';
                                            } else {
                                                echo '<img class="icon-card" src="' . base_url() . 'assets/img/informasi/jempol_turun.png" alt="icon-card">';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-xl-8 col-lg-8 col-8">
                                        <h3>Total Triwung</h3>

                                        <div class="informasi-persentase">
                                            <h1>
                                                <?php echo $TotalPelangganTRW_Now ?>
                                            </h1>

                                            <?php
                                            $Total = $TotalPelangganTRW_Now - $TotalPelangganTRW_Before;
                                            $Total_Persentase = ($Total / $TotalPelangganTRW_Before) * 100;

                                            if ($Total < 0) {
                                                echo '<div class="total-persentase"><strong>' . number_format($Total_Persentase, 2) . '% Turun</strong></div>';
                                            } elseif ($Total > 0) {
                                                echo '<div class="total-persentase"><strong>' . number_format($Total_Persentase, 2) . '% Naik</strong></div>';
                                            } else {
                                                echo '<div class="total-persentase"><strong>' . number_format($Total_Persentase, 2) . '% Stabil</strong></div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Kanigaran -->
                            <div class="row">
                                <div class="informasi">
                                    <div class="col-xl-4 col-lg-4 col-4">
                                        <div class="informasi-icon">
                                            <?php
                                            $Total = $TotalPelangganKNG_Now - $TotalPelangganKNG_Before;
                                            $Total_Persentase = ($Total / $TotalPelangganKNG_Before) * 100;

                                            if ($Total < 0) {
                                                echo '<img class="icon-card" src="' . base_url() . 'assets/img/informasi/jempol_turun.png" alt="icon-card">';
                                            } elseif ($Total > 0) {
                                                echo '<img class="icon-card" src="' . base_url() . 'assets/img/informasi/jempol_naik.png" alt="icon-card">';
                                            } else {
                                                echo '<img class="icon-card" src="' . base_url() . 'assets/img/informasi/jempol_turun.png" alt="icon-card">';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-xl-8 col-lg-8 col-8">
                                        <h3>Total Kanigaran</h3>

                                        <div class="informasi-persentase">
                                            <h1>
                                                <?php echo $TotalPelangganKNG_Now ?>
                                            </h1>

                                            <?php
                                            $Total = $TotalPelangganKNG_Now - $TotalPelangganKNG_Before;
                                            $Total_Persentase = ($Total / $TotalPelangganKNG_Before) * 100;

                                            if ($Total < 0) {
                                                echo '<div class="total-persentase"><strong>' . number_format($Total_Persentase, 2) . '% Turun</strong></div>';
                                            } elseif ($Total > 0) {
                                                echo '<div class="total-persentase"><strong>' . number_format($Total_Persentase, 2) . '% Naik</strong></div>';
                                            } else {
                                                echo '<div class="total-persentase"><strong>' . number_format($Total_Persentase, 2) . '% Stabil</strong></div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>

                <!-- Top Sales -->
                <div class="col-xl-6 col-lg-6">
                    <div class="topsales-card">

                        <div class="informasi-header">
                            <div class="row">
                                <div class="col-xl-7 col-lg-7">
                                    <h4 class="informasi-title" id="heading-multiple-thumbnails">TOP SALES</h4>
                                </div>
                                <div class="col-xl-5 col-lg-5">
                                    <h4 class="informasi-title" id="heading-multiple-thumbnails">(<?php echo $DateNow ?>)</h4>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="Informasi Penjualan"> -->
                        <div class="informasi-body">
                            <!-- Total Aktif -->
                            <div class="row">
                                <div class="topsales-informasi">
                                    <div class="rank-list">
                                        <?php foreach ($PerolehanSales as $key => $value) : ?>
                                            <div class="rank-item <?php if ($key + 1 <= 3) echo 'first-three'; ?><?php if ($key + 1 > 3) echo 'rank-four-and-below'; ?>">

                                                <div class="username-container">
                                                    <span class="username"><?= $value['nama_sales']; ?></span>
                                                    <span class="jumlah"><i class="bi bi-person-check-fill"> </i> Perolehan Aktif = <?= $value['perolehan_sales_aktif']; ?></span>
                                                    <span class="jumlah"><i class="bi bi-wifi-off"></i> Perolehan Terminasi = <?php
                                                                                                                                if ($value['perolehan_sales_terminasi'] == NULL) {
                                                                                                                                    echo '0';
                                                                                                                                } else {
                                                                                                                                    echo $value['perolehan_sales_terminasi'];
                                                                                                                                }  ?></span>
                                                    <span class="jumlah"><i class="bi bi-wifi-off"></i> 6 Bulan (-) = <?php
                                                                                                                        if ($value['perolehan_sales_terminasi_6Month_Minus'] == NULL) {
                                                                                                                            echo '0';
                                                                                                                        } else {
                                                                                                                            echo $value['perolehan_sales_terminasi_6Month_Minus'];
                                                                                                                        }  ?></span>
                                                    <span class="jumlah"><i class="bi bi-wifi-off"></i> 6 Bulan (+) = <?php
                                                                                                                        if ($value['perolehan_sales_terminasi_6Month_Plus'] == NULL) {
                                                                                                                            echo '0';
                                                                                                                        } else {
                                                                                                                            echo $value['perolehan_sales_terminasi_6Month_Plus'];
                                                                                                                        }  ?></span>
                                                </div>

                                                <?php if ($key + 1 == 1) : ?>
                                                    <img class="medal" src="<?php echo base_url(); ?>assets/img/medali/thropy_01.png" alt="Medal">
                                                <?php elseif ($key + 1 == 2) : ?>
                                                    <img class="medal" src="<?php echo base_url(); ?>assets/img/medali/medali_02.png" alt="Medal">
                                                <?php elseif ($key + 1 == 3) : ?>
                                                    <img class="medal" src="<?php echo base_url(); ?>assets/img/medali/medali_03.png" alt="Medal">
                                                <?php else : ?>
                                                    <span class="nomor"><?= '#' . $key + 1; ?></span>
                                                <?php endif; ?>

                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <!-- </div> -->
                    </div>

                    <div class="row">
                        <div class="col-12 d-flex justify-content-center align-items-center d-md-none">
                            <button onclick="saveImage()" id="download-page-as-image" class="btn btn-secondary">Save Image</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics -->
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->