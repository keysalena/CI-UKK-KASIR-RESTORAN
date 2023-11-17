<?php
class Model_kategori extends CI_Model
{
    public function makanan()
    {
        return $this->db->get_where("masakan", array('
        kategori' => 'makanan'));
    }
    public function minuman()
    {
        return $this->db->get_where("masakan", array('
        kategori' => 'minuman'));
    }
}
