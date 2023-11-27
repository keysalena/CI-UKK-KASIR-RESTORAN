<?php

class Detail_order extends CI_Controller{

    public function index()
    {
        $data['detail'] = $this->model_invoice->tampil();
        $data['order'] = $this->model_invoice->tampil();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/detail_order', $data);
        $this->load->view('templates/footer');
    }
}