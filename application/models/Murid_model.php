<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Murid_model extends CI_Model
{
    protected $table = 'tbl_murid';
    protected $kolom = 'id,nama,nis,nik,jenis_kelamin,tanggal_lahir,namaWaliMurid,foto,agama,tempat_lahir,alamat,no_telp,namaIbuKandung,namaAyahKandung,pekerjaanWali,tanggalMasuk,tanggalPendaftaran';

    public function getRows($postData) {
        $response = array();
        $whereArray = array('isDeleted' => 0 );
        
        if(isset($postData['tambahan'])){
            if($postData['tambahan'] == 1){
                $param1 = array('tanggalPendaftaran IS NOT NULL' => null);
                $param2 = array( 'tanggalMasuk IS NULL' => null);
                $whereArray = $whereArray + $param1 + $param2 ;
            }else{
                $param2 = array( 'tanggalMasuk IS NOT NULL' => null);
                $whereArray = $whereArray + $param2 ;
            }
        }
        ## Read value
        $columnIndex = ($postData['order'][0]['column'] == 0 ) ? 1 : $postData['order'][0]['column'] ; // Column index
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        ## Search
        $searchQuery = "";
        if($searchValue != ''){
            $searchQuery = " (nama like '%".$searchValue."%' or nis like '%".$searchValue."%' ) ";
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
        $kolom = explode(',', $this->kolom);
        // debug($kolom);
        foreach($records as $record ){
            $datas = new stdClass();
            $today = new DateTime(); // Hari ini
            $birthdate = new DateTime($record->tanggal_lahir);
            $umur = $today->diff($birthdate);
            $datas->umur = $umur->y.' thn '. $umur->m . ' bln';

            foreach ($kolom as $key => $value) {
                $datas->$value = $record->$value;
            }
            // debug($datas);
            array_push($data, $datas);
            
        }
        // debug($data);exit;
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

}