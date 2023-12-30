<?php


class M_Spreadsheet extends CI_Model
{
    public function index()
    {
        $response = [];

        $json_string = 'https://script.google.com/macros/s/AKfycbyAwwxyrLd_JOxXlOlvaD4K0vHkgLG7EKQrgpHTTBa3foVhCzYW_3tR2ol4XLj8joZK9Q/exec';
        $jsondata = file_get_contents($json_string);
        $obj = json_decode($jsondata, TRUE);

        $arrayObj = count($obj);

        $getData = $this->db->query("SELECT id_sheet, kode_sheet, tanggal_customer, nama_customer, nama_paket, branch_customer, alamat_customer, status_customer, nama_sales, kode_perolehan FROM data_sheets")->result_array();

        for ($i = 0; $i < $arrayObj; $i++) {
            $status = false;

            foreach ($getData as $value) {
                if ($obj[$i]['kode'] == $value['kode_sheet']) {
                    $status = true;

                    $KodeSheet = $value['kode_sheet'];

                    // Memisahkan kode_customer berdasarkan tanda '/'
                    $parts = explode('/', $KodeSheet);

                    // Bagian-bagian yang telah dipisahkan
                    $kode = $parts[0];
                    $tahun = $parts[1];
                    $bulan = $parts[2];
                    $nomor = $parts[3];

                    $KodePerolehan = $tahun . '-' . $bulan;

                    $updateData = [
                        'kode_sheet' => $obj[$i]['kode'],
                        'tanggal_customer' => $obj[$i]['tanggal'],
                        'nama_customer' => $obj[$i]['nama_customer'],
                        'nama_paket' => $obj[$i]['nama_paket'],
                        'branch_customer' => $obj[$i]['branch'],
                        'alamat_customer' => $obj[$i]['alamat'],
                        'status_customer' => $obj[$i]['status'],
                        'nama_sales' => $obj[$i]['sales'],
                        'kode_perolehan' => $KodePerolehan
                    ];

                    // Memperbarui data
                    $this->db->where('id_sheet', $value['id_sheet']);
                    $this->db->update('data_sheets', $updateData);
                }
            }

            if (!$status && !empty($obj[$i]['kode'])) {
                $insertData = [
                    "kode_sheet" => $obj[$i]['kode'],
                    "tanggal_customer" => $obj[$i]['tanggal'],
                    "nama_customer" => $obj[$i]['nama_customer'],
                    "nama_paket" => $obj[$i]['nama_paket'],
                    "branch_customer" => $obj[$i]['branch'],
                    "alamat_customer" => $obj[$i]['alamat'],
                    "status_customer" => $obj[$i]['status'],
                    "nama_sales" => $obj[$i]['sales'],
                ];

                // Menyisipkan data baru
                $this->db->insert("data_sheets", $insertData);
            }
        }
    }

