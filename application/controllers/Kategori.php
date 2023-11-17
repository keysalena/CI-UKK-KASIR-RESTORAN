<?php

class Kategori extends CI_Controller
{
    public function makanan()
    {
        $data['makanan'] = $this->model_kategori->makanan()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('template/footer');
        $this->load->view('kategori/makanan', $data);
    }
    public function minuman()
    {
        $data['minuman'] = $this->model_kategori->minuman()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('template/footer');
        $this->load->view('kategori/minuman', $data);
    }
}