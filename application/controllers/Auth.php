<?php

class Auth extends CI_Controller
{
    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header');
            $this->load->view('login');
            $this->load->view('template/footer');
        } else {
            $auth = $this->model_auth->cek_login();

            if ($auth == FALSE) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          Username atau Password Anda Salah!
          </div>
          ');
                redirect('auth/login');
            } else {
                $this->session->set_userdata('username', $auth->username);
                $this->session->set_userdata('id_level', $auth->id_level);
                $this->session->set_userdata('nama_user', $auth->nama_user);

                switch ($auth->id_level) {
                    case 1:
                        redirect('admin/dashboard_admin');
                        break;
                    case 5:
                        redirect('welcome');
                        break;
                    default:
                        break;
                }
            }
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
