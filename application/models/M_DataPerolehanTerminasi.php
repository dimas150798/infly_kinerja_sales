<?php

class M_DataPerolehanTerminasi extends CI_Model
{
    public function index()
    {
        date_default_timezone_set("Asia/Jakarta");
        $toDay = date('Y-m-d');

        // Memisahkan Tanggal
        $pecahDay       = explode("-", $toDay);

        $KodePerolehanDate = $pecahDay[0] . '-' . $pecahDay[1];

        $DataSheet = $this->db->query("SELECT
        nama_sales, kode_terminasi,
        SUM(CASE WHEN status = 'Kurang Dari' THEN 1 ELSE 0 END) AS perolehan_sales_terminasi_6Month_Minus,
        SUM(CASE WHEN status = 'Lebih Dari' THEN 1 ELSE 0 END) AS perolehan_sales_terminasi_6Month_Plus
        FROM
        terminasi_sheets
        WHERE kode_terminasi = '$KodePerolehanDate'
        GROUP BY
        nama_sales,
        kode_terminasi
        ")->result_array();

        foreach ($DataSheet as $dataSheet) {
            $KodePerolehan      = $dataSheet['kode_terminasi'];
            $NamaSales          = $dataSheet['nama_sales'];
            $perolehan_sales_terminasi_6Month_Plus      = $dataSheet['perolehan_sales_terminasi_6Month_Plus'];
            $perolehan_sales_terminasi_6Month_Minus     = $dataSheet['perolehan_sales_terminasi_6Month_Minus'];

            $Total_Perolehan_Terminasi = $perolehan_sales_terminasi_6Month_Plus + $perolehan_sales_terminasi_6Month_Minus;


            // Periksa apakah data sudah ada di tabel perolehan_sales
            $existingData = $this->db->get_where('perolehan_sales', [
                'kode_perolehan_sales'  => $KodePerolehan,
                'nama_sales'            => $NamaSales
            ])->row_array();

            if ($existingData) {
                // Jika data sudah ada, lakukan pembaruan
                $this->db->where('id_perolehan_sales', $existingData['id_perolehan_sales']);
                $this->db->update('perolehan_sales', [
                    'kode_perolehan_sales' => $KodePerolehan,
                    'perolehan_sales_terminasi' => $Total_Perolehan_Terminasi,
                    'perolehan_sales_terminasi_6Month_Plus' => $perolehan_sales_terminasi_6Month_Plus,
                    'perolehan_sales_terminasi_6Month_Minus' => $perolehan_sales_terminasi_6Month_Minus,
                    'nama_sales' => $NamaSales,
                ]);
            } else {
                // Jika data belum ada, lakukan penyisipan
                $this->db->insert('perolehan_sales', [
                    'kode_perolehan_sales' => $KodePerolehan,
                    'perolehan_sales_terminasi' => $Total_Perolehan_Terminasi,
                    'perolehan_sales_terminasi_6Month_Plus' => $perolehan_sales_terminasi_6Month_Plus,
                    'perolehan_sales_terminasi_6Month_Minus' => $perolehan_sales_terminasi_6Month_Minus,
                    'nama_sales' => $NamaSales,
                ]);
            }
        }
    }

    public function TerminasiAll()
    {
        date_default_timezone_set("Asia/Jakarta");
        $toDay = date('Y-m-d');

        // Memisahkan Tanggal
        $pecahDay       = explode("-", $toDay);

        $query = $this->db->query("SELECT
            nama_sales,
            SUBSTRING(kode_perolehan_sales, 1, 4) AS tahun,
            SUM(perolehan_sales_terminasi) AS total_terminasi
        FROM
        perolehan_sales
        WHERE
            SUBSTRING(kode_perolehan_sales, 1, 4) = '$pecahDay[0]' AND nama_sales != '' AND perolehan_sales_terminasi != ''
        GROUP BY
            nama_sales
            
            ORDER BY 
            total_terminasi DESC");

        return $query->result_array();
    }
}
