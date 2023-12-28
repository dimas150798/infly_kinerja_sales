<?php


class M_DataSheets extends CI_Model
{

    public function TotalPelangganAktif($KodePerolehan)
    {
        $query   = $this->db->query("SELECT id_sheet FROM data_sheets
        WHERE status_customer = 'active' AND kode_perolehan = '$KodePerolehan' ");

        return $query->num_rows();
    }

    public function TotalPelangganAktif_KBS($KodePerolehan)
    {
        $query   = $this->db->query("SELECT id_sheet FROM data_sheets
        WHERE status_customer = 'active' AND branch_customer = 'KBS' AND kode_perolehan = '$KodePerolehan' ");

        return $query->num_rows();
    }

    public function TotalPelangganAktif_TRW($KodePerolehan)
    {
        $query   = $this->db->query("SELECT id_sheet FROM data_sheets
        WHERE status_customer = 'active' AND branch_customer = 'TRW' AND kode_perolehan = '$KodePerolehan' ");

        return $query->num_rows();
    }

    public function TotalPelangganAktif_KNG($KodePerolehan)
    {
        $query   = $this->db->query("SELECT id_sheet FROM data_sheets
        WHERE status_customer = 'active' AND branch_customer = 'Kanigaran' AND kode_perolehan = '$KodePerolehan' ");

        return $query->num_rows();
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
