<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    /**
     * Default function - List all users
     */
    public function index() {
        $data['users'] = $this->User_model->get_all_users();
        $data['title'] = 'Users Management';
        
        $this->load->view('templates/header', $data);
        $this->load->view('users/index', $data);
        $this->load->view('templates/footer');
    }

    /**
     * View single user
     */
    public function view($id = NULL) {
        $data['user'] = $this->User_model->get_user($id);
        
        if (empty($data['user'])) {
            show_404();
        }
        
        $data['title'] = 'User Details';
        
        $this->load->view('templates/header', $data);
        $this->load->view('users/view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Create new user
     */
    public function create() {
        $data['title'] = 'Create User';
        
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[100]|callback_email_check');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|max_length[20]');
        $this->form_validation->set_rules('address', 'Address', 'trim');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('users/create');
            $this->load->view('templates/footer');
        } else {
            $user_data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address')
            );
            
            if ($this->User_model->create_user($user_data)) {
                $this->session->set_flashdata('success', 'User created successfully!');
                redirect('users');
            } else {
                $this->session->set_flashdata('error', 'Error creating user. Please try again.');
                redirect('users/create');
            }
        }
    }

    /**
     * Edit user
     */
    public function edit($id = NULL) {
        $data['user'] = $this->User_model->get_user($id);
        
        if (empty($data['user'])) {
            show_404();
        }
        
        $data['title'] = 'Edit User';
        
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[100]|callback_email_check['.$id.']');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|max_length[20]');
        $this->form_validation->set_rules('address', 'Address', 'trim');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('users/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $user_data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address')
            );
            
            if ($this->User_model->update_user($id, $user_data)) {
                $this->session->set_flashdata('success', 'User updated successfully!');
                redirect('users');
            } else {
                $this->session->set_flashdata('error', 'Error updating user. Please try again.');
                redirect('users/edit/'.$id);
            }
        }
    }

    /**
     * Delete user
     */
    public function delete($id = NULL) {
        $user = $this->User_model->get_user($id);
        
        if (empty($user)) {
            show_404();
        }
        
        if ($this->User_model->delete_user($id)) {
            $this->session->set_flashdata('success', 'User deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Error deleting user. Please try again.');
        }
        
        redirect('users');
    }

    /**
     * Search users
     */
    public function search() {
        $search_term = $this->input->post('search_term');
        
        if (!empty($search_term)) {
            $data['users'] = $this->User_model->search_users($search_term);
            $data['search_term'] = $search_term;
        } else {
            $data['users'] = $this->User_model->get_all_users();
        }
        
        $data['title'] = 'Search Results';
        
        $this->load->view('templates/header', $data);
        $this->load->view('users/index', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Custom validation callback for email uniqueness
     */
    public function email_check($email, $id = null) {
        if ($this->User_model->email_exists($email, $id)) {
            $this->form_validation->set_message('email_check', 'This email already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}