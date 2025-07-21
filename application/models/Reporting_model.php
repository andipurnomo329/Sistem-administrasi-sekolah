<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Task_model (Task Model)
 * Task model class to get to handle task related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Reporting_model extends CI_Model
{
    /**
     * This function is used to get the task listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */

    protected $tableTransaksi = 'tbl_transaksi_header';
    protected $tableTransaksiDetail = 'tbl_transaksi_detail';
    protected $kolom = 'id,transaksiId,title,amount,isCash,dokumen,keterangan';
           
    /**
     * This function used to get task information by id
     * @param number $taskId : This is task id
     * @return array $result : This is task information
     */
    function getDataAkunByDate($post)
    {
        $this->db->select('tp.id, tp.type, tp.title, a.isCash');
        $this->db->select('
            SUM(CASE WHEN a.inOut = "I" THEN a.amount ELSE 0 END) AS totalIncome,
            SUM(CASE WHEN a.inOut = "I" THEN 1 ELSE 0 END) AS trxIncome,
            SUM(CASE WHEN a.inOut = "O" THEN a.amount ELSE 0 END) AS totalOutcome,
            SUM(CASE WHEN a.inOut = "O" THEN 1 ELSE 0 END) AS trxOutcome,
            (total_masuk - total_keluar) as saldo
        ');
        $this->db->from('tbl_transaksi_header a');
        $this->db->join('tbl_param tp', 'a.paramId = tp.id');
        $this->db->join('tbl_saldo_kas c', 'tp.id = c.paramId');
        $this->db->where('tanggal_transaksi >=', $post['tgl1']);
        $this->db->where('tanggal_transaksi <=', $post['tgl2']);
        $this->db->where('a.isCash', 1);
        $this->db->group_by(array('tp.type', 'tp.title', 'a.isCash'));

        $query = $this->db->get();

        return $query->result();
    }

    public function getYatimDuafaByPeriode($postData){
        $this->db->select('tp.nama, tp.peopleCode, tp.tanggal_lahir, ttd.poepleId,tp.nik');
        $this->db->select('TIMESTAMPDIFF(YEAR, tp.tanggal_lahir, CURDATE()) AS umur_tahun', FALSE);
        $this->db->select('DATEDIFF(CURDATE(), DATE_ADD(tp.tanggal_lahir, INTERVAL TIMESTAMPDIFF(YEAR, tp.tanggal_lahir, CURDATE()) YEAR)) AS umur_hari', FALSE);
        $this->db->select('COUNT(ttd.transaksiId) AS trx');
        $this->db->select('SUM(ttd.amount) AS jumlah');
        $this->db->from('tbl_transaksi_detail ttd');
        $this->db->join('tbl_people tp', 'tp.id = ttd.poepleId', 'inner');
        $this->db->join('tbl_transaksi_header tth', 'tth.id = ttd.transaksiId', 'inner');
        $this->db->where('ttd.isCash', 1);
        $this->db->where('ttd.isDeleted', 0);
        $this->db->where('tth.isDeleted', 0);
        $this->db->where('tanggal_transaksi >=', $postData['tgl1']);
        $this->db->where('tanggal_transaksi <=', $postData['tgl2']);
        $this->db->where('ttd.poepleId IS NOT NULL', null, false);
        $this->db->group_by(array('tp.nama', 'tp.tanggal_lahir', 'ttd.poepleId'));
        $this->db->order_by('SUM(ttd.amount) desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getPendingEvent(){
        $this->db->select('*');
        $this->db->from('v_eventTask');
        $this->db->where('amount != totalAmount');
        $query = $this->db->get();

        return $query->result();
    }
    function getIncomeFromJemaah($postData){
        $this->db->select('TIMESTAMPDIFF(YEAR, tp.tanggal_lahir, CURDATE()) AS umur_tahun', FALSE);
        $this->db->select('DATEDIFF(CURDATE(), DATE_ADD(tp.tanggal_lahir, INTERVAL TIMESTAMPDIFF(YEAR, tp.tanggal_lahir, CURDATE()) YEAR)) AS umur_hari', FALSE);
        $this->db->select('tp.nama, tp.id, tp.nik, tp.tanggal_lahir, tp.foto, tp.no_telp, tp.jenis_kelamin, tp.alamat');
        $this->db->select('COUNT(tth.id) as totalTrx, SUM(tth.amount) as totalAmount');
        $this->db->from('tbl_transaksi_header tth');
        $this->db->join('tbl_people tp', 'tth.peopleId = tp.id');
        $this->db->where('tth.isCash', 1);
        $this->db->where('tth.inOut', 'I');
        $this->db->where('tth.isDeleted', 0);
        $this->db->where('tp.isDeleted', 0);
        $this->db->where('tanggal_transaksi >=', $postData['tgl1']);
        $this->db->where('tanggal_transaksi <=', $postData['tgl2']);
        $this->db->group_by('tp.nama, tp.id, tp.nik, tp.tanggal_lahir, tp.foto, tp.no_telp, tp.jenis_kelamin, tp.alamat');
        $this->db->order_by('SUM(tth.amount) desc');

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