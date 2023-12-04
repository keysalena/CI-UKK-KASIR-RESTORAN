<?php

class Dashboard_admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('id_level') != 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
Belum Login!!             
            </div>
            ');

            // Redirect to login or another page if the condition is not met
            redirect('auth/login');
        }
    }
    public function index()
    {
        // $data['barang'] = $this->model_barang->tampil_data()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/dashboard');
        $this->load->view('templates/footer');
        
    }
}
