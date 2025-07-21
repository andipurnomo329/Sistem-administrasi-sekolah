<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Tambahkan kode yang diperlukan untuk inisialisasi
    }

    // Fungsi umum yang bisa digunakan oleh semua model
    public function get_all($table) {
        return $this->db->get($table)->result();
    }

    public function get_by_id($table, $id) {
        return $this->db->where('id', $id)->get($table)->row();
    }

    public function insert($table, $data) {
        return $this->db->insert($table, $data);
    }

    public function update($table, $id, $data) {
        return $this->db->where('id', $id)->update($table, $data);
    }

    public function delete($table, $id) {
        return $this->db->where('id', $id)->delete($table);
    }
    
	function dataTableGetCount($table,$whereArray,$searchQuery){
		
        ## Total number of records without filtering
        $this->db->select('count(1) as allcount');
        $this->db->from($this->table);
        $this->db->where($whereArray);
        $records = $this->db->get()->result();
        $data['totalRecords'] = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(1) as allcount');
        $this->db->from($this->table);
        $this->db->where($whereArray);
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get()->result();
        $data['totalRecordwithFilter'] = $records[0]->allcount;
		return $data;
	}
}
