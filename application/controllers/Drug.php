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

    public function add()
    {
        $data = [
            'KODE_OBAT'  => $this->input->post('kobat'),
            'KODE_SUPPLIER'  => $this->input->post('supplier'),
            'NAMA_OBAT'  => $this->input->post('name'),
            'PRODUSEN'  => $this->input->post('produsen'),
            'HARGA'  => $this->input->post('price'),
            'JML_STOK'  => $this->input->post('stock'),
        ];
        $img_upload = $_FILES['image']['name'];
        if ($img_upload) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/img/obat/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $old_image = $data['obat']['FOTO'];
                if ($old_image != 'undraw_profile_2.svg') {
                    unlink(FCPATH . '/assets/img/OBAT/' . $old_image);
                }

                $new_image = $this->upload->data('file_name');
                $this->db->insert('FOTO', $new_image);
            }
        }
        $this->db->insert('obat ', $data);
    }
}
