<?php

require_once APPPATH . 'libraries/Authorization_Token.php';

class Admin extends CI_Controller{
	function __construct() {
        parent::__construct();
		$this->load->helper('url');
        $this->load->library("form_validation");

		$this->load->database();
		

    }

	public function index(){
		if($this->session->userdata('username')){
			$this->load->model("Crud");
			$res = $this->Crud->read("products")->result_array();
			$this->session->set_tempdata('products', $res);
			redirect('/home');

		}else{
			$this->load->view('/admin/sign_up');
		}
	}

	public function register() {

		$this->form_validation->set_rules("full_name", "Full_Name", "required");
		$this->form_validation->set_rules("username", "Username", "required");
		$this->form_validation->set_rules("email", "Email", "required|valid_email");
		$this->form_validation->set_rules("password", "Password", "required");

		// form_validation run
		if($this->form_validation->run() == TRUE){

			// taking the inputs from the form 
			$admin_data = array(
				"full_name" => $this->input->post("full_name", TRUE),
				"username" => $this->input->post("username", TRUE),
				"email" => $this->input->post("email", TRUE),
				"password" => password_hash($this->input->post("username", TRUE), PASSWORD_DEFAULT)
			);
		
			// load model
			$this->load->model("AdminModel");

			// saved_status - 0 or 1
			$saved_status = $this->AdminModel->saveData($admin_data);
			if($saved_status){
				echo "Data saved";
			}else{
				echo "Error while saving";
			} // saved status


		}else{
			$this->load->view('Admin/adminRegister');
		} //form validation
		
	} // register func ends


	public function login(){
		

			$this->form_validation->set_rules("username", "Username", "required");
			$this->form_validation->set_rules("password", "Password", "required");

			if($this->form_validation->run() == TRUE){
				$userData = array(
					"username" => $this->input->post('username',TRUE),
					"password" => $this->input->post('password',TRUE),
				);

				// loading the admin model
				$this->load->model("AdminModel");
				$status = $this->AdminModel->auth_user($userData);
				if ($status) {
					redirect('/home');
				}
				
			}else{
				echo "ENTER THE DETAILS PROPERLY";
			} // form_validation
	
	}

	
	public function showLoginForm(){
		if(!$this->session->userdata('username')){
			$this->load->view("Admin/admin_login");
		}else{
			redirect('/home');
		}

	} // login

	// 
	public function logout(){
		$this->session->unset_userdata('username');
		redirect('/admin/showLoginForm');
	}
	


} //Admin class
