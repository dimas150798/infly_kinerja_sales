<?php

defined('BASEPATH') or exit('No direct script access allowed');
// header('Access-Control-Allow-Origin: *');

class C_Dashboard extends CI_Controller
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
        date_default_timezone_set("Asia/Jakarta");
        // Mendapatkan tanggal sekarang
        $ToDay              = date('d-m-Y');

        // Memisahkan Tanggal Sekarang
        $PecahToDay         = explode("-", $ToDay);

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
        $BulanPerolehan = sprintf("%02d", $PecahToDay[1]);

        // Mendapatkan tanggal 1 bulan sebelumnya
        $DateOneMonthAgo    = date('d-m-Y', strtotime('-1 month', strtotime($ToDay)));

        // Memisahkan Tanggal 1 Bulan sebelumnya
        $PecahOneMonthAgo   = explode("-", $DateOneMonthAgo);

        // Kode Perolehan Tanggal Sekarang
        $KodePerolehan_Now  = $PecahToDay[2] . '-' . $PecahToDay[1];

        // Kode Perolehan 1 Bulan Sebelumnnya
        $KodePerolehan      = $PecahOneMonthAgo[2] . '-' . $PecahOneMonthAgo[1];

        // Data Tanggal Sekarang
        $data['TotalPelangganAll_Now']  = $this->M_DataSheets->TotalPelangganAktif($KodePerolehan_Now);
        $data['TotalPelangganKBS_Now']  = $this->M_DataSheets->TotalPelangganAktif_KBS($KodePerolehan_Now);
        $data['TotalPelangganTRW_Now']  = $this->M_DataSheets->TotalPelangganAktif_TRW($KodePerolehan_Now);
        $data['TotalPelangganKNG_Now']  = $this->M_DataSheets->TotalPelangganAktif_KNG($KodePerolehan_Now);

        // Data Tanggal 1 Bulan Sebelumnya
        $data['TotalPelangganAll_Before']  = $this->M_DataSheets->TotalPelangganAktif($KodePerolehan);
        $data['TotalPelangganKBS_Before']  = $this->M_DataSheets->TotalPelangganAktif_KBS($KodePerolehan);
        $data['TotalPelangganTRW_Before']  = $this->M_DataSheets->TotalPelangganAktif_TRW($KodePerolehan);
        $data['TotalPelangganKNG_Before']  = $this->M_DataSheets->TotalPelangganAktif_KNG($KodePerolehan);

        $data['PerolehanSales']            = $this->M_DataPerolehanSales->Perolehan_Sales_Active($KodePerolehan_Now);

        // Perolehan Rangked Perbulan Terminasi
        $data['PerolehanSalesPerbulan'] = $this->M_DataPerolehanSales->Perolehan_Sales_Terminasi_Perbulan($KodePerolehan_Now);

        // Perolehan Rangked Pertahun Terminasi
        $data['PerolehanSalesPertahun'] = $this->M_DataPerolehanSales->Perolehan_Sales_Terminasi($PecahToDay[2]);


        $this->M_Spreadsheet->index();
        $this->M_SpreadsheetTerminasi->index();
        $this->M_DataPerolehanPerbulan->index();
        $this->M_DataPerolehanSales->index();
        $this->M_DataPerolehanTerminasi->index();

        $data['DateNow']    = $ToDay;
        $data['MonthNow']   = $months[(int)$BulanPerolehan];
        $data['Year']       = $PecahToDay[2];
        $data['title']      = 'Kinerja Sales';

        $this->load->view('template/V_Header', $data);
        $this->load->view('template/V_Sidebar', $data);
        $this->load->view('user/V_Dashboard', $data);
        $this->load->view('template/V_Footer', $data);
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
