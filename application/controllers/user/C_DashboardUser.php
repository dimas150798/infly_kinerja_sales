<?php

defined('BASEPATH') or exit('No direct script access allowed');
// header('Access-Control-Allow-Origin: *');

class C_DashboardUser extends CI_Controller
{

    public function index()
    {
        date_default_timezone_set("Asia/Jakarta");
        $toDay = date('Y-m-d');

        // Memisahkan Tanggal
        $pecahDay       = explode("-", $toDay);

        $data['tahun']          = $pecahDay[0];
        $data['bulan']          = $pecahDay[1];
        $data['tanggal']        = $pecahDay[2];

        $KodePerolehan = $pecahDay[0] . '-' . $pecahDay[1];

        $data['JumlahAktif']    = $this->M_Spreadsheet->JumlahNewData($KodePerolehan);
        $data['JumlahKBS']      = $this->M_Spreadsheet->JumlahNewKBS($KodePerolehan);
        $data['JumlahTRW']      = $this->M_Spreadsheet->JumlahNewTRW($KodePerolehan);

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
        $data = $this->M_DataTerminasi->getData();
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
