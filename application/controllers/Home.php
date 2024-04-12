<?php



class Home extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->database();
	
    }

	public function validToken(){
		$jwt_token = $this->input->cookie('jwt_token');

		if(!empty($jwt_token)){
			$this->load->library('authorization_token');
			$token_data = $this->authorization_token->validateToken();
			return $token_data;
		}else{
			return 0;
		}	
	}

	public function index(){
	// SESSION 
		// $is_admin = $this->session->userdata('is_admin');
		// $is_logged = $this->session->userdata('logged_in');

		$token_data = $this->validToken();
	
		if($token_data){
			// print_r($token_data);
			// Validate the token
			if($token_data['status']){
				
				
					$is_logged = $token_data['data']->is_logged;
					$is_admin = $token_data['data']->is_admin;
					$user_id = $token_data['data']->user_id;
					$name = $token_data['data']->name;
					$this->session->set_tempdata("user_id", $user_id);
					$this->session->set_tempdata("name", $name);
				if($is_logged == 1 && $is_admin == 1) {
					// is admin Home Page
					$this->session->set_tempdata("is_logged" , 1);
					$this->session->set_tempdata("is_admin" , 1);
					$this->allProducts();
					$products_data = $this->session->tempdata('products');
					$data['products'] = $products_data;
					$this->load->view("Admin/home", $data);
				}else{
					// Displaying User Home Page

					// with all the products
					$this->session->set_tempdata("is_logged" , 1);
					$this->allProducts();
					$products_data = $this->session->tempdata('products');
					$data['products'] = $products_data;

					// attaching user Details
	
					$data['user_id'] = $user_id;
					$data['user_name'] = $name;

					$this->load->view("User/home", $data);
				}
			}else {
				$this->load->view('sign_up');
			}
		}else{
			$this->load->view('sign_up');
		}
	}

	public function allProducts() {
		$this->load->model("Crud");
		$res = $this->Crud->read("Products");
		$this->session->set_tempdata('products', $res);
		
	}


	public function register() {

		$this->form_validation->set_rules("first_name", "First_Name", "required");
		$this->form_validation->set_rules("last_name", "Last_name", "required");
		$this->form_validation->set_rules("address", "Address", "required");
		$this->form_validation->set_rules("mobile", "Mobile", "required");
		$this->form_validation->set_rules("email", "Email", "required|valid_email");
		$this->form_validation->set_rules("password", "Password", "required");

		// form_validation run
		if($this->form_validation->run() == TRUE){

			// taking the inputs from the form 
			$user_data = array(
				"first_name" => $this->input->post("first_name", TRUE),
				"last_name" => $this->input->post("last_name", TRUE),
				"address" => $this->input->post("address", TRUE),
				"mobile" => $this->input->post("mobile", TRUE),
				"email" => $this->input->post("email", TRUE),
				"password" => password_hash($this->input->post("password", TRUE), PASSWORD_DEFAULT)
			);
		
			// load model
			$this->load->model("Crud");
	
			// register_status - 0 or 1
			$data['register_status'] = $this->Crud->insert("Users", $user_data);
			
			if($data['register_status']){
				echo "Data saved";
				redirect('/home', $data);
			}else{
				echo "Error while saving";
			} // saved status

		}else{
			echo "Form Validation Error";
			$this->load->view('sign_up');
		} //form validation
	} // register func ends










	public function login(){
		
		$this->form_validation->set_rules("email", "Email", "required|valid_email");
		$this->form_validation->set_rules("password", "Password", "required");

		if($this->form_validation->run() == TRUE){
			$user_data = array(
				"email" => $this->input->post('email',TRUE),
				"password" => $this->input->post('password',TRUE),
			);
			
			$this->load->model("UserModel");
			$token = $this->UserModel->auth_user($user_data);
			// if($token){
				// APIs
				if ($token){

					redirect('/');
				} else {

					redirect('/User/sign_up');
				}

		
	
			
		}else{
			$this->load->view("/User/login");
		} // form_validation

	} //login


	public function showLoginForm() {

		$token_data = $this->validToken();

		if(!isset($token_data['status']) ){
			$this->load->view("login");
		}else{
			redirect('/');
		}
		
	}

	public function logout(){
		    // Clear the jwt_token cookie
			$cookie_data = array(
				'name'   => 'jwt_token',
				'value'  => '',
				'expire' => time() - 3600, // Set expiration time to the past (cookie will be deleted)
				// Other cookie parameters if needed
			);
			$this->input->set_cookie($cookie_data);
			$this->session->unset_tempdata('user_id');
			$this->session->unset_tempdata('is_logged');
			
			// Redirect to home page or any other desired location
			redirect('/home');
	}


