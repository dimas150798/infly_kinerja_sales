<?php


class M_Spreadsheet extends CI_Model
{
    public function index()
    {
        $response = [];

        $json_string = 'https://script.google.com/macros/s/AKfycbzZz72CNtTd8kIt8U_7UxSdiGAz47qEBPwgO4fq4HDTOGz6U3Sv55rPygKcbfWqS3OL-w/exec';
        $jsondata = file_get_contents($json_string);
        $obj = json_decode($jsondata, TRUE);

        $arrayObj = count($obj);

        $getData = $this->db->query("SELECT id_sheet, kode_sheet, tanggal, nama_customer, nama_paket, branch, alamat, status, sales FROM data_sheet")->result_array();

        for ($i = 0; $i < $arrayObj; $i++) {
            $status = false;

            // Memisahkan kode menjadi bulan dan tahun
            $getMonthYear = explode("/", $obj[$i]['kode']);

            foreach ($getData as $value) {
                if ($obj[$i]['kode'] == $value['kode_sheet']) {
                    $status = true;

                    $this->db->update("data_sheet", ['kode_sheet' => $obj[$i]['kode']], ['id_sheet' => $value['id_sheet']]);
                    $this->db->update("data_sheet", ['tanggal' => $obj[$i]['tanggal']], ['id_sheet' => $value['id_sheet']]);
                    $this->db->update("data_sheet", ['nama_customer' => $obj[$i]['nama_customer']], ['id_sheet' => $value['id_sheet']]);
                    $this->db->update("data_sheet", ['nama_paket' => $obj[$i]['nama_paket']], ['id_sheet' => $value['id_sheet']]);
                    $this->db->update("data_sheet", ['branch' => $obj[$i]['branch']], ['id_sheet' => $value['id_sheet']]);
                    $this->db->update("data_sheet", ['alamat' => $obj[$i]['alamat']], ['id_sheet' => $value['id_sheet']]);
                    $this->db->update("data_sheet", ['status' => $obj[$i]['status']], ['id_sheet' => $value['id_sheet']]);
                    $this->db->update("data_sheet", ['sales' => $obj[$i]['sales']], ['id_sheet' => $value['id_sheet']]);
                    $this->db->update("data_sheet", ['kode_YearMonth' => $getMonthYear[1] . $getMonthYear[2]], ['id_sheet' => $value['id_sheet']]);
                    $this->db->update("data_sheet", ['updated_at' => date('Y-m-d H:i:s', time())], ['id_sheet' => $value['id_sheet']]);

                    $response = [
                        'kode_sheet'       => $obj[$i]['kode'],
                        'tanggal'          => $obj[$i]['tanggal'],
                        'nama_customer'    => $obj[$i]['nama_customer'],
                        'nama_paket'       => $obj[$i]['nama_paket'],
                        'branch'           => $obj[$i]['branch'],
                        'alamat'           => $obj[$i]['alamat'],
                        'status'           => $obj[$i]['status'],
                        'sales'            => $obj[$i]['sales'],
                    ];
                }
            }

            if ($status == false) {
                if ($obj[$i]['kode'] == "") {
                } else {
                    $this->db->insert("data_sheet", [
                        "kode_sheet"        => $obj[$i]['kode'],
                        "tanggal"           => $obj[$i]['tanggal'],
                        "nama_customer"     => $obj[$i]['nama_customer'],
                        "nama_paket"        => $obj[$i]['nama_paket'],
                        "branch"            => $obj[$i]['branch'],
                        "alamat"            => $obj[$i]['alamat'],
                        "status"            => $obj[$i]['status'],
                        "sales"             => $obj[$i]['sales'],
                        "month_cust"        => $getMonthYear[2],
                        "year_cust"         => $getMonthYear[1],
                        "kode_YearMonth"    => $getMonthYear[1] . $getMonthYear[2],
                        'created_at'        => date('Y-m-d H:i:s', time())
                    ]);
                }

                $response = [
                    'id_sheet'          => $this->db->insert_id(),
                    'kode_sheet'       => $obj[$i]['kode'],
                    'tanggal'          => $obj[$i]['tanggal'],
                    'nama_customer'    => $obj[$i]['nama_customer'],
                    'nama_paket'       => $obj[$i]['nama_paket'],
                    'branch'           => $obj[$i]['branch'],
                    'alamat'           => $obj[$i]['alamat'],
                    'status'           => $obj[$i]['status'],
                    'sales'            => $obj[$i]['sales'],
                ];
            }
        }
        return $response;
    }

    public function GetDataSheet($tahun, $bulan)
    {
        $query = $this->db->query("SELECT id_sheet, kode_sheet, tanggal, nama_customer, nama_paket, branch, alamat, status, sales, month_cust, year_cust

        FROM data_sheet

        WHERE status = 'active' AND  nama_customer != '' 
        AND year_cust = '$tahun' AND month_cust = '$bulan'");

        return $query->result_array();
    }

    public function DataTopSelling($tahun, $bulan)
    {
        $query = $this->db->query("SELECT sales, 
        count(nama_customer) AS jumlah
        FROM data_sheet
        
        WHERE status = 'active' AND  nama_customer != '' 
        AND year_cust = '$tahun' AND month_cust = '$bulan'

        GROUP BY sales
        ORDER BY jumlah DESC");

        return $query->result_array();
    }

    public function JumlahNewData($tahun, $bulan)
    {
        $query   = $this->db->query("SELECT id_sheet, kode_sheet, tanggal, nama_customer, nama_paket, branch, alamat, status, sales, month_cust, year_cust

        FROM data_sheet

        WHERE status = 'active' AND  nama_customer != '' 
        AND year_cust = '$tahun' AND month_cust = '$bulan'
        
        ");

        return $query->num_rows();
    }

    public function JumlahNewKBS($tahun, $bulan)
    {
        $query   = $this->db->query("SELECT id_sheet, kode_sheet, tanggal, nama_customer, nama_paket, branch, alamat, status, sales, month_cust, year_cust

        FROM data_sheet

        WHERE status = 'active' AND  nama_customer != '' AND branch = 'KBS'
        AND year_cust = '$tahun' AND month_cust = '$bulan'");

        return $query->num_rows();
    }

    public function JumlahNewTRW($tahun, $bulan)
    {
        $query   = $this->db->query("SELECT id_sheet, kode_sheet, tanggal, nama_customer, nama_paket, branch, alamat, status, sales, month_cust, year_cust

        FROM data_sheet

        WHERE status = 'active' AND  nama_customer != '' AND branch = 'TRW'
        AND year_cust = '$tahun' AND month_cust = '$bulan'");

        return $query->num_rows();
    }
}
