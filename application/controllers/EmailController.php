<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailController extends CI_Controller {

    public function sendEmail()
    {
        $this->load->library('email');

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'sandbox.smtp.mailtrap.io',
            'smtp_port' => 2525,
            'smtp_user' => '2a3f78818f7c0e',
            'smtp_pass' => 'ec86c6a1e113dd',
            'crlf' => "\r\n",
            'newline' => "\r\n"
          );

        $this->email->initialize($config);

        $this->email->from('adminEase@gmail.com', 'ADMINISTRATOR');
        $this->email->to('jhee.ananda@gmail.com');
        $this->email->subject('Test Email from CodeIgniter');
        $this->email->message('This is a test email sent from CodeIgniter using Gmail SMTP.');

        if ($this->email->send()) {
            echo 'Email successfully sent!';
        } else {
            show_error($this->email->print_debugger());
        }
    }
}
