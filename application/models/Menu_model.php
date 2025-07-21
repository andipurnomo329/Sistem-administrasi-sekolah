<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    protected $table = 'tbl_menu';
    protected $kolom = 'id,nama,url,icon,parent_id';

    public function getRows($postData) {
        $response = array();
        $whereArray = array('isDeleted' => 0 );
        
        if(isset($postData['subType'])){
            $paramId = array('subType >' => $postData['subType']);
            $whereArray = array_merge($whereArray,$paramId);
        }
        ## Read value
        $columnIndex = ($postData['order'][0]['column'] == 0 ) ? 4 : $postData['order'][0]['column'] ; // Column index
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        ## Search
        $searchQuery = "";
        if($searchValue != ''){
            $searchQuery = " (nama like '%".$searchValue."%' or url like '%".$searchValue."%' ) ";
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

        $data = array();

        foreach($records as $record ){
            $data[] = array(
                "id"=>$record->id,
                "nama"=>$record->nama,
                "url"=>$record->url,
                "icon"=>$record->icon,
                "parent_id"=>$record->parent_id
        
            );
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

    function getDataMenuActive()
    {
        $this->db->select($this->kolom);
        $this->db->from($this->table);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getDatabyid($id)
    {
        $this->db->select($this->kolom);
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }

    function editTask($taskInfo, $id)
    {
        // debug($taskInfo);die;
        $this->db->where('id', $id);
        $this->db->update($this->table, $taskInfo);
        
        return TRUE;
    }

    function getMenuByRoleId($postData)
    {
        $this->db->select('tm.nama, tm.parent_id ,tm.id as tmId, tmr.id as tmrId, tmr.roleId, tmr.canView, tmr.canCreate, tmr.canUpdate, tmr.canDelete');
        $this->db->from('tbl_menu tm');
        $this->db->join('tbl_matrix_roles tmr', 'tm.id = tmr.MenuId AND tmr.roleId = '.$postData['roleId'], 'left');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function updateMatrix($postData, $id){
        // debug($postData);
        $this->db->where('id', $id);
        $update = $this->db->update('tbl_matrix_roles', $postData);
        
        return $id;
    }
    function insertMatrix($postData){
        $this->db->trans_start();
        $this->db->insert('tbl_matrix_roles', $postData);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
}