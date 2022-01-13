<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        if ($this->load->form_validation()->run) {
            $this->load->view('templates/authheader');
            $this->load->view('auth/login');
            $this->load->view('templates/authFotter');
        }
    }
}
