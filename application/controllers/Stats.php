<?php
class Stats extends CI_Controller {

        public function __construct() {
                parent::__construct();
                $this->load->model('stats_model');
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

                $originalCourses = $this->stats_model->get_courses();
                $numStudents = $this->stats_model->get_num_students();
                $courses = array();
                
                foreach ($originalCourses as $course) {
                    if ( !array_key_exists($course['CourseID'],$courses) ) {
                        $courses[$course['CourseID']] = array($course['Prefix'],$course['Number'],0,0,0);
                    }
                    if ( $course['CompletionStatusID'] == 2 ) {
                        $courses[$course['CourseID']][2] += 1;
                    } else {
                        $courses[$course['CourseID']][3] += 1;
                    }
                }
                foreach ($courses as &$course) {
                    $course[4] = $numStudents - ($course[2] + $course[3]);
                }

                $fp = fopen('assets/js/data.json','w');
                fwrite($fp,json_encode($courses));
                fclose($fp);

                $data['courses'] = $courses;
                $data['pageTitle'] = "stats";

                $this->load->view('templates/header', $data);
                $this->load->view('stats/index', $data);
                $this->load->view('templates/footer', $data);
        }
}
