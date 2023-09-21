<?php

$months = array(1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember');


class M_DataPerolehan extends CI_Model
{
    public function index()
    {
        date_default_timezone_set("Asia/Jakarta");
        $bulan                          = date("m");
        $bulan_m1                       = date("m", strtotime("-1 months"));
        $bulan_m2                       = date("m", strtotime("-2 months"));
        $bulan_m3                       = date("m", strtotime("-3 months"));
        $tahun                          = date("Y");

        $getPerolehan = $this->db->query("
        SELECT id_perolehan, bulan_perolehan, jumlah_perolehan, kode_YearMonth FROM data_perolehan
        ")->result_array();

        $getMonthNow = $this->db->query("
        SELECT kode_YearMonth, count(kode_sheet) AS jumlah
        FROM data_sheet
        
        WHERE status = 'active' AND  nama_customer != '' 
        AND year_cust = '$tahun' AND month_cust = '$bulan'
        ")->result_array();

        $getMonthM1 = $this->db->query("
        SELECT kode_YearMonth, count(kode_sheet) AS jumlah
        FROM data_sheet
        
        WHERE status = 'active' AND  nama_customer != '' 
        AND year_cust = '$tahun' AND month_cust = '$bulan_m1'
        ")->result_array();

        $getMonthM2 = $this->db->query("
        SELECT kode_YearMonth, count(kode_sheet) AS jumlah
        FROM data_sheet
        
        WHERE status = 'active' AND  nama_customer != '' 
        AND year_cust = '$tahun' AND month_cust = '$bulan_m2'
        ")->result_array();

        $getMonthM3 = $this->db->query("
        SELECT kode_YearMonth, count(kode_sheet) AS jumlah
        FROM data_sheet
        
        WHERE status = 'active' AND  nama_customer != '' 
        AND year_cust = '$tahun' AND month_cust = '$bulan_m3'
        ")->result_array();

        // Month Now
        foreach ($getMonthNow as $data1) {
            $status = false;

            $months = array(1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember');

            foreach ($getPerolehan as $perolehan) {
                if ($data1['kode_YearMonth'] == $perolehan['kode_YearMonth']) {
                    $status = true;
                    $this->db->update("data_perolehan", ['jumlah_perolehan' => $data1['jumlah']], ['kode_YearMonth' => $perolehan['kode_YearMonth']]);
                }
            }

            if ($status == false) {
                $this->db->insert("data_perolehan", [
                    "bulan_perolehan"     => $months[(int)$bulan],
                    "jumlah_perolehan"    => $data1['jumlah'],
                    "kode_YearMonth"      => $data1['kode_YearMonth']
                ]);
            }
        }

        // Month Now -1
        foreach ($getMonthM1 as $data2) {
            $status = false;

            foreach ($getPerolehan as $perolehan) {
                if ($data2['kode_YearMonth'] == $perolehan['kode_YearMonth']) {
                    $status = true;
                    $this->db->update("data_perolehan", ['jumlah_perolehan' => $data2['jumlah']], ['kode_YearMonth' => $perolehan['kode_YearMonth']]);
                }
            }

            if ($status == false) {
                $this->db->insert("data_perolehan", [
                    "bulan_perolehan"     => $months[(int)$bulan_m1],
                    "jumlah_perolehan"    => $data2['jumlah'],
                    "kode_YearMonth"      => $data2['kode_YearMonth']
                ]);
            }
        }

        // Month Now -2
        foreach ($getMonthM2 as $data3) {
            $status = false;

            foreach ($getPerolehan as $perolehan) {
                if ($data3['kode_YearMonth'] == $perolehan['kode_YearMonth']) {
                    $status = true;
                    $this->db->update("data_perolehan", ['jumlah_perolehan' => $data3['jumlah']], ['kode_YearMonth' => $perolehan['kode_YearMonth']]);
                }
            }

            if ($status == false) {
                $this->db->insert("data_perolehan", [
                    "bulan_perolehan"     => $months[(int)$bulan_m2],
                    "jumlah_perolehan"    => $data3['jumlah'],
                    "kode_YearMonth"      => $data3['kode_YearMonth']
                ]);
            }
        }

        // Month Now -3
        foreach ($getMonthM3 as $data4) {
            $status = false;

            foreach ($getPerolehan as $perolehan) {
                if ($data4['kode_YearMonth'] == $perolehan['kode_YearMonth']) {
                    $status = true;
                    $this->db->update("data_perolehan", ['jumlah_perolehan' => $data4['jumlah']], ['kode_YearMonth' => $perolehan['kode_YearMonth']]);
                }
            }

            if ($status == false) {
                $this->db->insert("data_perolehan", [
                    "bulan_perolehan"     => $months[(int)$bulan_m3],
                    "jumlah_perolehan"    => $data4['jumlah'],
                    "kode_YearMonth"      => $data4['kode_YearMonth']
                ]);
            }
        }
    }

    public function getData()
    {
        $query = $this->db->query("SELECT id_perolehan, 
        bulan_perolehan, jumlah_perolehan, kode_YearMonth 
        
        FROM data_perolehan
        
        ORDER BY kode_YearMonth ASC");

        return $query->result_array();
    }
}
