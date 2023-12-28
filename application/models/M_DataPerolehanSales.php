<?php

class M_DataPerolehanSales extends CI_Model
{
    public function index()
    {
        date_default_timezone_set("Asia/Jakarta");
        $toDay = date('Y-m-d');

        // Memisahkan Tanggal
        $pecahDay       = explode("-", $toDay);

        $KodePerolehanDate = $pecahDay[0] . '-' . $pecahDay[1];

        $DataSheet = $this->db->query("SELECT
            nama_sales,
            kode_perolehan,
            COUNT(*) AS perolehan_sales_all,
            SUM(CASE WHEN status_customer = 'active' THEN 1 ELSE 0 END) AS perolehan_sales_aktif
        FROM
            data_sheets
            WHERE kode_perolehan = '$KodePerolehanDate'
        GROUP BY
            nama_sales,
            kode_perolehan;
        ")->result_array();

        foreach ($DataSheet as $dataSheet) {
            $KodePerolehan      = $dataSheet['kode_perolehan'];
            $NamaSales          = $dataSheet['nama_sales'];
            $Perolehan_Sales_All    = $dataSheet['perolehan_sales_all'];
            $Perolehan_Sales_Aktif   = $dataSheet['perolehan_sales_aktif'];

            // Periksa apakah data sudah ada di tabel perolehan_sales
            $existingData = $this->db->get_where('perolehan_sales', [
                'kode_perolehan_sales' => $KodePerolehan,
                'nama_sales'            => $NamaSales
            ])->row_array();

            if ($existingData) {
                // Jika data sudah ada, lakukan pembaruan
                $this->db->where('id_perolehan_sales', $existingData['id_perolehan_sales']);
                $this->db->update('perolehan_sales', [
                    'kode_perolehan_sales' => $KodePerolehan,
                    'perolehan_sales_all' => $Perolehan_Sales_All,
                    'perolehan_sales_aktif' => $Perolehan_Sales_Aktif,
                    'nama_sales' => $NamaSales,
                ]);
            } else {
                // Jika data belum ada, lakukan penyisipan
                $this->db->insert('perolehan_sales', [
                    'kode_perolehan_sales' => $KodePerolehan,
                    'perolehan_sales_all' => $Perolehan_Sales_All,
                    'perolehan_sales_aktif' => $Perolehan_Sales_Aktif,
                    'nama_sales' => $NamaSales,
                ]);
            }
        }
    }

    public function Perolehan_Sales_Active($KodePerolehan)
    {
        $query = $this->db->query("SELECT * FROM `perolehan_sales` 

        WHERE kode_perolehan_sales = '$KodePerolehan' AND perolehan_sales_aktif != 0
        
        GROUP BY nama_sales
        
        ORDER BY perolehan_sales_aktif DESC");

        return $query->result_array();
    }

    public function Perolehan_Sales_Terminasi($KodePerolehan)
    {
        $query = $this->db->query("SELECT
        nama_sales,
        SUBSTRING(kode_perolehan_sales, 1, 4) AS tahun,
        SUM(perolehan_sales_aktif) AS total_aktif,
        SUM(perolehan_sales_terminasi_6Month_Plus) AS LebihDari_6Bulan,
        SUM(perolehan_sales_terminasi_6Month_Minus) AS KurangDari_6Bulan,
        SUM(perolehan_sales_terminasi) AS total_terminasi,
        (SUM(perolehan_sales_terminasi) / SUM(perolehan_sales_aktif)) * 100 AS persentase_terminasi
    FROM
        perolehan_sales
    WHERE
        SUBSTRING(kode_perolehan_sales, 1, 4) = '$KodePerolehan' AND nama_sales != '' AND perolehan_sales_terminasi != ''
    GROUP BY
        nama_sales  
    ORDER BY persentase_terminasi ASC");

        return $query->result_array();
    }

    public function Perolehan_Sales_Terminasi_Perbulan($KodePerolehan)
    {
        $query = $this->db->query("SELECT
        nama_sales,
        kode_perolehan_sales,
        SUM(perolehan_sales_aktif) AS total_aktif,
        SUM(perolehan_sales_terminasi_6Month_Plus) AS LebihDari_6Bulan,
        SUM(perolehan_sales_terminasi_6Month_Minus) AS KurangDari_6Bulan,
        SUM(perolehan_sales_terminasi) AS total_terminasi,
        (SUM(perolehan_sales_terminasi) / SUM(perolehan_sales_aktif)) * 100 AS persentase_terminasi
    FROM
        perolehan_sales
    WHERE
        kode_perolehan_sales = '$KodePerolehan' AND perolehan_sales_terminasi != ''
    GROUP BY
        nama_sales  
    ORDER BY persentase_terminasi ASC");

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
