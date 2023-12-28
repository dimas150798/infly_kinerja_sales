<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">Data Terminasi Perbulan</h3>
            </div>
            <div class="content-header-right col-md-8 col-12">
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Terminasi</a>
                            </li>
                            <li class="breadcrumb-item active">List
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body"><!--native-font-stack -->
            <section id="global-settings" class="card">

                <div class="card-content">
                    <div class="card-body">
                        <form action="<?php echo base_url('user/C_DataTerminasi_Perbulan') ?>" method="get" class="form-inline">
                            <label for="tahun">Tahun:</label>
                            <select class="form-control" id="tahun" name="tahun">
                                <?php
                                if ($YearGET == NULL) {
                                    echo '<option value="" disabled selected>-- Pilih Tahun --</option>';

                                    for ($i = 2022; $i <= 2025; $i++) {
                                        if ($Year == $i) {
                                            echo '<option selected value=' . $i . '>' . date("Y", mktime(0, 0, 0, 1, 1, $i)) . '</option>' . "\n";
                                        } else {
                                            echo '<option value=' . $i . '>' . date("Y", mktime(0, 0, 0, 1, 1, $i)) . '</option>' . "\n";
                                        }
                                    }
                                } else {
                                    echo '<option value="" disabled>-- Pilih Tahun --</option>';

                                    for ($i = 2022; $i <= 2025; $i++) {
                                        if ($YearGET == $i) {
                                            echo '<option selected value=' . $i . '>' . date("Y", mktime(0, 0, 0, 1, 1, $i)) . '</option>' . "\n";
                                        } else {
                                            echo '<option value=' . $i . '>' . date("Y", mktime(0, 0, 0, 1, 1, $i)) . '</option>' . "\n";
                                        }
                                    }
                                }
                                ?>
                            </select>

                            <label for="bulan">Bulan:</label>
                            <select class="form-control" id="bulan" name="bulan">
                                <?php
                                if ($MonthGET == NULL) {
                                    echo '<option value="" disabled>-- Pilih Bulan --</option>';

                                    for ($m = 1; $m <= 12; ++$m) {
                                        if ($Month == $m) {
                                            echo '<option selected value=' . $m . '>' . date('F', mktime(0, 0, 0, $m, 1)) . '</option>' . "\n";
                                        } else {
                                            echo '<option  value=' . $m . '>' . date('F', mktime(0, 0, 0, $m, 1)) . '</option>' . "\n";
                                        }
                                    }
                                } else {
                                    echo '<option value="" disabled>-- Pilih Bulan --</option>';

                                    for ($m = 1; $m <= 12; ++$m) {
                                        if ($MonthGET == $m) {
                                            echo '<option selected value=' . $m . '>' . date('F', mktime(0, 0, 0, $m, 1)) . '</option>' . "\n";
                                        } else {
                                            echo '<option  value=' . $m . '>' . date('F', mktime(0, 0, 0, $m, 1)) . '</option>' . "\n";
                                        }
                                    }
                                }

                                ?>
                            </select>
                            <div class="button-container">
                                <button type="submit" class="btn btn-primary">Cari</button>
                                <a href="<?php echo base_url('user/C_DataTerminasi_Pertahun') ?>" class="btn btn-secondary">Data Pertahun</a>
                            </div>
                        </form>
                    </div>

                </div>
            </section>

            <!--/ Global settings -->


            <!-- Display headings -->
            <section id="display-headings" class="card">
                <div class="topsales-card">

                    <div class="informasi-header">
                        <div class="row">
                            <div class="col-xl-7 col-lg-7">
                                <h4 class="informasi-title" id="heading-multiple-thumbnails">TOP TERMINATED SALES TERENDAH</h4>
                            </div>
                            <div class="col-xl-5 col-lg-5">
                                <h4 class="informasi-title" id="heading-multiple-thumbnails">(<?php echo $Name_Month ?> / <?php if ($YearGET == NULL) {
                                                                                                                                echo $Year;
                                                                                                                            } else {
                                                                                                                                echo $YearGET;
                                                                                                                            } ?>) </h4>
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
                                        <div class="rank-item <?php if ($key + 1 <= 1) echo 'first'; ?><?php if ($key + 1 > 1) echo 'rank-two-and-below'; ?>">

                                            <div class="username-container">
                                                <span class="username"><?= $value['nama_sales']; ?></span>
                                                <span class="jumlah"><i class="bi bi-person-check-fill"> </i> Perolehan Aktif = <?= $value['total_aktif']; ?></span>
                                                <span class="jumlah"><i class="bi bi-person-check-fill"> </i> Perolehan Terminated = <?= $value['total_terminasi']; ?></span>
                                                <span class="jumlah"><i class="bi bi-person-check-fill"> </i> 6 Bulan (-) = <?= $value['KurangDari_6Bulan']; ?></span>
                                                <span class="jumlah"><i class="bi bi-person-check-fill"> </i> 6 Bulan (+) = <?= $value['LebihDari_6Bulan']; ?></span>
                                            </div>

                                            <div class="persentase-container">
                                                <?php if ($key + 1 == 1) : ?>
                                                    <img class="medal-terminasi" src="<?php echo base_url(); ?>assets/img/medali/thropy_01.png" alt="Medal">
                                                    <span class="jumlah-terminasi"> <?php
                                                                                    $persentaseTerminasi = $value['persentase_terminasi'];

                                                                                    if ($persentaseTerminasi == 0) {
                                                                                        echo "N/A"; // Atur teks atau tindakan lain sesuai kebutuhan
                                                                                    } else {
                                                                                        echo number_format($persentaseTerminasi, 2) . " %";
                                                                                    }
                                                                                    ?></span>
                                                <?php elseif ($key + 1 == 2) : ?>
                                                    <span class="nomor-terminasi"><?= '#' . $key + 1; ?></span>

                                                    <span class="jumlah-terminasi"><?= number_format($value['persentase_terminasi'], 2); ?> %</span>

                                                <?php elseif ($key + 1 == 3) : ?>
                                                    <span class="nomor-terminasi"><?= '#' . $key + 1; ?></span>

                                                    <span class="jumlah-terminasi"><?= number_format($value['persentase_terminasi'], 2); ?> %</span>

                                                <?php else : ?>
                                                    <span class="nomor-terminasi"><?= '#' . $key + 1; ?></span>
                                                    <span class="jumlah-terminasi"><?= number_format($value['persentase_terminasi'], 2); ?> %</span>

                                                <?php endif; ?>
                                            </div>



                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- </div> -->
                </div>
            </section>
            <!--/ Headings-->

        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->