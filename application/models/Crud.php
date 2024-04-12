<?php


class Crud extends CI_Model{

	public function insert($table, $data){
		$res = $this->db->insert($table, $data);
		if($this->db->affected_rows() == 1){
			return true;
		}else{
			return false;
		}
	}

	public function read($table){
		$query = $this->db->get($table);
		return $query->result_array();
	}




	public function delete($table, $column, $id){
		$this->db->where($column, $id);
        $this->db->delete($table);
		if ($this->db->affected_rows() > 0) {
			return true; // Deletion successful
		} elseif ($this->db->affected_rows() == 0) {
			// Product ID not found or no rows affected
			return false;
		} else {
			// Error occurred during deletion (handle or log the error)
			return false;
		}
	}

	public function update($table, $column, $id, $data){
        $this->db->where($column, $id);
        $this->db->update($table, $data);
    
        // Return true if update was successful, false otherwise
        if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
    }



	public function read_cart($table, $data){
		$user_id = $data; // Assuming $data contains the user_id
		$query = $this->db->get_where($table, array('user_id' => $user_id));


		if ($query->num_rows() > 0) {
			
			$cart_items = array();
			foreach ($query->result_array() as $row) {
				$product_id = $row['product_id'];
				$quantity = $row['quantity'];
				$total_price = $row['total_price'];
        
			// Check if the product_id already exists in the cart_items array
			if (isset($cart_items[$product_id])) {
				// Increment the quantity and update the total price
				$cart_items[$product_id]['quantity'] += $quantity;
				$cart_items[$product_id]['total_price'] += $total_price;
			} else {
				// Add a new entry for the product_id
				$cart_items[$product_id] = array(
					'product_id' => $product_id,
					'quantity' => $quantity,
					'total_price' => $total_price
				);
			}
    }
    // Convert the associative array into a simple array
    $cart_items = array_values($cart_items);
	return $cart_items;
	} else {
		// No rows found or multiple rows found (handle accordingly)
		
		return null;
	}
}




	public function read_products($table, $data){
		$product_id = $data;
		$query = $this->db->get_where($table, array('product_id' => $product_id));

		if($this->db->affected_rows() > 0){
			
			return $query->result_array();
		}

	}


	public function get_where($table, $column, $data){
		$query = $this->db->get_where($table, array($column => $data));
		if($this->db->affected_rows() > 0){
			
			return $query->result_array();
		}
	}
}
