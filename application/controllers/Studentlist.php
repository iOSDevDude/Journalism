<?php
class Studentlist extends CI_Controller {

        public function __construct() {
                parent::__construct();
                $this->load->model('studentlist_model');
                $this->load->library('session');
                // $this->load->helper('url_helper');
        }

        public function index() {
                if (!$this->session->userdata('loggedin')) {
                  redirect('login');
                }
                if ($this->session->userdata('usertype') != "3") {
                    redirect('studentrecord/' . substr($this->session->userdata('username'),0,strpos($this->session->userdata('username'),'@')) . '/' . substr($this->session->userdata('username'),strpos($this->session->userdata('username'),'@')+1));
                }
                $data['students'] = $this->studentlist_model->get_students();
                $data['pageTitle'] = "list";

                $this->load->view('templates/header', $data);
                $this->load->view('studentlist/index', $data);
                $this->load->view('templates/footer');
        }

        public function delete_student($localPart,$domain) {
                $email = $localPart . '@' . $domain;
                $studentID = $this->studentlist_model->get_studentID($email)[0]['ID'];
                $this->studentlist_model->delete_student_from_db($studentID, $email);
                redirect('studentlist');
        }
}
