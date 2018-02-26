<?php
class Studentrecord extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('studentrecord_model');
    $this->load->library('session');
  }

  public function index() {
      if (!$this->session->userdata('loggedin')) {
          redirect('login');
      }

    if($this->input->post("update")) {
      $studentFirstName = $this->input->post("studentFirstName");
      $studentLastName = $this->input->post("studentLastName");
      $localPart = $this->uri->segment(2);
      $domain = $this->uri->segment(3);
      $studentKSCEmail = $localPart . '@' . $domain;
      $studentID = $this->studentrecord_model->get_student($studentKSCEmail)->ID;
      $studentAlternateEmail = $this->input->post("studentAlternateEmail");
      $classification = $this->input->post("classification");
      $catalogYear = $this->input->post("studentCatalogYear");
      $majorDeclared = $this->input->post("majorDeclared");
      $jrnOption = $this->input->post("jrnOption");
      $minorDeclared = $this->input->post("minorDeclared");
      $advisor = $this->input->post("advisor");
      $this->studentrecord_model->update_student($studentFirstName, $studentLastName, $studentKSCEmail, $studentAlternateEmail, $classification, $catalogYear, $majorDeclared, $jrnOption, $minorDeclared);
      $this->studentrecord_model->update_student_advisor($studentID, $advisor);

      $courseStatuses = [];
      foreach ($_POST as $key => $value):
        if(strpos($key, 'course_') === 0) {
          $courseID = explode("_", $key, 2)[1];
          $courseStatuses[$courseID] = $value;
        }
      endforeach;
      $this->studentrecord_model->update_course_statuses($studentID, $courseStatuses);
    }

    $localPart = $this->uri->segment(2);
    $domain = $this->uri->segment(3);
    $email = $localPart . '@' . $domain;
    $data['student'] = $this->studentrecord_model->get_student($email);
    $studentID = $data['student']->ID;
    $data['courses'] = $this->studentrecord_model->get_courses();
    $data['courseStatuses'] = $this->studentrecord_model->get_courses_with_status($studentID);
    $data['courseCompletionOptions'] = $this->studentrecord_model->get_course_completion_statuses();
    $data['classifications'] = $this->studentrecord_model->get_classifications();
    $data['jrnoptions'] = $this->studentrecord_model->get_jrnoptions();
    $data['studentAdvisor'] = $this->studentrecord_model->get_advisor($studentID);
    $data['advisors'] = $this->studentrecord_model->get_advisors();

    // var to set up nav bar
    $data['pageTitle'] = "record";

    $this->load->view('templates/header', $data);
    $this->load->view('studentrecord/index', $data);
    $this->load->view('templates/footer');
  }
}
