<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">Data Aktif Perbulan</h3>
            </div>
            <div class="content-header-right col-md-8 col-12">
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Aktif</a>
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
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <table id="mytable" class="table table-bordered responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">Tanggal</th>
                                    <th width="10%">Nama customer</th>
                                    <th width="10%">Nama Paket</th>
                                    <th width="10%">Area</th>
                                    <th width="10%">Alamat</th>
                                    <th width="10%">Nama Sales</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!--/ Headings-->

        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->