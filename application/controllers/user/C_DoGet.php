<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_DoGet extends CI_Controller
{

    public function index()
    {

        $this->M_Spreadsheet->index();
        // var_dump($this->M_Spreadsheet->index());
        // die;

        // $this->M_Spreadsheet->index;
        // $this->load->view('template/V_HeaderUser');
        // $this->load->view('template/V_SidebarUser');
        // $this->load->view('user/V_DoGet');
        // $this->load->view('template/V_FooterUser');
    }
}
