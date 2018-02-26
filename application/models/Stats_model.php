<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stats_model extends CI_Model {
    //constructor
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_courses() {
    	$query = $this->db->get('StudentCourseStatusView');
        return $query->result_array();
    }

    function get_num_students() {
    	$query = $this->db->get('Student');
    	return $query->num_rows();
    }
}
?>