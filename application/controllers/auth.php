<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = "Login";
            $this->load->view('templates/authheader', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/authFotter');
        } else {
            //validasi
            $this->__login();
        }
    }

    private function __login()
    {
        $email = $this->input->post('email');
        $pass = $this->input->post('password');

        $user = $this->db->get_where('admin', ['username' => $email])->row_array();

        if ($user) {
            if (password_verify($pass, $user['password'])) {
                $data = [
                    'email' => $user['email']
                ];
                $this->session->set_userdata($data);
                redirect('admin');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password Wrong
              </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email is not registered!!!
          </div>');
            redirect('auth');
        }
    }
    public function register()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[admin.username]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
            'matches' => 'password not match',
            'is_unique' => 'this email has already registered',
            'min_length' => 'password to short'
        ]);
        $this->form_validation->set_rules('password2', 'Verif', 'required|trim|matches[password2]');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Register";
            $this->load->view('templates/authheader', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/authFotter');
        } else {
            $data = [
                'username' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT)
            ];
            $this->db->insert('admin', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Account has been registered!!
          </div>');
            redirect('auth');
        }
    }
}
