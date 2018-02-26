<?php
class Studentlist_model extends CI_Model {

        public function __construct() {
        	parent::__construct();
        	$this->load->database();
        }

        public function get_students() {
        	$query = $this->db->get('StudentView');
        	return $query->result_array();
        }

        public function get_studentID($email) {
        	$query = $this->db->get_where('User', array('KSCEmail =' => $email));
        	return $query->result_array();
        }

        //TODO CASCADE THIS
        public function delete_student_from_db($sID, $email) {
        	$this->db->delete('Student_Advisor',array('StudentID  =' => $sID));
        	$this->db->delete('Student_Major',array('StudentID =' => $sID));
        	$this->db->delete('Student_Minor',array('StudentID =' => $sID));
        	$this->db->delete('Student_Course',array('StudentID =' => $sID));
        	$this->db->delete('Account',array('KSCEmail =' => $email));
        	$this->db->delete('Student',array('ID =' => $sID));
        }
}
