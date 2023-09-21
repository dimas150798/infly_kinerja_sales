<?php

$months = array(1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember');


class M_DataTerminasi extends CI_Model
{
    public function index()
    {
        $getPerolehanAktif = $this->db->query("
        SELECT COUNT(id_sheet) AS jumlah_aktif FROM data_sheet WHERE status = 'active';
        ")->result_array();

        $getPerolehanTerminasi = $this->db->query("
        SELECT COUNT(id_sheet) AS jumlah_terminasi FROM data_sheet WHERE status = 'terminated';
        ")->result_array();

        $getPerolehanSurvey = $this->db->query("
        SELECT COUNT(id_sheet) AS jumlah_survey FROM data_sheet WHERE status = 'Survey';
        ")->result_array();

        $getPerolehanPending = $this->db->query("
        SELECT COUNT(id_sheet) AS jumlah_pending FROM data_sheet WHERE status = 'Pending';
        ")->result_array();

        $getPerolehanNeedDistribution = $this->db->query("
        SELECT COUNT(id_sheet) AS jumlah_need FROM data_sheet WHERE status = 'Need Distribution';
        ")->result_array();

        foreach ($getPerolehanAktif as $dataPerolehanAktif) {
            $this->db->update("data_terminasi", ['jumlah' => $dataPerolehanAktif['jumlah_aktif']], ['keterangan' => 'Aktif']);
        }

        foreach ($getPerolehanTerminasi as $dataPerolehanTerminasi) {
            $this->db->update("data_terminasi", ['jumlah' => $dataPerolehanTerminasi['jumlah_terminasi']], ['keterangan' => 'Terminated']);
        }

        foreach ($getPerolehanSurvey as $dataPerolehanSurvey) {
            $this->db->update("data_terminasi", ['jumlah' => $dataPerolehanSurvey['jumlah_survey']], ['keterangan' => 'Survey']);
        }

        foreach ($getPerolehanPending as $dataPerolehanPending) {
            $this->db->update("data_terminasi", ['jumlah' => $dataPerolehanPending['jumlah_pending']], ['keterangan' => 'Pending']);
        }

        foreach ($getPerolehanNeedDistribution as $dataPerolehanNeedDistribution) {
            $this->db->update("data_terminasi", ['jumlah' => $dataPerolehanNeedDistribution['jumlah_need']], ['keterangan' => 'Need Distribution']);
        }
    }

    public function getData()
    {
        $query = $this->db->query("SELECT id_terminasi, keterangan, jumlah
        
        FROM data_terminasi");

        return $query->result_array();
    }
}
