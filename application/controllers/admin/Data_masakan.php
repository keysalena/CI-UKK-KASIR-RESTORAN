<?php

class Data_masakan extends CI_Controller
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
        $data['masakan'] = $this->model_masakan->tampil_data()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/data_masakan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_aksi()
    {
        $nama_masakan = $this->input->post('nama_masakan');
        $kategori = $this->input->post('kategori');
        $harga = $this->input->post('harga');
        $gambar = $_FILES['gambar']['name'];

        if ($gambar != '') {
            $config['upload_path'] = './uploads';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                echo "Gambar gagal diupload!!";
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }

        $data = array(
            'nama_masakan' => $nama_masakan,
            'kategori' => $kategori,
            'harga' => $harga,
            'gambar' => $gambar
        );

        $this->model_masakan->tambah_masakan($data, 'masakan');
        redirect('admin/data_masakan/index');
    }

    public function edit_aksi($id_masakan)
    {
        $id_masakan = $this->input->post('id_masakan');
        $nama_masakan = $this->input->post('nama_masakan');
        $kategori = $this->input->post('kategori');
        $harga = $this->input->post('harga');
        $data = array(
            'nama_masakan' => $nama_masakan,
            'kategori' => $kategori,
            'harga' => $harga,
            // 'gambar' => $gambar
        );

        $where = array(
            'id_masakan' => $id_masakan
        );

        // Add processing for image if needed

        $this->model_masakan->edit_masakan($where, $data, 'masakan');
        redirect('admin/data_masakan/index');
    }
    public function hapus_aksi($id_masakan)
    {
        $where = array(
            'id_masakan' => $id_masakan
        );
        $this->model_masakan->hapus_masakan($where, 'masakan');
        redirect('admin/data_masakan/index');
    }
}
