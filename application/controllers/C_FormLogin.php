<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_FormLogin extends CI_Controller
{

    // public function index()
    // {
    //     // $this->load->view('template/V_HeaderUser');
    //     // $this->load->view('template/V_SidebarUser');
    //     $this->load->view('user/V_DashboardUser');
    //     // $this->load->view('template/V_FooterUser');
    // }

    public function index()
    {
        $this->form_validation->set_rules('email_login', 'email_login', 'required');
        $this->form_validation->set_rules('password_login', 'password_login', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu');

        if ($this->form_validation->run() == false) {
            // apabila error kembali ke form login
            $this->load->view('template/V_HeaderLogin');
            $this->load->view('V_FormLogin');
            $this->load->view('template/V_FooterLogin');
        } else {
            // mengambil data dari view post
            $email_login        = $this->input->post('email_login');
            $password_login     = $this->input->post('password_login');

            // pengecheckan data login 
            $checkDataLogin     = $this->M_Login->CheckLogin($email_login, $password_login);

            if ($checkDataLogin == NULL) {
                // Notifikasi gagal login
                $this->session->set_flashdata('LoginGagal_icon', 'error');
                $this->session->set_flashdata('LoginGagal_title', 'Email atau Password Salah');

                $this->load->view('template/V_HeaderLogin');
                $this->load->view('V_FormLogin');
                $this->load->view('template/V_FooterLogin');
            } elseif ($email_login == $checkDataLogin->email_login && $checkDataLogin->id_akses == 1) {

                // Notifikasi gagal login
                $this->session->set_flashdata('CheckMikrotik_icon', 'error');
                $this->session->set_flashdata('CheckMikrotik_title', 'Email atau Password Salah');

                // Setting session login email
                $this->session->set_userdata('email', $checkDataLogin->email_login);

                redirect('superadmin/C_DashboardSuperadmin');
            } elseif ($email_login == $checkDataLogin->email_login && $checkDataLogin->id_akses == 2) {

                // Setting session login email
                $this->session->set_userdata('email', $checkDataLogin->email_login);

                redirect('user/C_DashboardUser');
            } else {
                // Notifikasi gagal login
                $this->session->set_flashdata('LoginGagal_icon', 'error');
                $this->session->set_flashdata('LoginGagal_title', 'Email atau Password Salah');

                $this->load->view('template/V_HeaderLogin');
                $this->load->view('V_FormLogin');
                $this->load->view('template/V_FooterLogin');
            }
        }
    }

    public function insertCustomer()
    {
        $this->MikrotikModel->index();
    }


    public function logout()
    {
        session_start();
        session_destroy();

        redirect('C_FormLogin');
    }
}
