<?php
class Studentrecord_model extends CI_Model {

    public function __construct() {
    	$this->load->database();
    }

    public function get_student($kscemail) {
      $query = $this->db->query("SELECT * FROM StudentView WHERE KSCEmail='$kscemail'");
      if($query->num_rows() > 0) {
        return $query->row();
      }
      return null;
    }

    public function get_courses() {
      $query = $this->db->get('CourseView');
      return $query->result_array();
    }

    public function get_courses_with_status($studentID) {
      $query = $this->db->query("SELECT * FROM StudentCourseStatusView WHERE StudentID='$studentID'");
      return $query->result_array();
    }

    public function get_course_completion_statuses() {
      $query = $this->db->get("CourseCompletionStatus");
      return $query->result_array();
    }

    public function get_classifications() {
      $query = $this->db->get("Classification");
      return $query->result_array();
    }

    public function get_jrnoptions() {
      $query = $this->db->get("JRNOption");
      return $query->result_array();
    }

    public function get_advisors() {
      $query = $this->db->get("AdvisorView");
      return $query->result_array();
    }

    //Fix this later to allow for multiple advisors
    public function get_advisor($studentID) {
      $query = $this->db->query("SELECT * FROM StudentAdvisorView WHERE StudentID='$studentID'");
      return $query->row();
    }

    public function update_student($studentFirstName, $studentLastName, $studentKSCEmail, $studentAlternateEmail, $classification, $catalogYear, $majorDeclared, $jrnOption, $minorDeclared) {
        //$studentID = get_student($studentKSCEmail)['ID'];
        $this->db->query("UPDATE User SET FirstName = '$studentFirstName', LastName='$studentLastName', AltEmail='$studentAlternateEmail' WHERE KSCEmail = '$studentKSCEmail'");
        $this->db->query("UPDATE Student SET Classification='$classification', CatalogYear='$catalogYear', MajorDeclared='$majorDeclared', JRNOption=(SELECT ID FROM JRNOption WHERE Type='$jrnOption'), MinorDeclared='$minorDeclared' WHERE KSCEmail = '$studentKSCEmail'");
    }

    public function update_student_advisor($studentID, $advisorID) {
      //Fix this later
      $this->db->query("UPDATE Student_Advisor SET AdvisorID='$advisorID' WHERE StudentID='$studentID'");
    }

    public function update_course_statuses($studentID, $courseStatuses) {
      foreach ($courseStatuses as $courseID => $courseStatus):
        if($courseStatus == 1 || $courseStatus == 2) {
          $this->db->query("INSERT INTO Student_Course (StudentID, CourseID, CompletionStatus) VALUES ($studentID, $courseID, $courseStatus) ON DUPLICATE KEY UPDATE CompletionStatus=$courseStatus");
        } else if($courseStatus == 0) {
          $this->db->query("DELETE FROM Student_Course WHERE StudentID=$studentID AND CourseID=$courseID");
        }
      endforeach;
    }
}
