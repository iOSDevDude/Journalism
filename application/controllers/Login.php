<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller
{
  //constructor
  function __construct() {
    parent::__construct();
    $this->load->model("Login_model", "login");
    $this->load->library('session');
    if(!empty($_SESSION['id_user']))
      redirect('home');
    }

    //index function
    public function index() {
      unset($_SESSION['loggedin']);

      $data['error'] = "";

      if(isset($_SESSION)) {
        $data['error'] = $this->session->flashdata('flash_data');
      }

      $this->load->view('login/index',$data);

      if($_POST) {
        //if the form has been submitted, validate the input
          $result = $this->LoginUser($_POST['username'],$_POST['password']);
          if (! $result) {
            //if something goes wrong change flash data to error
            $this->session->set_flashdata('flash_data', 'Username or password is wrong!');
            redirect('login');
          } else if ( $_POST['password'] == $this->session->userdata('lastname')) {
            redirect('/login/changepassword');
          } else if ( $this->session->userdata('usertype') == "3" ) {
            redirect('studentlist');
          } else {
            redirect('studentrecord/' . substr($this->session->userdata('username'),0,strpos($this->session->userdata('username'),'@')) . '/' . substr($this->session->userdata('username'),strpos($this->session->userdata('username'),'@')+1));
          }
      }
    }

    //changepassword function
    public function changepassword() {
      $data['error'] = "";

      if (!$this->session->userdata('loggedin')) {
        redirect('login');
      }

      if(isset($_SESSION)) {
        $data['error'] = $this->session->flashdata('flash_data');
      }

      $this->load->view('login/changepass',$data);

      if($_POST) {
          //if the form has been submitted, validate the input
          $newHashedPass = password_hash($_POST['password'],PASSWORD_DEFAULT);
          $result = $this->login->update_password($this->session->userdata('username'),$newHashedPass);
          if (! $result) {
            //if something goes wrong change flash data to erro
            $this->session->set_flashdata('flash_data', 'An error has occurred.');
            redirect('login');
          } else if ( $this->session->userdata('usertype') == "Admin" ) {
            redirect('studentlist');
          } else {
            redirect('studentrecord/' . substr($this->session->userdata('username'),0,strpos($this->session->userdata('username'),'@')) . '/' . substr($this->session->userdata('username'),strpos($this->session->userdata('username'),'@')+1));
          }
      }
    }

    public function createaccount() {

      $data['error'] = "";

      if(isset($_SESSION)) {
        $data['error'] = $this->session->flashdata('flash_data');
      }

      $this->load->view('login/createaccount',$data);

      if($_POST) {
        $hashedPass = password_hash($this->input->post("password"),PASSWORD_BCRYPT);
        $email = $this->input->post("username");
        $this->login->create_new_account($email,$hashedPass,"Student");
        $this->login->create_new_student($email);
      }
    }

    private function VerifyUser( $username, $password ) {
      $result = $this->login->get_login($username);
      if ( password_verify($password, $result[0]['HashedPass']) ) {
        return array(true,$result[0]['UserType']);
      } else {
        return array(false,null);
      }
    }

    public function LoginUser( $username, $password ) {
      $userVerified = $this->VerifyUser($username, $password);
      if ( $userVerified[0] ) {
        $result = $this->login->get_user_data($username);

        $data = [
          'username' => $username,
          'usertype' => $userVerified[1],
          'firstname' => $result[0]['FirstName'],
          'lastname' => $result[0]['LastName'],
          'loggedin' => true
        ];

        $this->session->set_userdata($data);

        return true;
      } else {
        return false;
      }
    }
}
