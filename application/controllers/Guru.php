<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Guru extends BaseController
{
    /**
     * This is default constructor of the class
     */
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('tcpdf');
        
        $this->isLoggedIn();
        $this->load->model('guru_model', 'pm');
        $this->load->model('people_model', 'mm');
        $this->module = 'Menu';
        $this->global['modTitle'] = $this->module;
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('transaksi/infaqMasjid');
    }
    
    function dataList(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            
            $this->global['pageTitle'] = "Data Guru";
            $pageInfo['param']='7';
            $pageInfo['inOut']='I';
            $this->loadViews2("guru/guruList", $this->global, $pageInfo , NULL, 'guru/guruModal');    
        }
    }

    public function getDataById() {
        $id = $this->input->post('id');
        $data = $this->pm->getDatabyid($id);
        echo json_encode($data);
    }

    public function getDataViewById() {
        $id = $this->input->post('id');
    
        if (!$id) {
            echo json_encode(["status" => false, "message" => "ID tidak ditemukan"]);
            return;
        }
    
        $data = $this->pm->getDatabyid($id);
    
        if ($data) {
            echo json_encode(["status" => true, "result" => $data]);
        } else {
            echo json_encode(["status" => false, "message" => "Data tidak ditemukan"]);
        }
    }

    public function getData() {
        $postData = $this->input->post();
        // debug($postData);
        $data = $this->pm->getRows($postData);
        // log_message('debug', 'Post Data: ' . print_r($postData, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }

    public function addNewTask() {
        $clean_data = $this->security->xss_clean($this->input->post());
        $foto = null;

        if (!empty($_FILES['foto']['name'])) {
            $upload = $this->doUpload('foto', 'guru');
    
            if (isset($upload['error'])) {
                $response = ["status" => false, "message" => $upload['error']];
                $this->output->set_content_type('application/json')->set_output(json_encode($response));
                return;
            } else {
                $foto = $upload['upload_data']['file_name'];
            }
        }
        $taskInfo = [
            'nama' => $clean_data['nama'],
            'type' => '1',
            'nik' => $clean_data['nik'],
            'pekerjaan' => 'Guru',
            'tempat_lahir' => $clean_data['tempat_lahir'],
            'tanggal_lahir' => $clean_data['tanggal_lahir'],
            'alamat' => $clean_data['alamat'],
            'agama' => $clean_data['agama'],
            'jenis_kelamin' => $clean_data['jenis_kelamin'],
            'no_telp' => $clean_data['no_telp'],
            'foto' => $foto,
            'createdBy' => $this->vendorId,
            'createdDtm' => date('Y-m-d H:i:s')
        ];
    
        $id_people = $this->mm->addNewTask($taskInfo);
    
        if ($id_people > 0) {
            $guruInfo = [
                'id_people' => $id_people,
                'nip' => $clean_data['nip'],
                'tanggal_masuk' => $clean_data['tanggal_masuk'],
                'createdBy' => $this->vendorId,
                'createdDtm' => date('Y-m-d H:i:s')
            ];
    
            $result2 = $this->pm->addNewTask($guruInfo);
            $response = ($result2 > 0) ? ["status" => true] : ["status" => false, "message" => "Gagal simpan guru"];
        } else {
            $response = ["status" => false, "message" => "Gagal simpan people"];
        }
    
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function updateData() {
        $clean_data = $this->security->xss_clean($this->input->post());
    
        $peopleInfo = array(
            'nama'          => trim($clean_data['nama']),
            'nik'           => trim($clean_data['nik']),
            'tempat_lahir'  => trim($clean_data['tempat_lahir']),
            'tanggal_lahir' => trim($clean_data['tanggal_lahir']),
            'alamat'        => trim($clean_data['alamat']),
            'agama'         => trim($clean_data['agama']),
            'jenis_kelamin' => trim($clean_data['jenis_kelamin']),
            'no_telp'       => trim($clean_data['no_telp']),
            'updatedBy'     => $this->vendorId,
            'updatedDtm'    => date('Y-m-d H:i:s')
        );

        $updatePeople = $this->mm->editTask($peopleInfo, $clean_data['id']);
    
        if ($updatePeople) {
            $guruInfo = array(
                'nip'           => trim($clean_data['nip']),
                'tanggal_masuk' => trim($clean_data['tanggal_masuk']),
                'updatedBy'     => $this->vendorId,
                'updatedDtm'    => date('Y-m-d H:i:s')
            );
    
            $updateGuru = $this->pm->editTask($guruInfo, $clean_data['id_guru']);
    
            $response = ($updateGuru) 
                ? ["status" => true, "message" => "Data berhasil diperbarui!"] 
                : ["status" => false, "message" => "Gagal update data guru"];
        } else {
            $response = ["status" => false, "message" => "Gagal update data people"];
        }
    
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function deleteData() {
        $clean_data = $this->security->xss_clean($this->input->post());
        $id_guru = $clean_data['id_guru'];

        $taskGuru = array(
            'isDeleted'  => '1', 
            'updatedBy'  => $this->vendorId, 
            'updatedDtm' => date('Y-m-d H:i:s')
        );
        $deleteGuru = $this->pm->editTask($taskGuru, $id_guru);

        if ($deleteGuru) {
            $response = ["status" => true, "message" => "Data berhasil dihapus!"];
        } else {
            $response = ["status" => false, "message" => "Gagal menghapus data!"];
        }
    
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function generate_pdf() {
        $id_guru = $this->input->post('id_guru');
        $clean_data = $this->pm->getDatabyid($id_guru);
        
        if (!$clean_data) {
            echo json_encode(['status' => 'error', 'message' => 'Data guru tidak ditemukan.']);
            return;
        }
    
        $data['nama'] = $clean_data->nama;
        $data['nip'] = $clean_data->nip; 
        $data['pekerjaan'] = 'Guru';
        $data['tempat_lahir'] = $clean_data->tempat_lahir;
        $data['tanggal_lahir'] = $clean_data->tanggal_lahir;
        $data['alamat'] = $clean_data->alamat;
        $data['agama'] = $clean_data->agama;
        $data['jenis_kelamin'] = $clean_data->jenis_kelamin;
        $data['no_telp'] = $clean_data->no_telp;
        $data['foto'] = $clean_data->foto;

        $html = $this->load->view('guru/cv_template', $data, TRUE);
    
        // echo ($html);
        $this->load->library('tcpdf');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
    
        // Menonaktifkan Header & Footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->SetMargins(10, 0, 10);
        $pdf->SetAutoPageBreak(TRUE, 10);
        
        // Menambahkan halaman
        $pdf->AddPage();
    
        $pdf->writeHTML($html, true, false, true, false, '');
        $file_path = FCPATH . 'files/pdf/CV-' . $data['nama'] . '.pdf';
    
        if (!is_dir(FCPATH . 'files/pdf/')) {
            mkdir(FCPATH . 'files/pdf/', 0777, true);
        }
    
        $pdf->Output($file_path, 'F');
        if (file_exists($file_path)) {
            $file_url = base_url('files/pdf/' . basename($file_path));
            echo json_encode([
                'status' => 'success',
                'message' => 'PDF berhasil disimpan.',
                'file_url' => $file_url
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal menyimpan PDF!'
            ]);
        }
    }
    
}

?>