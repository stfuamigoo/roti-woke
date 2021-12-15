<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function insert($data = array())
    {
        return $this->db->insert('user', $data);
    }

    public function getAllUser()
    {
        return $this->db->query("SELECT * FROM user ")->result_array();
    }

    public function getUserByID($user_id)
    {
        return $this->db->query("SELECT * FROM user WHERE `id_user` = '$user_id'")->row_array();
    }

    public function getUserByUsername($username)
    {
        return $this->db->query("SELECT * FROM user WHERE `username` = '$username'")->row_array();
    }

    public function countUser()
    {
        return $this->db->count_all('user');
    }

    public function editUserData($new_data = array())
    {
        $username = $new_data['username'];
        $password = $new_data['password'];
        $role = $new_data['role'];
        $id = $new_data['id_user'];

        $query = "UPDATE user SET `username` = '$username', `password` = '$password', `role` = '$role' WHERE `id_user` = '$id'";
        return $this->db->query($query);
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM user WHERE `id_user` = '$id'";
        return $this->db->query($query);
    }

    public function updatePassword($username, $password)
    {
        return $this->db->query("UPDATE user SET `password` = '$password' WHERE `username` = '$username'");
    }
}
