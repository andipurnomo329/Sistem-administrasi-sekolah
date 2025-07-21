<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Task_model (Task Model)
 * Task model class to get to handle task related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Transaksi_Detail_model extends CI_Model
{
    /**
     * This function is used to get the task listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */

    protected $table = 'tbl_transaksi_detail';
    protected $kolom = 'id,transaksiId,title,amount,isCash,dokumen,keterangan,isSuccess,poepleId';
        
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

    function cekHasInputPeople($post){
        $this->db->select($this->kolom);
        $this->db->from($this->table);
        $this->db->where($post);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getTotalAmountByHeaderId($transaksiId){
        $this->db->select_sum('amount');
        $this->db->select('SUM(IF(isSuccess = 1, amount, 0)) AS amountIsActive');
        $this->db->select_sum('isSuccess');
        $this->db->from($this->table);
        $this->db->where('transaksiId', $transaksiId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();

    }

    function getEventByPerson($search){
        $this->db->select('ttd.isSuccess,tp.peopleCode,tp.nama,ttd.transaksiId,ttd.id,tp.nama,tp.tanggal_lahir,tp.nik,tp.no_telp,tp.pekerjaan,tp.foto,tp.type,tp.subType,tth.title,tth.satuan,tth.isCash,tth.tanggal_transaksi,tth.amount,tth.keterangan');
        $this->db->from('tbl_people tp');
        $this->db->join('tbl_transaksi_detail ttd', 'ttd.poepleId = tp.id');
        $this->db->join('tbl_transaksi_header tth', 'tth.id = ttd.transaksiId');

        // Menambahkan kondisi untuk LIKE dan pengecekan peopleCode menggunakan grup kondisi
        $this->db->group_start();
        $this->db->like('UPPER(tp.nama)', strtoupper($search), 'both', false); // Case insensitive LIKE
        $this->db->or_where('tp.peopleCode', $search);
        $this->db->group_end();

        // Menambahkan kondisi untuk tanggal transaksi
        $this->db->where('tth.tanggal_transaksi', date('Y-m-d')); // Memformat tanggal saat ini

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
        $this->kolom = 'ttd.id,transaksiId,ttd.title,amount,isCash,dokumen,keterangan,isSuccess,poepleId,peopleCode,ttd.updatedDtm';
        $response = array();
        $whereArray = array('ttd.isDeleted' => 0, 'transaksiId' => $postData['transaksiId']);

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        ## Search
        $searchQuery = "";
        if($searchValue != ''){
            $searchQuery = " (title like '%".$searchValue."%' or peopleCode like '%".$searchValue."%' ) ";
        }

        ## Total number of records without filtering
        $this->db->select('count(1) as allcount');
        $this->db->from($this->table . ' ttd');
        $this->db->join('tbl_people tp', 'ttd.poepleId = tp.id');
        $this->db->where($whereArray);
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(1) as allcount');
        $this->db->from($this->table . ' ttd');
        $this->db->join('tbl_people tp', 'ttd.poepleId = tp.id');
        $this->db->where($whereArray);
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select($this->kolom);
        $this->db->from($this->table . ' ttd');
        $this->db->join('tbl_people tp', 'ttd.poepleId = tp.id');
        $this->db->where($whereArray);
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        foreach($records as $record ){
            $data[] = array(
                "id"=>$record->id,
                "title"=>$record->title,
                "updatedDtm"=>$record->updatedDtm,
                "isCash"=>$record->isCash,
                "peopleCode"=>$record->peopleCode,
                "poepleId"=>$record->poepleId,
                "amount"=>$record->amount,
                "isSuccess"=>$record->isSuccess,
                "transaksiId"=>$record->transaksiId,
                "dokumen"=>$record->dokumen,
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