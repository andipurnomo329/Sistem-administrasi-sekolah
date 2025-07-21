<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class People_model extends CI_Model
{
    protected $table = 'tbl_people';

    function taskListingCount($searchText)
    {
        $this->db->select('id');
        $this->db->from($this->table.' as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nama LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    function taskListing($searchText, $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.nama, BaseTbl.alamat, BaseTbl.tanggal_lahir, BaseTbl.jenis_kelamin, BaseTbl.no_telp,foto,pekerjaan,subType');
        $this->db->from( $this->table.' as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    function addNewTask($taskInfo)
    {
        // debug($taskInfo);
        $this->db->trans_start();
        $this->db->insert($this->table, $taskInfo);
        
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    function getTaskInfo($taskId)
    {
        $this->db->select('id, nama, nik, alamat, tempat_lahir,tanggal_lahir, jenis_kelamin, no_telp,pekerjaan,subType,foto,type,peopleCode');
        $this->db->from($this->table);
        $this->db->where('id', $taskId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function getByArrayId($id)
    {
        $this->db->select('id, nama, nik, alamat, tempat_lahir,tanggal_lahir, jenis_kelamin, no_telp,pekerjaan,subType,foto,type,peopleCode');
        $this->db->from($this->table);
        $this->db->where('isDeleted', 0);
        $this->db->where_in('id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function getPeopleByCode($code)
    {
        $this->db->select('id, upper(nama) nama, nik, alamat, tempat_lahir,tanggal_lahir, jenis_kelamin, no_telp,pekerjaan,subType,foto,type,peopleCode');
        $this->db->from($this->table);
        $this->db->where('peopleCode', $code);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    
    function editTask($taskInfo, $taskId)
    {
        $this->db->where('id', $taskId);
        $this->db->update($this->table, $taskInfo);
        
        return TRUE;
    }
    
    public function getRows($postData) {
        $response = array();
        $whereArray = array('isDeleted' => 0 );
        
        if(isset($postData['type'])){
            $paramId = array('type' => $postData['type']);
            $whereArray = array_merge($whereArray,$paramId);
        }
        
        if(isset($postData['param'])){
            $paramId = array('paramId' => $postData['param']);
            $whereArray = array_merge($whereArray,$paramId);
        }
        if(isset($postData['param'])){
            $paramId = array('paramId' => $postData['param']);
            $whereArray = array_merge($whereArray,$paramId);
        }
        if(isset($postData['subType'])){
            $paramId = array('subType >' => $postData['subType']);
            $whereArray = array_merge($whereArray,$paramId);
        }
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = ($postData['order'][0]['column'] == 0 ) ? 1 : $postData['order'][0]['column'] ; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        ## Search
        $searchQuery = "";
        if($searchValue != ''){
            $searchQuery = " (nama like '%".$searchValue."%' or peopleCode like '%".$searchValue."%' ) ";
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
        $this->db->select('id,upper(nama) as nama,alamat,nik,tempat_lahir,tanggal_lahir,jenis_kelamin,no_telp,peopleCode, type, subType');
        $this->db->from($this->table);
        $this->db->where($whereArray);
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        // debug($postData);

        $data = array();

        foreach($records as $record ){
            $data[] = array(
                "id"=>$record->id,
                "nama"=>$record->nama,
                "alamat"=>$record->alamat,
                "type"=>$record->type,
                "subType"=>$record->subType,
                "peopleCode"=>$record->peopleCode,
                "tempat_lahir"=>$record->tempat_lahir,
                "tanggal_lahir"=>$record->tanggal_lahir,
                "jenis_kelamin"=>$record->jenis_kelamin,
                "no_telp"=>$record->no_telp,
                "nik"=>$record->nik
        
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }
}