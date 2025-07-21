<?php
require_once APPPATH . 'libraries/tcpdf/tcpdf.php';

class MYPDF extends TCPDF {
    // Custom Header
    public function Header() {
        // Logo Sekolah
        $image_file = K_PATH_IMAGES . 'logosekolah.png'; // Sesuaikan path gambar
        // debug($image_file);
        if (file_exists($image_file)) {
            $this->SetAlpha(0.15); // Atur transparansi ke 20% (0.2)
            $this->Image($image_file, ($this->w / 2) - 75, 70, 150, '', 'PNG', '', '', false, 300, '', false, false, 0, false, false, true);
            $this->SetAlpha(1); // Kembalikan transparansi ke normal
        }
        // $this->Image($image_file, 30, 50, 150, '', 'PNG', '', '', false, 300, '', false, false, 0, false, false, true);
        
        // Judul Header
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, date('d-m-y H:i:s'), 0, 1, 'R');
        
        // Garis bawah header
        // $this->Line(10, 20, 200, 20);
    }

    // Custom Footer
    public function Footer() {
        $this->SetY(-15); // Posisi footer dari bawah
        $this->SetFont('helvetica', 'I', 8);
        
        // Nomor halaman
        $this->Cell(0, 10, 'Halaman ' . $this->getAliasNumPage() . ' dari ' . $this->getAliasNbPages(), 0, 0, 'C');
    }
}