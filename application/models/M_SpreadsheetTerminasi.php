<?php


class M_SpreadsheetTerminasi extends CI_Model
{
    public function index()
    {
        $response = [];

        $json_string = 'https://script.google.com/macros/s/AKfycbzY14wWun-d8Tc4R1QAcFBlwug3a_nnShIdGc0guL6PkXkHZ8F65U_ex9ZNnfeIt8Qbbw/exec';
        $jsondata = file_get_contents($json_string);
        $obj = json_decode($jsondata, TRUE);

        $arrayObj = count($obj);


        $getData = $this->db->query("SELECT id_terminasi_sheets, kode_terminasi_sheets, nama_pelanggan, tanggal_registrasi, tanggal_terminasi, nama_sales, area, keterangan FROM terminasi_sheets")->result_array();

        for ($i = 0; $i < $arrayObj; $i++) {
            $status = false;

            if (!empty($obj[$i]['nama_sales']) && !empty($obj[$i]['area'])) {
                foreach ($getData as $value) {
                    if ($obj[$i]['no'] == $value['kode_terminasi_sheets']) {
                        $status = true;

                        $KodeSheet = $value['kode_terminasi_sheets'];

                        $TanggalRegistrasi = $obj[$i]['tanggal_registrasi'];
                        $TanggalTerminasi = $obj[$i]['tanggal_terminasi'];

                        // Calculate the difference in months between tanggal_registrasi and tanggal_terminasi
                        $diff = date_diff(new DateTime($TanggalRegistrasi), new DateTime($TanggalTerminasi));
                        $diffInMonths = $diff->y * 12 + $diff->m;

                        if ($diffInMonths > 6) {
                            $status = 'Lebih Dari';
                        } else {
                            $status = 'Kurang Dari';
                        }

                        $updateData = [
                            'kode_terminasi_sheets' => $obj[$i]['no'],
                            'nama_pelanggan' => $obj[$i]['nama_pelanggan'],
                            'tanggal_registrasi' => $obj[$i]['tanggal_registrasi'],
                            'tanggal_terminasi' => $obj[$i]['tanggal_terminasi'],
                            'nama_sales' => $obj[$i]['nama_sales'],
                            'area' => $obj[$i]['area'],
                            'keterangan' => $obj[$i]['keterangan'],
                            'status' => $status
                        ];

                        // Memperbarui data
                        $this->db->where('id_terminasi_sheets', $value['id_terminasi_sheets']);
                        $this->db->update('terminasi_sheets', $updateData);
                    }
                }
            }

            if (!empty($obj[$i]['nama_sales']) && !empty($obj[$i]['area'])) {
                if (!$status && !empty($obj[$i]['no'])) {
                    $insertData = [
                        'kode_terminasi_sheets' => $obj[$i]['no'],
                        'nama_pelanggan' => $obj[$i]['nama_pelanggan'],
                        'tanggal_registrasi' => $obj[$i]['tanggal_registrasi'],
                        'tanggal_terminasi' => $obj[$i]['tanggal_terminasi'],
                        'nama_sales' => $obj[$i]['nama_sales'],
                        'area' => $obj[$i]['area'],
                        'keterangan' => $obj[$i]['keterangan']
                    ];

                    // Menyisipkan data baru
                    $this->db->insert("terminasi_sheets", $insertData);
                }
            }
        }
    }
}
