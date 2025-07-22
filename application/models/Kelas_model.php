<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Kelas_model extends MY_Model
{
    protected $table = 'tbl_kelas';
    protected $kolom = 'id_kelas,nama_kelas,tingkat,jurusan,tahun_ajaran';

    protected $tableTrx = 'trx_guru'; // Nama tabel
    protected $kolomTrx = ['id_guru']; // Kolom yang dipilih

    public function __construct()
    {
        parent::__construct();
    }

    public function getKelasDataTable($postData)
    {
        $where = [];
        if (!empty($postData['tahun_ajaran'])) {
            $where['tahun_ajaran'] = $postData['tahun_ajaran'];
        }

        return $this->getRows($postData, $where, 4);
    }

    function addNewTask($taskInfo)
    {
        // debug($taskInfo);die;
        $this->db->trans_start();
        $this->db->insert($this->table, $taskInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        return $insert_id;
    }

    function getDatabyid($id)
    {
        $this->db->select($this->kolom);
        $this->db->from($this->table);
        $this->db->where('id_kelas', $id);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }

    function editTask($taskInfo, $id)
    {
        // debug($taskInfo);die;
        $this->db->where('id_kelas', $id);
        $this->db->update($this->table, $taskInfo);
        
        return TRUE;
    }

    // Transaksi Data Kelas
    function getTaskInfo($taskId)
    {
        $this->db->select($this->kolom);
        $this->db->from($this->table);
        $this->db->where('id_kelas', $taskId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }

    public function cekWaliKelas($id_guru) {
        $this->db->select($this->kolomTrx);
        $this->db->from($this->tableTrx);
        $this->db->where('id_guru', $id_guru);
        $this->db->where('isDeleted', 0); // Jika ada kolom isDeleted
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? "ada" : "tidak ada";
    }

    function addTrxKelas($taskInfo)
    {
        // debug($taskInfo);die;
        $this->db->trans_start();
        $this->db->insert($this->tableTrx, $taskInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    public function getGuruByKelas($id_kelas) {
        $this->db->trans_start();
    
        $this->db->select('id_guru');
        $this->db->from($this->tableTrx); // Gunakan variabel tabel yang sesuai
        $this->db->where('id_kelas', $id_kelas);
        $this->db->where('isDeleted', 0);
    
        $query = $this->db->get();
        $result = $query->result_array();
    
        $this->db->trans_complete();
    
        return $result;
    }

    public function getGuruByPeople($id_kelas) {
        $this->db->select('g.id_guru, p.nama AS nama_guru'); // Menggunakan alias agar lebih jelas
        $this->db->from($this->tableTrx . ' t');
        $this->db->join('tbl_guru g', 't.id_guru = g.id_guru');
        $this->db->join('tbl_people p', 'g.id_people = p.id', 'left'); // LEFT JOIN untuk menghindari error jika NULL
        $this->db->where('t.id_kelas', $id_kelas);
        return $this->db->get()->result();
    }

    // public function countSiswaByKelas($id_kelas)
    // {
    //     $this->db->where('id_kelas', $id_kelas);
    //     $this->db->where('isDeleted', 0);
    //     $this->db->from('tbl_murid'); // Sesuaikan dengan nama tabel siswa
    //     return $this->db->count_all_results();
    // }
}