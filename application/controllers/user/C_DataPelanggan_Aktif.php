<?php

defined('BASEPATH') or exit('No direct script access allowed');
// header('Access-Control-Allow-Origin: *');

class C_DataPelanggan_Aktif extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('email') == null) {

            // Notifikasi Login Terlebih Dahulu
            $this->session->set_flashdata('LoginGagal_icon', 'error');
            $this->session->set_flashdata('LoginGagal_title', 'Login Terlebih Dahulu');

            redirect('C_FormLogin');
        }
    }

    public function index()
    {

        if ((isset($_GET['tahun']) && $_GET['tahun'] != '') && (isset($_GET['bulan']) && $_GET['bulan'] != '')) {
            $tahunGET                   = $_GET['tahun'];
            $bulanGET                   = $_GET['bulan'];

            $months = array(
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember'
            );

            // Menambahkan 0 di depan bulan jika kurang dari 10
            $BulanPerolehan = sprintf("%02d", $bulanGET);

            date_default_timezone_set("Asia/Jakarta");
            // Mendapatkan tanggal sekarang
            $ToDay              = date('d-m-Y');

            // Mendapatkan tanggal 1 bulan sebelumnya
            $DateOneMonthAgo    = date('d-m-Y', strtotime('-1 month', strtotime($ToDay)));

            // Memisahkan Tanggal Sekarang
            $PecahToDay         = explode("-", $ToDay);

            // Memisahkan Tanggal 1 Bulan sebelumnya
            $PecahOneMonthAgo   = explode("-", $DateOneMonthAgo);

            // Kode Perolehan Tanggal Sekarang
            $KodePerolehan_Now  = $tahunGET . '-' . $BulanPerolehan;

            // Kode Perolehan 1 Bulan Sebelumnnya
            $KodePerolehan      = $PecahOneMonthAgo[2] . '-' . $PecahOneMonthAgo[1];

            $data['PerolehanSales'] = $this->M_DataSheets->PelangganAktif($KodePerolehan_Now);

            $data['DateNow'] = $ToDay;
            $data['YearGET']   = $tahunGET;
            $data['MonthGET']   = $bulanGET;
            $data['title'] = 'Kinerja Sales';

            $data['Name_Month'] = $months[(int)$bulanGET];


            $this->load->view('template/V_Header', $data);
            $this->load->view('template/V_Sidebar', $data);
            $this->load->view('user/V_DataPelanggan_Aktif', $data);
            $this->load->view('template/V_Footer', $data);
        } else {
            date_default_timezone_set("Asia/Jakarta");
            // Mendapatkan tanggal sekarang
            $ToDay              = date('d-m-Y');

            $months = array(
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember'
            );

            // Mendapatkan tanggal 1 bulan sebelumnya
            $DateOneMonthAgo    = date('d-m-Y', strtotime('-1 month', strtotime($ToDay)));

            // Memisahkan Tanggal Sekarang
            $PecahToDay         = explode("-", $ToDay);

            // Memisahkan Tanggal 1 Bulan sebelumnya
            $PecahOneMonthAgo   = explode("-", $DateOneMonthAgo);

            // Menambahkan 0 di depan bulan jika kurang dari 10
            $BulanPerolehan = sprintf("%02d", $PecahToDay[1]);

            // Kode Perolehan Tanggal Sekarang
            $KodePerolehan_Now  = $PecahToDay[2] . '-' . $BulanPerolehan;

            // Kode Perolehan 1 Bulan Sebelumnnya
            $KodePerolehan      = $PecahOneMonthAgo[2] . '-' . $PecahOneMonthAgo[1];

            $data['PerolehanSales'] = $this->M_DataSheets->PelangganAktif($KodePerolehan_Now);

            $data['DateNow'] = $ToDay;
            $data['YearGET']   = NULL;
            $data['MonthGET']   = NULL;

            $data['Year']   = $PecahToDay[2];
            $data['Month']   = $PecahToDay[1];
            $data['title'] = 'Kinerja Sales';

            $data['Name_Month'] = $months[(int)$PecahToDay[1]];

            $this->load->view('template/V_Header', $data);
            $this->load->view('template/V_Sidebar', $data);
            $this->load->view('user/V_DataPelanggan_Aktif', $data);
            $this->load->view('template/V_Footer', $data);
        }
    }

    public function GetDataAjax()
    {
        date_default_timezone_set("Asia/Jakarta");
        // Mendapatkan tanggal sekarang
        $ToDay              = date('d-m-Y');

        $months = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        );

        // Mendapatkan tanggal 1 bulan sebelumnya
        $DateOneMonthAgo    = date('d-m-Y', strtotime('-1 month', strtotime($ToDay)));

        // Memisahkan Tanggal Sekarang
        $PecahToDay         = explode("-", $ToDay);

        // Memisahkan Tanggal 1 Bulan sebelumnya
        $PecahOneMonthAgo   = explode("-", $DateOneMonthAgo);

        // Menambahkan 0 di depan bulan jika kurang dari 10
        $BulanPerolehan = sprintf("%02d", $PecahToDay[1]);

        // Kode Perolehan Tanggal Sekarang
        $KodePerolehan_Now  = $PecahToDay[2] . '-' . $BulanPerolehan;

        $result = $this->M_DataSheets->PelangganAktif($KodePerolehan_Now);

        $no = 0;

        foreach ($result as $dataCustomer) {

            $row = array();
            $row[] = ++$no;
            $row[] = $dataCustomer['tanggal_customer'];
            $row[] = $dataCustomer['nama_customer'];
            $row[] = $dataCustomer['nama_paket'];
            $row[] = $dataCustomer['branch_customer'];
            $row[] = $dataCustomer['alamat_customer'];
            $row[] = $dataCustomer['nama_sales'];

            $row[] =
                '<div class="text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-bs-toggle="dropdown" data-bs-target="#dropdown" aria-expanded="false" aria-controls="dropdown">
                        Opsi
                    </button>
                    <div class="dropdown-menu text-black" style="background-color:aqua;">
                        <a onclick="EditDataPelanggan(' . $dataCustomer['id_sheet'] . ')"class="dropdown-item text-black"></i> Edit</a>
                        <a onclick="TerminatedPelanggan(' . $dataCustomer['id_sheet'] . ')" class="dropdown-item text-black"><i class="bi bi-trash3-fill"></i> Terminated</a>
                    </div>
                </div>
                </div>';
            $data[] = $row;
        }

        $ouput = array(
            'data' => $data
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($ouput));
    }

    public function reports_sales()
    {
        $data = $this->M_DataPerolehan->getData();
        echo json_encode($data);
    }

    public function reports_status()
    {
        date_default_timezone_set("Asia/Jakarta");
        $toDay = date('Y-m-d');

        // Memisahkan Tanggal Sekarang
        $pecahDayNow = explode("-", $toDay);

        $data['tahunNow']   = $pecahDayNow[0];
        $data['bulanNow']   = $pecahDayNow[1];
        $data['tanggalNow'] = $pecahDayNow[2];

        $KodePerolehan_Now          = $pecahDayNow[0] . '-' . $pecahDayNow[1];


        $data = $this->M_Spreadsheet->GetAllDataSheet($KodePerolehan_Now);
        echo json_encode($data);
    }


    public function getTopSelling()
    {
        date_default_timezone_set("Asia/Jakarta");
        $toDay = date('Y-m-d');

        // Memisahkan Tanggal
        $pecahDay       = explode("-", $toDay);

        $tahun          = $pecahDay[0];
        $bulan          = $pecahDay[1];

        $result = $this->M_Spreadsheet->DataTopSelling($tahun, $bulan);

        $no = 0;

        foreach ($result as $dataCustomer) {
            $row = array();
            $row[] = '<div class="text-center">' . ++$no . '</div>';
            $row[] = '<div class="text-center">' . $dataCustomer['nama_sales'] . '</div>';
            $row[] = '<div class="text-center">' . $dataCustomer['jumlah'] . '</div>';
            $data[] = $row;
        }

        $ouput = array(
            'data' => $data
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($ouput));
    }
}
