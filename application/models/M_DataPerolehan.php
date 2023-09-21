<?php

class M_DataPerolehan extends CI_Model
{
    public function index()
    {
        date_default_timezone_set("Asia/Jakarta");

        $DataSheet = $this->db->query("SELECT kode_perolehan, COUNT(*) AS jumlah_perolehan FROM data_sheets WHERE status_customer = 'active'
                                        GROUP BY kode_perolehan ORDER BY kode_perolehan")->result_array();

        $DataPerolehan = $this->db->query("SELECT id_perolehan, kode_perolehan, jumlah_perolehan FROM perolehan_perbulan")->result_array();

        // Loop melalui data sheet
        foreach ($DataSheet as $dataSheet) {
            $status = false;

            // Loop melalui data perolehan
            foreach ($DataPerolehan as $key => $dataPerolehan) {
                if ($dataSheet['kode_perolehan'] == $dataPerolehan['kode_perolehan']) {
                    $status = true;

                    // Update jumlah perolehan
                    $DataPerolehan[$key]['jumlah_perolehan'] = $dataSheet['jumlah_perolehan'];
                    $this->db->where('kode_perolehan', $dataPerolehan['kode_perolehan']);
                    $this->db->update("perolehan_perbulan", ['jumlah_perolehan' => $dataSheet['jumlah_perolehan']]);
                }
            }

            // Jika kode perolehan tidak ditemukan, maka lakukan insert
            if ($status == false) {

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

                $KodePerolehan = $dataSheet['kode_perolehan'];

                // Memisahkan tahun dan bulan
                list($tahun, $bulan) = explode("-", $KodePerolehan);

                // Menambahkan 0 di depan bulan jika kurang dari 10
                $BulanPerolehan = sprintf("%02d", $bulan);

                // Cek apakah kode_perolehan sudah ada dalam tabel perolehan_perbulan
                $query = $this->db->get_where('perolehan_perbulan', ['kode_perolehan' => $KodePerolehan]);

                if ($query->num_rows() > 0) {
                    // Jika data sudah ada, lakukan update
                    $this->db->update("perolehan_perbulan", [
                        "jumlah_perolehan" => $dataSheet['jumlah_perolehan'],
                        "nama_bulan" => $months[(int)$BulanPerolehan],
                    ], ['kode_perolehan' => $KodePerolehan]);
                } else {
                    // Jika data belum ada, lakukan penyisipan
                    $this->db->insert("perolehan_perbulan", [
                        "kode_perolehan" => $KodePerolehan,
                        "jumlah_perolehan" => $dataSheet['jumlah_perolehan'],
                        "nama_bulan" => $months[(int)$BulanPerolehan],
                    ]);
                }
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
