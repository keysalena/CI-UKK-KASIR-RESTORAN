<?php
class Model_invoice extends CI_Model
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $nama_user = $this->input->post('nama_user');
        $no_meja = $this->input->post('no_meja');
        $total = $this->input->post('total');

        if ($no_meja < 1 || $no_meja > 40) {
            $this->session->set_flashdata('lebih', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Mohon Maaf!</strong> Nomor meja harus antara 1 dan 40. Silakan masukkan nomor meja yang valid.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
            redirect('dashboard/bayar');
        } else {
            $existingOrderQuery = $this->db
                ->where('no_meja', $no_meja)
                ->where('keterangan', 'belum pesan')
                ->get('order');

            if ($existingOrderQuery->num_rows() > 0) {
                $this->session->set_flashdata('penuh', '<div class="alert alert-warning alert-dismissible fade show" role="alert"> Mohon maaf untuk no meja ' . $no_meja. ' telah dipesan mohon masukkan ulang sesuai table yang tersedia<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                redirect('dashboard/bayar');
            } else {
                $this->db->trans_start();

                $order = array(
                    'nama_user' => $nama_user,
                    'no_meja' => $no_meja,
                    'tanggal' => date('Y-m-d H:i:s'),
                    'total_bayar' => $total,
                    'keterangan' => 'belum pesan'
                );
                $this->db->insert('order', $order);
                $id_order = $this->db->insert_id();

                if ($this->cart->total_items() > 0) {
                    foreach ($this->cart->contents() as $item) {
                        $data = array(
                            'id_order' => $id_order,
                            'nama_masakan' => $item['name'],
                            'qty' => $item['qty'],
                            'total' => $item['price'],
                            'keterangan' => 'diproses'
                        );
                        $this->db->insert('detail', $data);
                        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Pesanan Anda Berhasil Diproses !!                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
                        
                    }
                }

                $this->db->trans_complete();

                if ($this->db->trans_status() === FALSE) {
                    return FALSE;
                } else {
                    return TRUE;
                }
            }
        }
    }

    public function tampil_data()
    {
        $result = $this->db->select('order.*, MAX(detail.keterangan) as keterangan_detail')
            ->from('order')
            ->join('detail', 'order.id_order = detail.id_order', 'left')
            ->group_by('order.id_order')
            ->order_by('order.id_order', 'DESC')
            ->get();

        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function id_order($id_order)
    {
        $result = $this->db->where('id_order', $id_order)->limit(1)->get('order');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    public function id_detail_order($id_order)
    {
        $result = $this->db->where('id_order', $id_order)->get('detail');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
    public function tampil()
    {
        $result = $this->db->select('order.*, MAX(detail.keterangan) as keterangan_detail')
            ->from('order')
            ->join('detail', 'order.id_order = detail.id_order', 'left')
            ->group_by('order.id_order')
            ->order_by('order.id_order', 'DESC')
            ->get();
    
        if ($result->num_rows() > 0) {
            $data = $result->result();
    
            $filteredData = array_filter($data, function ($row) {
                return in_array($row->keterangan_detail, ['selesai', 'diproses']);
            });
    
            return $filteredData;
        } else {
            return false;
        }
    }
}
