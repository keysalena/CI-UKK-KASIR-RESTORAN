<?php
class Model_transaksi extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('transaksi');
    }
    public function order()
    {
        return $this->db->get('order');
    }

    public function updateKeterangan($id_order)
    {
        $this->db->set('keterangan', 'selesai');
        $this->db->where('id_order', $id_order);
        return $this->db->update('detail');
    }
    public function updateOrder($id_order)
    {
        $this->db->set('keterangan', 'sudah pesan');
        $this->db->where('id_order', $id_order);
        return $this->db->update('order');
    }

    public function getTotalHarga($id_order)
    {
        $this->db->select_sum('total', 'total_harga');
        $this->db->where('id_order', $id_order);
        $query = $this->db->get('detail');
        return $query->row()->total_harga;
    }

    public function insertTransaksi($data)
    {
        return $this->db->insert('transaksi', $data);
    }
}