    public function GetDataSheet($tahun, $bulan)
    {
        $query = $this->db->query("SELECT id_sheet, kode_sheet, tanggal, nama_customer, nama_paket, branch, alamat, status, sales, month_cust, year_cust

        FROM data_sheet

        WHERE status = 'active' AND  nama_customer != '' 
        AND year_cust = '$tahun' AND month_cust = '$bulan'");

        return $query->result_array();
    }

    public function GetAllDataSheet($KodePerolehan)
    {
        $query = $this->db->query("SELECT status_customer, COUNT(*) as jumlah_customer
        FROM data_sheets
        WHERE nama_customer != '' 
        AND kode_perolehan = '$KodePerolehan'
        GROUP BY status_customer;");

        return $query->result_array();
    }

    public function DataTopSelling($tahun, $bulan)
    {
        $query = $this->db->query("SELECT
        nama_sales,
        COUNT(nama_customer) AS jumlah
    FROM
        data_sheets
    WHERE
        status_customer = 'active'
        AND nama_customer != ''
        AND SUBSTRING(kode_perolehan, 1, 4) = '$tahun' -- Mengambil 4 karakter pertama sebagai tahun
        AND SUBSTRING(kode_perolehan, 6, 2) = '$bulan' -- Mengambil 2 karakter setelah karakter ke-5 sebagai bulan
    GROUP BY
        nama_sales
    ORDER BY
        jumlah DESC;");

        return $query->result_array();
    }

    public function JumlahNewData($KodePerolehan)
    {

        $query   = $this->db->query("SELECT id_sheet, kode_sheet, tanggal_customer, nama_customer, nama_paket, branch_customer, alamat_customer, status_customer, nama_sales, kode_perolehan

        FROM data_sheets

        WHERE status_customer = 'active' AND  nama_customer != '' 
        AND kode_perolehan = '$KodePerolehan'
        ");

        return $query->num_rows();
    }

    public function JumlahData($KodePerolehan)
    {

        $query   = $this->db->query("SELECT id_sheet, kode_sheet, tanggal_customer, nama_customer, nama_paket, branch_customer, alamat_customer, status_customer, nama_sales, kode_perolehan

        FROM data_sheets

        WHERE status_customer = 'active' AND  nama_customer != '' 
        AND kode_perolehan = '$KodePerolehan'
        ");

        return $query->num_rows();
    }

    public function JumlahNewKBS($KodePerolehan)
    {
        $query   = $this->db->query("SELECT id_sheet, kode_sheet, tanggal_customer, nama_customer, nama_paket, branch_customer, alamat_customer, status_customer, nama_sales

        FROM data_sheets

        WHERE status_customer = 'active' AND  nama_customer != '' AND branch_customer = 'KBS'
        AND kode_perolehan = '$KodePerolehan'");

        return $query->num_rows();
    }

    public function JumlahKBS($KodePerolehan)
    {
        $query   = $this->db->query("SELECT id_sheet, kode_sheet, tanggal_customer, nama_customer, nama_paket, branch_customer, alamat_customer, status_customer, nama_sales

        FROM data_sheets

        WHERE status_customer = 'active' AND  nama_customer != '' AND branch_customer = 'KBS'
        AND kode_perolehan = '$KodePerolehan'");

        return $query->num_rows();
    }

    public function JumlahNewTRW($KodePerolehan)
    {
        $query   = $this->db->query("SELECT id_sheet, kode_sheet, tanggal_customer, nama_customer, nama_paket, branch_customer, alamat_customer, status_customer, nama_sales

        FROM data_sheets

        WHERE status_customer = 'active' AND  nama_customer != '' AND branch_customer = 'TRW'
        AND kode_perolehan = '$KodePerolehan'");

        return $query->num_rows();
    }

    public function JumlahTRW($KodePerolehan)
    {
        $query   = $this->db->query("SELECT id_sheet, kode_sheet, tanggal_customer, nama_customer, nama_paket, branch_customer, alamat_customer, status_customer, nama_sales

        FROM data_sheets

        WHERE status_customer = 'active' AND  nama_customer != '' AND branch_customer = 'TRW'
        AND kode_perolehan = '$KodePerolehan'");

        return $query->num_rows();
    }

    public function JumlahNewKanigaran($KodePerolehan)
    {
        $query   = $this->db->query("SELECT id_sheet, kode_sheet, tanggal_customer, nama_customer, nama_paket, branch_customer, alamat_customer, status_customer, nama_sales

        FROM data_sheets

        WHERE status_customer = 'active' AND  nama_customer != '' AND branch_customer = 'Kanigaran'
        AND kode_perolehan = '$KodePerolehan'");

        return $query->num_rows();
    }

    public function JumlahKanigaran($KodePerolehan)
    {
        $query   = $this->db->query("SELECT id_sheet, kode_sheet, tanggal_customer, nama_customer, nama_paket, branch_customer, alamat_customer, status_customer, nama_sales

        FROM data_sheets

        WHERE status_customer = 'active' AND  nama_customer != '' AND branch_customer = 'Kanigaran'
        AND kode_perolehan = '$KodePerolehan'");

        return $query->num_rows();
    }
}
