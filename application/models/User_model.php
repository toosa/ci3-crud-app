<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all users
     */
    public function get_all_users() {
        $query = $this->db->get('users');
        return $query->result_array();
    }

    /**
     * Get user by ID
     */
    public function get_user($id) {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    /**
     * Create new user
     */
    public function create_user($data) {
        return $this->db->insert('users', $data);
    }

    /**
     * Update user
     */
    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    /**
     * Delete user
     */
    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    /**
     * Check if email exists (for validation)
     */
    public function email_exists($email, $id = null) {
        $this->db->where('email', $email);
        if ($id) {
            $this->db->where('id !=', $id);
        }
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    /**
     * Get users with pagination
     */
    public function get_users_paginated($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('users');
        return $query->result_array();
    }

    /**
     * Count total users
     */
    public function users_count() {
        return $this->db->count_all('users');
    }

    /**
     * Search users by name or email
     */
    public function search_users($search_term) {
        $this->db->group_start();
        $this->db->like('name', $search_term);
        $this->db->or_like('email', $search_term);
        $this->db->group_end();
        $query = $this->db->get('users');
        return $query->result_array();
    }
}