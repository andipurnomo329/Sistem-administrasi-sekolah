<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Reporting extends BaseController
{
    /**
     * This is default constructor of the class
     */
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reporting_model', 'pm');
        $this->isLoggedIn();
        $this->module = 'Reporting';
        $this->global['modTitle'] = $this->module;
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('reporting/akun');
    }
    
    function akun(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Reporting Akun";
            $pageInfo['param']='';
            $this->loadViews2("reporting/akun", $this->global, $pageInfo , NULL, "reporting/akun" );    
        }
    }

    function yatimDuafa(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Reporting Yatim & Du'afa";
            $pageInfo['param']='';
            $this->loadViews2("reporting/yatimDuafa", $this->global, $pageInfo , NULL, "reporting/akun" );    
        }
    }

    function jemaah(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Reporting Penerimaan Jema'ah";
            $pageInfo['param']='';
            $this->loadViews2("reporting/jemaah", $this->global, $pageInfo , NULL, "reporting/akun" );    
        }
    }

    public function getYatimDuafaByPeriode() {
        $postData = $this->input->post();
        // debug($postData);exit;
        $data['datas'] = $this->pm->getYatimDuafaByPeriode($postData);
        log_message('debug', 'Post Data: ' . print_r($postData, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }

    public function getDataAkunByDate() {
        $postData = $this->input->post();
        // debug($postData);exit;
        $data['dataAkun'] = $this->pm->getDataAkunByDate($postData);
        log_message('debug', 'Post Data: ' . print_r($postData, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }

    public function getIncomeFromJemaah() {
        // debug($this->input->post());exit;
        $response['data'] = $this->pm->getIncomeFromJemaah($this->input->post());
        $response['status'] = ($response['data']) ? '200': '500';
        echo json_encode($response);
    }

    public function getPendingEvent() {
        $postData = $this->input->post();
        // debug($postData);exit;
        $data = $this->pm->getPendingEvent();
        log_message('debug', 'Post Data: ' . print_r($postData, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }

    public function getTotalAmountByHeaderId(){
        $transaksiId = $this->input->post('transaksiId');
        // debug($postData);
        $data = $this->pm->getTotalAmountByHeaderId($transaksiId);
        log_message('debug', 'Post Data: ' . print_r($data, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }
    
    public function getDataDetailTansaksi() {

        $postData = $this->input->post();
        // debug($postData);
        $data = $this->pm->getRows($postData);
        log_message('debug', 'Post Data: ' . print_r($postData, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }

    public function getDataById() {
        $id = $this->input->post('id');
        $data = $this->pm->getTaskInfo($id);
        echo json_encode($data);
    }

    public function exportAkunToExcell() {
        $this->load->library('PHPExcel');
        $postData = $this->input->post();
        $data['dataAkun'] = $this->pm->getDataAkunByDate($postData);

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
        $objPHPExcel->getActiveSheet()->mergeCells('A2:D2');

        $nom = 1;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'. $nom, 'Reporting Akun');
        $nom++;

        $objPHPExcel->getActiveSheet()->SetCellValue('A'. $nom, 'Periode : '.$postData['tgl1'].' s/d '.$postData['tgl2']);
        $nom=4;

        $objPHPExcel->getActiveSheet()->SetCellValue('A'. $nom, 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'. $nom, 'Title');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'. $nom, 'Total Pemasukan');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'. $nom, 'Total Pengeluaran');

        $nom++;
        foreach($data['dataAkun'] as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $nom, $nom - 3);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $nom, $row->title);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $nom, $row->totalIncome);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $nom, $row->totalOutcome);
            $nom++;
        }

        foreach(range('A', 'D') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $filename = 'Report_Akun_' . date('Ymd') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit; // Pastikan untuk menghentikan script setelah output
    }

    public function exportYatimDuafaToExcell() {
        $this->load->library('PHPExcel');
        $postData = $this->input->post();
        $data['dataAkun'] = $this->pm->getYatimDuafaByPeriode($postData);

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
        $objPHPExcel->getActiveSheet()->mergeCells('A2:F2');

        $nom = 1;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'. $nom, "Reporting Yatim & Dua'fa");
        $nom++;

        $objPHPExcel->getActiveSheet()->SetCellValue('A'. $nom, 'Periode : '.$postData['tgl1'].' s/d '.$postData['tgl2']);
        $nom=4;

        $objPHPExcel->getActiveSheet()->SetCellValue('A'. $nom, 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'. $nom, 'Nama');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'. $nom, 'Tanggal Lahir');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'. $nom, 'Umur (thn)');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'. $nom, 'Umur (hari)');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'. $nom, 'Total Bantuan');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'. $nom, 'Total Nominal');

        $nom++;
        foreach($data['dataAkun'] as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $nom, $nom - 3);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $nom, $row->nama);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $nom, $row->tanggal_lahir);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $nom, $row->umur_tahun);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $nom, $row->umur_hari);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $nom, $row->trx);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $nom, $row->jumlah);
            $nom++;
        }

        foreach(range('A', 'H') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $filename = 'Report_Yatim_Duafa_' . date('Ymd') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit; // Pastikan untuk menghentikan script setelah output
    }

    public function exportJemaahToExcell() {
        $this->load->library('PHPExcel');
        $postData = $this->input->post();
        $data['dataAkun'] = $this->pm->getIncomeFromJemaah($postData);

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
        $objPHPExcel->getActiveSheet()->mergeCells('A2:F2');

        $nom = 1;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'. $nom, "Reporting Pemasukan Jema'ah");
        $nom++;

        $objPHPExcel->getActiveSheet()->SetCellValue('A'. $nom, 'Periode : '.$postData['tgl1'].' s/d '.$postData['tgl2']);
        $nom=4;

        $objPHPExcel->getActiveSheet()->SetCellValue('A'. $nom, 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'. $nom, 'Nama');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'. $nom, 'Tanggal Lahir');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'. $nom, 'Umur (thn)');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'. $nom, 'Umur (hari)');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'. $nom, 'Total trx');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'. $nom, 'Total Nominal');

        $nom++;
        foreach($data['dataAkun'] as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $nom, $nom - 3);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $nom, $row->nama);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $nom, $row->tanggal_lahir);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $nom, $row->umur_tahun);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $nom, $row->umur_hari);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $nom, $row->totalTrx);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $nom, $row->totalAmount);
            $nom++;
        }

        foreach(range('A', 'H') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $filename = 'Report_Yatim_Duafa_' . date('Ymd') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit; // Pastikan untuk menghentikan script setelah output
    }

    public function kartuJemaah(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Cetak Kartu";
            $pageInfo['param']='';
            $this->loadViews2("reporting/kartuJemaah", $this->global, $pageInfo , NULL, "reporting/akun" );    
        }
    }
    public function print_card() {
        $post = $this->input->post();
        $data_array = json_decode($post['data'], true);
        $ids = array_column($data_array, 'id');
        // debug($data_array); die;
        $this->load->model('People_model', 'peo');
        $data['people'] = $this->peo->getByArrayId($ids);; // Ambil semua data orang
        // debug($data);die;
        $this->load->view('reporting/print_card', $data); // Tampilkan view kartu nama
    }
    
}

?>