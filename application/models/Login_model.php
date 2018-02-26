<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    //constructor
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //destructor
    function __destruct() {
        $this->db->close();
    }

    public function get_login($email) {
        $query = $this->db->get_where('User', array('KSCEmail =' => $email));
        return $query->result_array();
    }

    public function get_user_data($email) {
        $query = $this->db->get_where('User', array('KSCEmail =' => $email));
        return $query->result_array();
    }

    public function update_password($email, $newpass) {
        $query = $this->db->update('User', array('HashedPass' => $newpass), array('KSCEmail' => $email));
        return $query;
    }

    public function create_new_student($email) {
        $this->db->query("INSERT INTO Student (FirstName, LastName, KSCEmail, AltEmail, Classification, CatalogYear, MajorDeclared, JRNOption, MinorDeclared) VALUES ('test', 'test', '$email', 'test', 'Fr', '2017', 0, 0, 0)");
    }

    public function create_new_account($email, $pass, $type) {
        $this->db->query("INSERT INTO `Account`(`KSCEmail`, `HashedPass`, `UserType`) VALUES ('$email','$pass','$type')");
    }
}
?>
