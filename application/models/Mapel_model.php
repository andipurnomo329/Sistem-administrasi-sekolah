<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mapel_model extends MY_Model
{
    protected $table = 'tbl_mapel';
    protected $kolom = 'id,nama,keterangan';

    public function getDataTable($postData)
    {
        return $this->getRows($postData, [], 1);
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
        $this->db->where('id', $id);
        $this->db->update($this->table, $taskInfo);
        
        return TRUE;
    }

}