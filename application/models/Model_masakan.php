<?php
class Model_masakan extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('masakan');
    }

    public function tambah_masakan($data, $table)
    {
        $this->db->insert($table, $data);
    }
    public function edit_masakan($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function hapus_masakan($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function find($id_masakan)
    {
        $result = $this->db->where('id_masakan', $id_masakan)
            ->limit(1)
            ->get('masakan');
        
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }
    public function detail($id_masakan){
        $result = $this->db->where('id_masakan', $id_masakan)->get('masakan');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
}
