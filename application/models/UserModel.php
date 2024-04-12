<?php


class UserModel extends CI_Model {
	public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding,Authorization");
        parent::__construct();
    }

	public function auth_user($data) {
		
		$query = $this->db->get_where('Users', array('email' => $data['email']), 1);
		if($query->num_rows() > 0){
			
			$user = $query->row();
			$hashed_password = $user->password;
			// passwword check
			if (!empty($user) && password_verify($data['password'], $hashed_password)) {
			
				// Load the Authorization_Token library
				$this->load->library('authorization_token');
				if($user->is_admin == 1){
					// $this->session->set_userdata(array('name' => $user->first_name, 'email'=> $user->email, 'logged_in' => TRUE, 'is_admin' => TRUE));
					$user_data = array(
						'user_id' => $user->user_id, // Get user ID after successful login
						'name' => $user->first_name,
						'is_logged' => 1,
						'is_admin' => 1,
					);
					$token = $this->authorization_token->generateToken($user_data);
						// Set the token as a cookie
					$cookie_data = array(
						'name'   => 'jwt_token',
						'value'  => $token,
						'expire' => time() + (30 * 24 * 60 * 60), // Cookie expiration time (e.g., 30 days)
						// 'secure' => TRUE // Set to TRUE if using HTTPS
					);
				
				}else{


					// NON-ADMIN USER
					// $this->session->set_userdata(array('name' => $user->first_name, 'email'=> $user->email, 'logged_in' => TRUE));
					$user_data = array(
						'user_id' => $user->user_id, // Get user ID after successful login
						'name' => $user->first_name,
						'is_logged' => 1,
						'is_admin' => 0,
					);
					$token = $this->authorization_token->generateToken($user_data);
						// Set the token as a cookie
					$cookie_data = array(
						'name'   => 'jwt_token',
						'value'  => $token,
						'expire' => time() + (30 * 24 * 60 * 60), // Cookie expiration time (e.g., 30 days)
						// 'secure' => TRUE // Set to TRUE if using HTTPS
					);
				}
				
				$this->input->set_cookie($cookie_data);
				return $cookie_data['value'];
				// Password matches, set up session and return true
				
				// return TRUE;
			} else {
				// Invalid email or password, return false
				return FALSE;
			}
		}else{
			
		}
	} // auth_user 
}
