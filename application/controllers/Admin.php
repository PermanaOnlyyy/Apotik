<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Dasboard';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/dasboard', $data);
        $this->load->view('templates/footer');
    }
}
