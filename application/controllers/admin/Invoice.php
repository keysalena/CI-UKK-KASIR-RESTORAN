<?php

class Invoice extends CI_Controller
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
        $data['detail'] = $this->model_invoice->tampil_data();
        $data['order'] = $this->model_invoice->tampil_data();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/invoice', $data);
        $this->load->view('templates/footer');
    }
    public function detail($id_order)
    {
        $data['order'] = $this->model_invoice->id_order($id_order);
        $data['detail'] = $this->model_invoice->id_detail_order($id_order);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/detail', $data);
        $this->load->view('templates/footer');
    }

}
