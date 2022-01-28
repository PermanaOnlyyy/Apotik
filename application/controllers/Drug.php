<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Drug extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'List Drug';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['supplier'] = $this->db->get('supplier')->result_array();
        $data['obat'] = $this->db->get('obat')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/drug', $data);
        $this->load->view('templates/footer');
    }
}