// ADD TO CART
	public function add_to_cart(){
	// user_id, product_id, quantity
			$data = array(
				'user_id' => $this->input->post('user_id', TRUE),
				'product_id' => $this->input->post('product_id', TRUE),
				'quantity' => $this->input->post('quantity', TRUE),
				);
			$price = $this->input->post("price", TRUE);

			$user_id = $data['user_id'];
			$product_id = $data['product_id'];
			$quantity = $data['quantity'];
		// Total Price
			$price = (float) $price;
			$quantity = (float) $quantity;
			$total_price = $price * $quantity;
			$data['total_price'] = $total_price;
// var_dump($price);
// var_dump($quantity);

		// Validate request data
		if (!$quantity) {
			// Return an error response if required parameters are missing
			$data['quantity'] = 1;
		}else{
			$this->load->model("Crud");
			$status = $this->Crud->insert("Cart", $data);
			if($status){
				redirect('/');
			}else{
				echo "Error adding to cart!";
			}

		}
	} // ADD TO CART

// all_items_cart
	public function get_cart_items(){
		$user_id= $this->input->post("user_id");

		$this->load->model("Crud");
		$cart_items = $this->Crud->read_cart("cart", $user_id);
		if (!empty($cart_items)) {
			$this->session->set_tempdata("cart_items", $cart_items);
			foreach ($cart_items as $cart_item) {
				// Retrieve product details for the current cart item
				$product_details = $this->Crud->read_products("products", $cart_item['product_id']);
				
				// Append the product details to the array
				$product_details_array[] = $product_details;
			}
			
			$this->load->view("User/cart", array("cart_items" => $cart_items, "product_details" => $product_details_array));
		} else {
			// No records were returned, handle this case accordingly
			$this->load->view("User/cart");

		}
	}

	public function check_out(){
		
		$this->load->view("User/check_out");
	}

	public function procced_to_payment() {

		
		$cart_items = $this->session->tempdata("cart_items");

		$user_id = $this->session->tempdata("user_id");

		$payment_amount = 0;

		foreach($cart_items as $cart_item){
			$payment_amount += $cart_item['total_price'];	

		}
		$payment_uni_id = uniqid("payment_");

		$payment_data = array(
			"order_id" => 0,
			"payment_uni_id" => $payment_uni_id,
			"amount" => $payment_amount,
			"payment_status" => 1,
			"payment_method" => "card",
		);
		$this->load->model("Crud");
		$status = $this->Crud->insert("payments", $payment_data);
		if($status){
			$payment_data = $this->Crud->read("payments");

			$curr_payment_data = $this->Crud->get_where("payments", "payment_uni_id", $payment_uni_id);
		// if payment_status is 1
			if($curr_payment_data[0]['payment_status'] == 1){

	
			// add to orders
				// data
				$address = $this->input->post("address");
				$order_data = array(
					"user_id" => $user_id,
					"address" => $address,
					"price" => $payment_amount,
					"status" => 1 //if payment done
				);
				$this->load->model("Crud");
				$status = $this->Crud->insert("orders", $order_data);
				if($status){
						// get order ID
						$order_details = $this->Crud->get_where("orders", "user_id", $user_id);
						$order_id = $order_details[0]['order_id'];
						foreach ($cart_items as $cart_item) {
							$order_item_data = array(
								"order_id" => $order_id,
								"product_id" => $cart_item['product_id'],
								"quantity" => $cart_item['quantity'],
								"total_price" => $payment_amount
							);
							$order_items_status = $this->Crud->insert("order_items", $order_item_data);
						}
						if($order_items_status){
								$data = array( 'order_id' => $order_id );
								$status = $this->Crud->update("payments", "payment_uni_id", $payment_uni_id, $data);
								if($status){
									$cart_details = $this->Crud->get_where("cart", "user_id", $user_id);
									$clear_cart_status = $this->Crud->delete("cart", "user_id", $user_id);
									if($clear_cart_status) redirect('/home/get_cart_items');
								}else{
									echo "Payments mai order_id NOT SET";
								}

							
							}
				}else{
					echo "ORDER Insertion failed";
				}

			
			

			} else{
				echo "Payment no done";
			}
			
		}

	}


	public function get_orders(){
		$user_id= $this->input->post("user_id");

	
	} // orders




}
