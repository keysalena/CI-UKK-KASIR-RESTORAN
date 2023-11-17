<?php

//use PgSql\Result;

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('id_level') != 5) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
Belum Login!!             
            </div>
            ');

            // Redirect to login or another page if the condition is not met
            redirect('auth/login');
        }
    }
    public function tambah_keranjang($id_masakan)
    {
        $masakan = $this->model_masakan->find($id_masakan);

        $data = array(
            'id'      => $masakan->id_masakan,
            'qty'     => 1,
            'price'   => $masakan->harga,
            'name'    => $masakan->nama_masakan,
        );

        $this->cart->insert($data);
        redirect('welcome');
    }
    public function detail_keranjang()
    {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('template/footer');
        $this->load->view('keranjang');
    }
    public function hapus()
    {
        $this->cart->destroy();
        redirect('welcome');
    }
    public function hapus_id($id)
    {
        $cart_content = $this->cart->contents();

        foreach ($cart_content as $item) {
            if ($item['id'] == $id) {
                $data = array('rowid' => $item['rowid'], 'qty' => 0);
                $this->cart->update($data);
                break;
            }
        }

        redirect('dashboard/detail_keranjang');
    }
    public function bayar()
    {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('template/footer');
        $this->load->view('bayar');
    }
    public function proses()
    {
        $is_processed = $this->model_invoice->index();
        if ($is_processed) {
            $this->cart->destroy();
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('template/footer');
            $this->load->view('proses');
        } else {
            echo "Maaf, Pesanan Anda Gagal diproses";
        }
    }
    public function tambah_pembelian($id_masakan)
    {
        $masakan = $this->model_masakan->find($id_masakan);

        $data = array(
            'id'      => $masakan->id_masakan,
            'qty'     => 0,
            'price'   => $masakan->harga,
            'name'    => $masakan->nama_masakan,
        );

        $this->cart->insert($data);

        foreach ($this->cart->contents() as $item) {
            if ($item['id'] == $masakan->id_masakan) {
                $new_qty = $this->input->post('pembelian');
                $this->cart->update(array('rowid' => $item['rowid'], 'qty' => $new_qty));
                break;
            }
        }

        redirect('dashboard/detail_keranjang');
    }
    public function index()
    {
        $data['masakan'] = $this->model_masakan->tampil_data()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }
}
