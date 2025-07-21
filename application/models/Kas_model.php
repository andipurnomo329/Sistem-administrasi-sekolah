<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Kas_model extends CI_Model
{
    /**
     * This function is used to get the task listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */

    protected $table = 'tbl_saldo_kas';
    protected $tableParam = 'tbl_param';
    protected $kolom = 'id,paramId,total_keluar,total_masuk';
           
    /**
     * This function used to get task information by id
     * @param number $taskId : This is task id
     * @return array $result : This is task information
     */
    function getSaldo($post)
    {
        $this->db->select('tp.title, tp.type, tp.description, tsk.total_masuk, tsk.total_keluar, (tsk.total_masuk - tsk.total_keluar) as saldo');
        $this->db->from('tbl_saldo_kas tsk');
        $this->db->join('tbl_param tp', 'tp.id = tsk.paramId');
        $this->db->where('tp.isDeleted', 0);
        $this->db->order_by('(tsk.total_masuk - tsk.total_keluar)', 'desc');
        $query = $this->db->get();

        return $query->result();
    }

    public function getRows($postData) {
        $response = array();
        $whereArray = array('isDeleted' => 0, 'transaksiId' => $postData['transaksiId']);

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][1]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        ## Search
        $searchQuery = "";
        if($searchValue != ''){
            $searchQuery = " (title like '%".$searchValue."%' or amount like '%".$searchValue."%' ) ";
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

        $data = array();

        foreach($records as $record ){
            $data[] = array(
                "id"=>$record->id,
                "title"=>$record->title,
                "isCash"=>$record->isCash,
                "amount"=>$record->amount,
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