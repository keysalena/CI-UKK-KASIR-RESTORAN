<?php
class Model_invoice extends CI_Model
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $nama_user = $this->input->post('nama_user');
        $no_meja = $this->input->post('no_meja');
        $total = $this->input->post('total');

        $order = array(
            'nama_user' => $nama_user,
            'no_meja' => $no_meja,
            'tanggal' => date('Y-m-d H:i:s'),
            'total_bayar' => $total,
            'keterangan' => "belum pesan"
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
                    'keterangan' => "diproses"
                );
                $this->db->insert('detail', $data);
            }
            return TRUE;
        } else {
            return FALSE; // No items in the cart
        }
    }
    public function tampil_data()
    {
        $result = $this->db->get('order');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
    public function id_order($id_order){
        $result = $this->db->where('id_order', $id_order)->limit(1)->get('order');
        if ($result->num_rows() > 0) {
            return $result->row();
        }else{
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
}
