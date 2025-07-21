<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Task_model (Task Model)
 * Task model class to get to handle task related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Transaksi_model extends CI_Model
{
    /**
     * This function is used to get the task listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */

    protected $table = 'tbl_transaksi_header';
    protected $kolom = 'id, upper(title) as title, isCash, paramId, tanggal_transaksi,keterangan,keterangan,amount,inOut,dokumen,satuan';
    /**
     * This function is used to add new task to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewTask($taskInfo)
    {
        // debug($taskInfo);die;
        $this->db->trans_start();
        $this->db->insert($this->table, $taskInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get task information by id
     * @param number $taskId : This is task id
     * @return array $result : This is task information
     */
    function getTaskInfo($taskId)
    {
        $this->db->select($this->kolom);
        $this->db->from($this->table);
        $this->db->where('id', $taskId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function getMonthTransaction($postData){
        // debug($postData);
        $whereString = ' tanggal_transaksi > DATE_SUB(NOW(), INTERVAL 1 MONTH) ';

        $this->db->select_sum('amount');
        $this->db->from($this->table);
        $this->db->where('isDeleted', 0);
        $this->db->where('isCash', $postData['isCash']);
        $this->db->where('inOut', $postData['inOut']);
        $this->db->where($whereString);
        $this->db->where('tanggal_transaksi <', "NOW()", FALSE);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function nextEvent(){
        // debug($postData);
        $this->db->select($this->kolom);
        $this->db->from('tbl_transaksi_header tth');
        $this->db->where('inOut', 'O');
        $this->db->where('tanggal_transaksi >=', 'NOW()', FALSE); // FALSE untuk tidak meng-escape 'NOW()'
        
        $query = $this->db->get();
        return $query->result();
    }
    
    function todayEvent(){
        // debug($postData);
        $this->db->select($this->kolom);
        $this->db->from('tbl_transaksi_header tth');
        $this->db->where('inOut', 'O');
        $this->db->where('tanggal_transaksi', "DATE_FORMAT(NOW(),'%Y%m%d')", FALSE); // FALSE untuk tidak meng-escape 'NOW()'
        
        $query = $this->db->get();
        return $query->result();
    }

    function getTotalPendapatan3Bulan($postData){
        $selectVar = 'MONTHNAME(tanggal_transaksi) as month';
        $groupVar = 'MONTH(tanggal_transaksi)';
        if($postData['paramId'] > 0){
            $selectVar = 'tp.title ';
            $groupVar = 'a.paramId';
            $this->db->join('tbl_param tp', 'a.paramId = tp.id');
        }
        $this->db->select($selectVar);
        $this->db->select_sum('amount');
        $this->db->from($this->table.' a');
        $this->db->where('isCash', 1);
        $this->db->where('inOut', 'I');
        $this->db->where('tanggal_transaksi >=', "DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 4 MONTH), '%Y-%m-01')", FALSE);
        $this->db->where('tanggal_transaksi <', "NOW()", FALSE);
        $this->db->where('a.isDeleted', 0);
        $this->db->group_by($groupVar);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to update the task information
     * @param array $taskInfo : This is task updated information
     * @param number $taskId : This is task id
     */
    function editTask($taskInfo, $taskId)
    {
        // debug($taskInfo);die;
        $this->db->where('id', $taskId);
        $this->db->update($this->table, $taskInfo);
        
        return TRUE;
    }
    
    public function getRows($postData) {
        // debug(count($postData));
        $response = array();
        $whereArray = array('isDeleted' => 0 );
        if(isset($postData['param'])){
            $paramId = array('paramId' => $postData['param']);
            $whereArray = array_merge($whereArray,$paramId);
        }
        if(isset($postData['inOut'])){
            $paramId = array('inOut' => $postData['inOut']);
            $whereArray = array_merge($whereArray,$paramId);
        }
        if(isset($postData['peopleId'])){
            $paramId = array('peopleId' => $postData['peopleId']);
            $whereArray = array_merge($whereArray,$paramId);
        }
        if(isset($postData['isCash'])){
            $paramId = array('isCash' => $postData['isCash']);
            $whereArray = array_merge($whereArray,$paramId);
        }
        if(isset($postData['tgl1'])){
            $tglArr = array('tanggal_transaksi >='=> $postData['tgl1'], 'tanggal_transaksi <='=> $postData['tgl2']);
            $whereArray = array_merge($whereArray,$tglArr);
        }
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = ($postData['order'][0]['column'] == 0 ) ? 2 : $postData['order'][0]['column'] ; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        ## Search
        $searchQuery = "";
        if($searchValue != ''){
            $searchQuery = " (title like '%".$searchValue."%' or keterangan like '%".$searchValue."%' ) ";
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
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();
        // debug($records);exit;
        $data = array();

        foreach($records as $record ){
            $data[] = array(
                "id"=>$record->id,
                "title"=>$record->title,
                "isCash"=>$record->isCash,
                "paramId"=>$record->paramId,
                "satuan"=>$record->satuan,
                "amount"=>$record->amount,
                "inOut"=>$record->inOut,
                "tanggal_transaksi"=>$record->tanggal_transaksi,
                "keterangan"=>$record->keterangan        
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