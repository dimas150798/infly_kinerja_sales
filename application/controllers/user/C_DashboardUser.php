<?php

defined('BASEPATH') or exit('No direct script access allowed');
// header('Access-Control-Allow-Origin: *');

class C_DashboardUser extends CI_Controller
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
        $toDay = date('Y-m-d');

        // Mendapatkan tanggal sebulan yang lalu
        $dateOneMonthAgo = date('Y-m-d', strtotime('-1 month', strtotime($toDay)));

        // Memisahkan Tanggal Sekarang
        $pecahDayNow = explode("-", $toDay);

        $data['tahunNow']   = $pecahDayNow[0];
        $data['bulanNow']   = $pecahDayNow[1];
        $data['tanggalNow'] = $pecahDayNow[2];

        // Memisahkan Tanggal Sebulan yang Lalu
        $pecahDayOneMonthAgo = explode("-", $dateOneMonthAgo);

        $data['tahunOneMonthAgo']   = $pecahDayOneMonthAgo[0];
        $data['bulanOneMonthAgo']   = $pecahDayOneMonthAgo[1];
        $data['tanggalOneMonthAgo'] = $pecahDayOneMonthAgo[2];

        $KodePerolehan_Now          = $pecahDayNow[0] . '-' . $pecahDayNow[1];
        $KodePerolehan_OneMonthAgo  = $pecahDayOneMonthAgo[0] . '-' . $pecahDayOneMonthAgo[1];

        $data['JumlahAktif']    = $this->M_Spreadsheet->JumlahData($KodePerolehan_Now);
        $data['JumlahKBS']      = $this->M_Spreadsheet->JumlahKBS($KodePerolehan_Now);
        $data['JumlahTRW']      = $this->M_Spreadsheet->JumlahTRW($KodePerolehan_Now);
        $data['JumlahKanigaran']      = $this->M_Spreadsheet->JumlahKanigaran($KodePerolehan_Now);

        $data['OneMonthAgo_Aktif']    = $this->M_Spreadsheet->JumlahData($KodePerolehan_OneMonthAgo);
        $data['OneMonthAgo_KBS']      = $this->M_Spreadsheet->JumlahKBS($KodePerolehan_OneMonthAgo);
        $data['OneMonthAgo_TRW']      = $this->M_Spreadsheet->JumlahTRW($KodePerolehan_OneMonthAgo);
        $data['OneMonthAgo_Kanigaran']      = $this->M_Spreadsheet->JumlahKanigaran($KodePerolehan_OneMonthAgo);


        $this->M_Spreadsheet->index();

        $this->M_DataPerolehan->index();

        $this->load->view('user/V_DashboardUser', $data);
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
