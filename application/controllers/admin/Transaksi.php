<?php

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('id_level') != 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
Belum Login!!           
            </div>
            ');

            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['order'] = $this->model_transaksi->order();
        $data['transaksi'] = $this->model_transaksi->tampil_data();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/transaksi', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_aksi()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_order = $this->input->post('id_order');
            $keterangan = $this->input->post('keterangan');
            $name = $this->input->post('name');
            date_default_timezone_set('Asia/Jakarta');
            $tgl = date("Y-m-d H:i:s");

            $this->model_transaksi->updateKeterangan($id_order, $keterangan);
            $this->model_transaksi->updateOrder($id_order);

            $order_result = $this->db->select('nama_user, no_meja, total_bayar')->get_where('order', array('id_order' => $id_order))->row();

            if ($order_result) {
                $namaUser = $order_result->nama_user;
                $noMeja = $order_result->no_meja;
                $totalHarga = $order_result->total_bayar;

                $data = array(
                    'nama' => $namaUser,
                    'name' => $name,
                    'nomeja' => $noMeja,
                    'tanggal' => $tgl,
                    'total_bayar' => $totalHarga,
                    'keterangan' => $keterangan
                );

                var_dump($keterangan); 

                if ($this->model_transaksi->insertTransaksi($data)) {
                    redirect('admin/transaksi');
                } else {
                    echo "<script>alert('Data pesanan tidak ditemukan.'); window.location.href = '" . base_url('admin/transaksi') . "';</script>";
                }
            }
        }
    }
}
