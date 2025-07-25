<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Guru_model extends CI_Model
{
    protected $table = 'tbl_guru';
    protected $kolom = 'id_guru,id_people,nip,tanggal_masuk';

    protected $tableJoin = 'tbl_people';
    protected $kolomJoin = 'id,nama,nik,jenis_kelamin';
    protected $kolomPeople = 'id,nama,nik,jenis_kelamin,alamat,tempat_lahir,tanggal_lahir,no_telp,jenis_kelamin,agama,foto';


    public function getRows($postData) {
        $response = array();
        $whereArray = array('tbl_guru.isDeleted' => 0 );
        
        ## Read value
        $columnIndex = ($postData['order'][0]['column'] == 0 ) ? 4 : $postData['order'][0]['column'] ;
        $columnSortOrder = $postData['order'][0]['dir'];
        $searchValue = $postData['search']['value'];

        ## Search
        $searchQuery = "";
        if($searchValue != ''){
            $searchQuery = " (nama like '%".$searchValue."%' or nip like '%".$searchValue."%' ) ";
        }

        ## Total number of records without filtering
        $this->db->select('COUNT(1) as allcount');
        $this->db->from($this->table);
        $this->db->join($this->tableJoin, "$this->tableJoin.id = $this->table.id_people", 'left');
        $this->db->where($whereArray);
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of records with filtering
        $this->db->select('COUNT(1) as allcount');
        $this->db->from($this->table);
        $this->db->join($this->tableJoin, "$this->tableJoin.id = $this->table.id_people", 'left');
        $this->db->where($whereArray);
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }
        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        // $this->db->select($this->kolom . ',' . $this->kolomJoin); // Gabungkan kolom dari kedua tabel
        // $this->db->from($this->table);
        // $this->db->join($this->tableJoin, "$this->tableJoin.id = $this->table.id_people", 'left');
        // $this->db->where($whereArray);
        // if ($searchQuery != '') {
        //     $this->db->where($searchQuery);
        // }
        // $this->db->order_by($postData['columns'][$columnIndex]['data'], $columnSortOrder);
        // $this->db->limit($postData['length'], $postData['start']);
        // $records = $this->db->get()->result();

        $this->db->select("$this->kolom, $this->kolomJoin, 
        CASE 
            WHEN jenis_kelamin = 'P' THEN 'Laki-laki' 
            WHEN jenis_kelamin = 'W' THEN 'Perempuan' 
            ELSE 'Tidak Diketahui' 
        END as jenis_kelamin_label"); 
        $this->db->from($this->table);
        $this->db->join($this->tableJoin, "$this->tableJoin.id = $this->table.id_people", 'left');
        $this->db->where($whereArray);
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }
        $this->db->order_by($postData['columns'][$columnIndex]['data'], $columnSortOrder);
        $this->db->limit($postData['length'], $postData['start']);
        $records = $this->db->get()->result();

        // debug($postData);

        $data = array();

        foreach($records as $record ){
            $data[] = array(
                "id_guru"=>$record->id_guru,
                "id_people"=>$record->id_people,
                "nama"=>$record->nama,
                "jenis_kelamin"=>$record->jenis_kelamin,
                "tanggal_masuk"=>$record->tanggal_masuk,
                "nip"=>$record->nip,
                "nik"=>$record->nik

            );
        // debug($postData);

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

    public function getDatabyid($id)
    {
        $this->db->select($this->table . '.' . str_replace(',', ",{$this->table}.", $this->kolom) . ',' . 
        $this->tableJoin . '.' . str_replace(',', ",{$this->tableJoin}.", $this->kolomPeople));
        $this->db->from($this->table);
        $this->db->join($this->tableJoin, "{$this->tableJoin}.id = {$this->table}.id_people", 'left');
        $this->db->where("{$this->table}.id_guru", $id);
        $this->db->where("{$this->table}.isDeleted", 0);
        
        $query = $this->db->get();
        return $query->row();
    }
    
    function editTask($taskInfo, $id)
    {
        $this->db->where('id_guru', $id);
        $this->db->update($this->table, $taskInfo);
        
        return TRUE;
    }

}