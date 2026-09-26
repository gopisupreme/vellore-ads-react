<?php
class Cinema_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->db->db_debug = true;

    }

    // Fetch all cinemas from the database
    public function get_cinemas()
    {
        $query = $this->db->get('cinemas');
        return $query->result_array();
    }

    public function insert_cinema($data)
    {
        return $this->db->insert('cinemas', $data);
    }
}

