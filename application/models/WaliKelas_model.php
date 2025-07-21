<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class WaliKelas_model extends CI_Model
{
    protected $table = 'view_wali_kelas';
    protected $kolom = 'trx_id,id_people,id_guru,nama_kelas,tahun_ajaran,tingkat,nama,nik,nip,tanggal_masuk,jenis_kelamin';

    public function getRows($postData) {
        $response = array();
    
        ## Read value
        $columnIndex = ($postData['order'][0]['column'] == 0 ) ? 1 : $postData['order'][0]['column']; // Column index
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
    
        ## Search
        $searchQuery = "";
        if($searchValue != ''){
            $searchQuery = " (nama LIKE '%".$searchValue."%' OR tahun_ajaran LIKE '%".$searchValue."%') ";
        }
    
        ## Total number of records without filtering
        $this->db->select('count(1) as allcount');
        $this->db->from($this->table);
        $this->db->where('trx_id IS NULL', NULL, FALSE); // Perbaikan disini
        if(isset($postData['tahun_ajaran'])){
            $this->db->where('tahun_ajaran', $postData['tahun_ajaran']);
        }
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;
    
        ## Total number of record with filtering
        $this->db->select('count(1) as allcount');
        $this->db->from($this->table);
        $this->db->where('trx_id IS NULL', NULL, FALSE);
        if(isset($postData['tahun_ajaran'])){
            $this->db->where('tahun_ajaran', $postData['tahun_ajaran']);
        }
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;
    
        ## Fetch records
        $this->db->select($this->kolom);
        $this->db->from($this->table);
        $this->db->where('trx_id IS NULL', NULL, FALSE);
        if(isset($postData['tahun_ajaran'])){
            $this->db->where('tahun_ajaran', $postData['tahun_ajaran']);
        }
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($postData['columns'][$columnIndex]['data'], $columnSortOrder);
        $this->db->limit($postData['length'], $postData['start']);
        $records = $this->db->get()->result();
    
        $data = array();
        foreach($records as $record ){
            $data[] = array(
                "nama"=>$record->nama,
                "id_guru"=>$record->id_guru,
                "nip"=>$record->nip,
                "nik"=>$record->nik,
                "tanggal_masuk"=>$record->tanggal_masuk,
                "jenis_kelamin"=>$record->jenis_kelamin,
                "trx_id"=>$record->trx_id,
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
    
 
    
}