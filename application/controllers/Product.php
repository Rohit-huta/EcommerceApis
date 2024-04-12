<?php


class Product extends CI_Controller{
	function __construct() {
        parent::__construct();

		$this->load->database();
    }

	public function index(){
		$this->load->model("Crud");
		$res = $this->Crud->read("Categories");
		$this->session->set_tempdata('categories', $res);
		$this->load->view('Admin/product');
	}


	public function add_product(){
		//image config
		$config = array(
			'upload_path' => "./uploads/",
			'allowed_types' => "jpg|png|jpeg|gif",
			'max_size' => "1024000", // file size , here it is 1 MB(1024 Kb)
		);

		// Form_validation
		$configData = array(
			array(
					'field' => 'product_name',
					'label' => 'Product_name',
					'rules' => 'required'
			),
			array(
					'field' => 'price',
					'label' => 'Price',
					'rules' => 'required',
			),
			array(
					'field' => 'avalability',
					'label' => 'Avalability',
					'rules' => 'required'
			),
		
		);


		$this->form_validation->set_rules($configData);

		if( $this->form_validation->run()){

			//  upload image to directory and get the name of that
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('productImage')) {
				
				// image saved
				$imagedata = $this->upload->data();
				// form_data
				$data = array(
					"category_id" => 1,
					"name" => $this->input->post("product_name", TRUE),
					"description" => $this->input->post("description", TRUE),
					"price" => $this->input->post("price", TRUE),
					"images" => $imagedata['file_name'],
				);

				
				$this->load->model("Crud");
				$insert_check = $this->Crud->insert("products", $data);
				if($insert_check){
					$this->session->set_flashdata('success', '<div>Product added Successfully</div>');
					$this->allProducts();
					redirect(base_url('/home'));
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger">'.implode("",$error).'</div>');
					redirect(base_url('/product'));
				}
			}else{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('message', '<div class="alert alert-danger">'.implode("",$error).'</div>');
			}
	
		}else{
			$this->load->view('/Admin/product');
		}
		
	}


	public function allProducts() {
		$this->load->model("Crud");
		$res = $this->Crud->read("products");	
		echo $res;
		$this->session->set_tempdata('products', $res);
		
	}


	public function deleteProduct(){
		$id = $this->input->post("product_id");
		$this->load->model("Crud");
		echo $id;
		$delete_status = $this->Crud->delete("products", $id);
		echo $delete_status;
		if($delete_status){
			redirect('/');
		}else{
			$this->session->set_flashdata('deleteProduct', '<div class="alert alert-danger">Error Deleting</div>');
		}
	}

	public function updateProduct(){
		$id = $this->input->post("product_id");
		
		$configData = array(
			array(
					'field' => 'product_name',
					'label' => 'Product_name',
					'rules' => 'required'
			),
			array(
				'field' => 'description',
				'label' => 'Description',
				'rules' => ''
			),
			array(
					'field' => 'price',
					'label' => 'Price',
					'rules' => '',
			),
			array(
					'field' => 'avalability',
					'label' => 'Avalability',
					'rules' => ''
			),
	
		);

		$this->form_validation->set_rules($configData);
		if($this->form_validation->run() == false){
			$this->load->view('Admin/editProduct', ['id' => $id]);
		}else{

			$id = $this->input->post("product_id", TRUE);
			$data = array(
				"name" => $this->input->post("product_name", TRUE),
				"description" => $this->input->post("description", TRUE),
				"price" => $this->input->post("price", TRUE),
				"availability" => $this->input->post("avalability", TRUE),
		
			);
			$update_data = array();
			if (!empty($data['name'])) {
				$update_data['name'] = $data['name'];
			}
			if (!empty($data['description'])) {
				$update_data['description'] = $data['description'];
			}
			// brand remaining
			
			if (!empty($data['price'])) {
				$update_data['price'] = $data['price'];
			}

			if (!empty($data['availability'])) {
				$update_data['availability'] = $data['availability'];
			}
		// image



			$this->load->model("Crud");
			$update_status = $this->Crud->update("products", "product_id", $id, $update_data);
			if($update_status){
				redirect('/');
			}else{
				echo "Could Not be updated!";
			}
			
		}

	
	}
}
