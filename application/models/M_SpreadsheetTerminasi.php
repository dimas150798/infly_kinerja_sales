<?php


class M_SpreadsheetTerminasi extends CI_Model
{
    public function index()
    {
        $response = [];

        $json_string = 'https://script.google.com/macros/s/AKfycby-6TuWIw5bh5HVwFF-l5EQj-TW_OlcMzYcvtPtks67YMB90-fJCLO5XsikVl5coZK-Mw/exec';
        $jsondata = file_get_contents($json_string);
        $obj = json_decode($jsondata, TRUE);

        $arrayObj = count($obj);


        $getData = $this->db->query("SELECT id_terminasi_sheets, kode_terminasi_sheets, nama_pelanggan, tanggal_registrasi, tanggal_terminasi, nama_sales, area, keterangan FROM terminasi_sheets")->result_array();

        for ($i = 0; $i < $arrayObj; $i++) {
            $status = false;

            if (!empty($obj[$i]['nama_sales']) && !empty($obj[$i]['area'])) {
                foreach ($getData as $value) {
                    if ($obj[$i]['no'] == $value['kode_terminasi_sheets'] && $obj[$i]['nama_sales'] == $value['nama_sales']) {
                        $status = true;

                        $TanggalRegistrasi = $obj[$i]['tanggal_registrasi'];
                        $TanggalTerminasi = $obj[$i]['tanggal_terminasi'];

                        // Memisahkan Tanggal Terminasi
                        $pecahDay       = explode("-", $TanggalTerminasi);

                        // Kode Perolehan Tanggal Sekarang
                        $KodeTerminasi  = $pecahDay[0] . '-' . $pecahDay[1];

                        // Calculate the difference in months between tanggal_registrasi and tanggal_terminasi
                        $diff = date_diff(new DateTime($TanggalRegistrasi), new DateTime($TanggalTerminasi));
                        $diffInMonths = $diff->y * 12 + $diff->m;

                        if ($diffInMonths >= 0 && $diffInMonths <= 5) {
                            $status = 'Kurang Dari';
                        } else {
                            $status = 'Lebih Dari';
                        }

                        $updateData = [
                            'kode_terminasi_sheets' => $obj[$i]['no'],
                            'nama_pelanggan' => $obj[$i]['nama_pelanggan'],
                            'tanggal_registrasi' => $obj[$i]['tanggal_registrasi'],
                            'tanggal_terminasi' => $obj[$i]['tanggal_terminasi'],
                            'nama_sales' => $obj[$i]['nama_sales'],
                            'area' => $obj[$i]['area'],
                            'keterangan' => $obj[$i]['keterangan'],
                            'jumlah_month' => $diffInMonths,
                            'status' => $status,
                            'kode_terminasi' => $KodeTerminasi
                        ];

                        // Memperbarui data
                        $this->db->where('id_terminasi_sheets', $value['id_terminasi_sheets']);
                        $this->db->update('terminasi_sheets', $updateData);
                    }
                }
            }

            if (!empty($obj[$i]['nama_sales']) && !empty($obj[$i]['area'])) {
                if (!$status && !empty($obj[$i]['no'])) {

                    $TanggalRegistrasi = $obj[$i]['tanggal_registrasi'];
                    $TanggalTerminasi = $obj[$i]['tanggal_terminasi'];

                    // Memisahkan Tanggal Terminasi
                    $pecahDay       = explode("-", $TanggalTerminasi);

                    // Kode Perolehan Tanggal Sekarang
                    $KodeTerminasi  = $pecahDay[0] . '-' . $pecahDay[1];

                    // Calculate the difference in months between tanggal_registrasi and tanggal_terminasi
                    $diff = date_diff(new DateTime($TanggalRegistrasi), new DateTime($TanggalTerminasi));
                    $diffInMonths = $diff->y * 12 + $diff->m;

                    if ($diffInMonths >= 0 && $diffInMonths <= 5) {
                        $status = 'Kurang Dari';
                    } else {
                        $status = 'Lebih Dari';
                    }

                    $insertData = [
                        'kode_terminasi_sheets' => $obj[$i]['no'],
                        'nama_pelanggan' => $obj[$i]['nama_pelanggan'],
                        'tanggal_registrasi' => $obj[$i]['tanggal_registrasi'],
                        'tanggal_terminasi' => $obj[$i]['tanggal_terminasi'],
                        'nama_sales' => $obj[$i]['nama_sales'],
                        'area' => $obj[$i]['area'],
                        'keterangan' => $obj[$i]['keterangan'],
                        'jumlah_month' => $diffInMonths,
                        'status' => $status,
                        'kode_terminasi' => $KodeTerminasi
                    ];

                    // Menyisipkan data baru
                    $this->db->insert("terminasi_sheets", $insertData);
                }
            }
        }
    }
}
