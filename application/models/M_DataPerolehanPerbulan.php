<?php

class M_DataPerolehanPerbulan extends CI_Model
{
    public function index()
    {
        date_default_timezone_set("Asia/Jakarta");

        $DataSheet = $this->db->query("SELECT kode_perolehan, COUNT(*) AS jumlah_perolehan 
            FROM data_sheets 
            WHERE status_customer = 'active' AND kode_perolehan IS NOT NULL
            GROUP BY kode_perolehan 
            ORDER BY kode_perolehan
        ")->result_array();

        foreach ($DataSheet as $dataSheet) {

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

            $kodePerolehan = $dataSheet['kode_perolehan'];
            $jumlahPerolehan = $dataSheet['jumlah_perolehan'];

            // Memisahkan tahun dan bulan
            list($tahun, $bulan) = explode("-", $kodePerolehan);

            // Menambahkan 0 di depan bulan jika kurang dari 10
            $BulanPerolehan = sprintf("%02d", $bulan);

            // Periksa apakah data sudah ada di tabel perolehan_sales
            $existingData = $this->db->get_where('perolehan_perbulan', [
                'kode_perolehan' => $kodePerolehan,
                'nama_bulan'    => $months[(int)$BulanPerolehan],
            ])->row_array();

            if ($existingData) {
                // Jika data sudah ada, lakukan pembaruan
                $this->db->where('id_perolehan', $existingData['id_perolehan']);
                $this->db->update('perolehan_perbulan', [
                    'jumlah_perolehan' => $jumlahPerolehan,
                ]);
            } else {
                // Jika data belum ada, lakukan penyisipan
                $this->db->insert('perolehan_perbulan', [
                    'kode_perolehan' => $kodePerolehan,
                    'jumlah_perolehan' => $jumlahPerolehan,
                    'nama_bulan' =>  $months[(int)$BulanPerolehan],
                ]);
            }
        }
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
}
