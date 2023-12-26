<?php

class M_DataPerolehanSalesAktif extends CI_Model
{
    public function index()
    {
        date_default_timezone_set("Asia/Jakarta");
        $toDay = date('2023-04-d');

        // Memisahkan Tanggal
        $pecahDay       = explode("-", $toDay);

        $tahun          = $pecahDay[0];
        $bulan          = $pecahDay[1];

        $DataSheet = $this->db->query("SELECT 
        SUBSTRING(kode_perolehan, 1, 4) AS tahun,
        SUBSTRING(kode_perolehan, 6, 2) AS bulan,
                kode_perolehan, 
                nama_sales, 
                COUNT(*) AS jumlah_perolehan 
            FROM 
                data_sheets
            WHERE 
                SUBSTRING(kode_perolehan, 1, 4) = $tahun AND SUBSTRING(kode_perolehan, 6, 2) = $bulan
        AND status_customer = 'active'
            GROUP BY 
                kode_perolehan, nama_sales
            ORDER BY 
        kode_perolehan, nama_sales")->result_array();

        foreach ($DataSheet as $dataSheet) {
            $kodePerolehan = $dataSheet['kode_perolehan'];
            $namaSales = $dataSheet['nama_sales'];
            $jumlahPerolehan = $dataSheet['jumlah_perolehan'];

            // Periksa apakah data sudah ada di tabel perolehan_sales
            $existingData = $this->db->get_where('perolehan_sales', [
                'kode_perolehan_sales' => $kodePerolehan,
                'nama_sales' => $namaSales,
            ])->row_array();

            if ($existingData) {
                // Jika data sudah ada, lakukan pembaruan
                $this->db->where('id_perolehan_sales', $existingData['id_perolehan_sales']);
                $this->db->update('perolehan_sales', [
                    'kode_perolehan_sales' => $kodePerolehan,
                    'perolehan_sales_aktif' => $jumlahPerolehan,
                    'nama_sales' => $namaSales,
                ]);
            } else {
                // Jika data belum ada, lakukan penyisipan
                $this->db->insert('perolehan_sales', [
                    'kode_perolehan_sales' => $kodePerolehan,
                    'perolehan_sales_aktif' => $jumlahPerolehan,
                    'nama_sales' => $namaSales,
                ]);
            }
        }
    }

    public function DataTopSelling($tahun, $bulan)
    {
        $query = $this->db->query("SELECT
        perolehan_sales_all, perolehan_sales_aktif, nama_sales
    FROM
        perolehan_sales
    WHERE
        perolehan_sales_all != '' AND perolehan_sales_aktif != '' AND
        SUBSTRING(kode_perolehan_sales, 1, 4) = $tahun -- Mengambil 4 karakter pertama sebagai tahun
        AND SUBSTRING(kode_perolehan_sales, 6, 2) = $bulan -- Mengambil 2 karakter setelah karakter ke-5 sebagai bulan

    ORDER BY
        perolehan_sales_aktif DESC");

        return $query->result_array();
    }

    public function getData()
    {
        $query = $this->db->query("SELECT id_perolehan, kode_perolehan, jumlah_perolehan, nama_bulan
        FROM perolehan_perbulan
        WHERE kode_perolehan >= DATE_FORMAT(CURRENT_DATE, '%Y-%m')
           OR kode_perolehan >= DATE_FORMAT(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH), '%Y-%m')
           OR kode_perolehan >= DATE_FORMAT(DATE_SUB(CURRENT_DATE, INTERVAL 2 MONTH), '%Y-%m')
           OR kode_perolehan >= DATE_FORMAT(DATE_SUB(CURRENT_DATE, INTERVAL 3 MONTH), '%Y-%m')
        ORDER BY kode_perolehan ASC");

        return $query->result_array();
    }

    public function JumlahData($KodePerolehan)
    {

        $query   = $this->db->query("SELECT id_perolehan_sales, kode_perolehan_sales, jumlah_perolehan_sales, nama_sales

        FROM perolehan_sales

        WHERE status_customer = 'active' AND  nama_customer != '' 
        AND kode_perolehan = '$KodePerolehan'
        ");

        return $query->result_array();
    }
}
