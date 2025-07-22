<?php
class MY_Model extends CI_Model
{
    protected $table;
    protected $kolom; // string kolom: 'id,nama,tanggal'
    protected $defaultWhere = ['isDeleted' => 0];

    public function __construct()
    {
        parent::__construct();
    }

    public function getRows($postData, $additionalWhere = [],$orderDataTable)
    {
        $response = [];
        $whereArray = array_merge($this->defaultWhere, $additionalWhere);

        $columnIndex = isset($postData['order'][0]['column']) && $postData['order'][0]['column'] != 0 
        ? $postData['order'][0]['column'] 
        : $orderDataTable;
        $columnSortOrder = isset($postData['order'][0]['dir']) ? $postData['order'][0]['dir'] : 'asc';
        $searchValue = isset($postData['search']['value']) ? $postData['search']['value'] : '';

        // Search
        $searchQuery = "";
        if ($searchValue != '') {
            $searchTerms = [];
            foreach (explode(',', $this->kolom) as $kolom) {
                $searchTerms[] = "$kolom LIKE '%" . $searchValue . "%'";
            }
            $searchQuery = "(" . implode(' OR ', $searchTerms) . ")";
        }

        // Total records
        $this->db->select('COUNT(1) as allcount')->from($this->table)->where($whereArray);
        $totalRecords = $this->db->get()->row()->allcount;

        // Filtered total
        $this->db->select('COUNT(1) as allcount')->from($this->table)->where($whereArray);
        if ($searchQuery) $this->db->where($searchQuery);
        $totalRecordwithFilter = $this->db->get()->row()->allcount;

        // Fetch data
        $this->db->select($this->kolom)->from($this->table)->where($whereArray);
        if ($searchQuery) $this->db->where($searchQuery);
        $kolomList = explode(',', $this->kolom);
        $orderBy = isset($postData['columns'][$columnIndex]['data']) ? 
                $postData['columns'][$columnIndex]['data'] : 
                $kolomList[0];
        $this->db->order_by($orderBy, $columnSortOrder);
        $this->db->limit($postData['length'], $postData['start']);
        $records = $this->db->get()->result();

        // Format output
        $data = [];
        $listKolom = explode(',', $this->kolom);
        foreach ($records as $record) {
            $row = [];
            foreach ($listKolom as $kolom) {
                $row[$kolom] = $record->$kolom;
            }
            $data[] = $row;
        }

        return [
            "draw" => intval($postData['draw']),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        ];
    }
}

?>