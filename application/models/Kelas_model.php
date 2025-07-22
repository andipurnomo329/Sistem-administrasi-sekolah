<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
    protected $table = 'tbl_kelas';
    protected $kolom = 'id_kelas,nama_kelas,tingkat,jurusan,tahun_ajaran';

    protected $tableTrx = 'trx_guru'; // Nama tabel
    protected $kolomTrx = ['id_guru']; // Kolom yang dipilih

    public function getRows($postData) {
        // debug($postData['listKolom']);
        $response = array();
        $whereArray = array('isDeleted' => 0 );
        
        if(isset($postData['tahun_ajaran'])){
            $param = array('tahun_ajaran ' => $postData['tahun_ajaran']);
            $whereArray = array_merge($whereArray,$param);
        }
        ## Read value
        $columnIndex = ($postData['order'][0]['column'] == 0 ) ? 4 : $postData['order'][0]['column'] ; // Column index
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        ## Search
        $searchQuery = "";
        if($searchValue != ''){
            $searchQuery = " (nama_kelas like '%".$searchValue."%' or tahun_ajaran like '%".$searchValue."%' ) ";
        }

        ## Total number of records without filtering
        $this->db->select('count(1) as allcount');
        $this->db->from($this->table);
        $this->db->where($whereArray);
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(1) as allcount');
        $this->db->from($this->table);
        $this->db->where($whereArray);
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select($this->kolom);
        $this->db->from($this->table);
        $this->db->where($whereArray);
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($postData['columns'][$columnIndex]['data'], $columnSortOrder);
        $this->db->limit($postData['length'], $postData['start']);
        $records = $this->db->get()->result();

        // debug($postData);

        $listKolom = explode(',',$this->kolom);
        $data = [];

        foreach ($records as $record) {
            $row = [];
            foreach ($listKolom as $kolom) {
                $row[$kolom] = $record->$kolom;
            }
            $data[] = $row;
        }

        ## Response
        $response = array(
            "draw" => intval($postData['draw']),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
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