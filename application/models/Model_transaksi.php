<?php
class Model_transaksi extends CI_Model
{
    public function tampil_data()
    {
        $result = $this->db->select('*')
            ->from('transaksi')
            ->where('keterangan', 'selesai')
            ->order_by('transaksi.id_transaksi', 'DESC')
            ->get();

        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
    public function order()
    {
        $this->db->select('*');
        $this->db->from('order');
        $this->db->where('keterangan', 'belum pesan');
        $query = $this->db->get();
        return $query->result();
    }

    public function updateKeterangan($id_order, $keterangan)
    {
        $this->db->set('keterangan', $keterangan);
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
