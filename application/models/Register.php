<?php
class application_models_Register {
	private $db;
	public function __construct() {
		$this->db = Zend_Db_Table::getDefaultAdapter ();
	}
	function do_register($values) {
		$insert_register_values ['name'] = $values ['full_name'];
		$insert_register_values ['address'] = $values ['address'];
		$insert_register_values ['email'] = $values ['email'];
		$insert_register_values ['emp_ref'] = $values ['emp_ref'];
		if (count($values ['key_skills']) > 0) {
			$insert_register_values ['key_skills'] = implode ( ',', $values ['key_skills'] );
		}
		$insert_register_values ['password'] = $values ['password'];
		$insert_register_values ['user_role'] = $values ['user_role'];
		$insert_register_values ['image_path'] = $values ['image_path']?:'';
		$insert_register_values ['cv_path'] = $values ['cv_path']?:'';
		$insert_register_values ['date_of_creation'] = new Zend_Db_Expr ( 'now()' );
		$insert_register_values ['date_of_modification'] = new Zend_Db_Expr ( 'now()' );
		$this->db->insert ( 'ijp_employees_list', $insert_register_values );
		$last_inserted_emp_id = $this->db->lastInsertID ();
		$values ['last_inserted_emp_id'] = $last_inserted_emp_id;
		$this->store_login_request($values);
		$this->store_emp_project_mapping($values);
		if($values ['user_role'] == 'E'){
			$this->store_emp_manager_mapping($values);
		}
	}
	
	public function getEmployeeWithRef($emp_ref) {
		$selection_query = $this->db->select()->from('ijp_employees_list')->where('emp_ref = ?', $emp_ref);
		return $this->db->fetchRow($selection_query);
	}
	
	public function update_employee($values) {
		$storage = Zend_Auth::getInstance()->getIdentity();
		if (strlen($values ['full_name'])) {
			$updated_values['name'] = $values ['full_name'];
			$storage->name = $values ['full_name'];
		}
		if (strlen($values ['emp_ref'])) {
			$updated_values['emp_ref'] = $values ['emp_ref'];
		}
		if (strlen($values ['address'])) {
			$updated_values['address'] = $values ['address'];
		}
		if (strlen($values ['email'])) {
			$updated_values ['email']= $values ['email'];
		}
		if (count($values ['key_skills']) > 0) {
			$updated_values ['key_skills'] = implode ( ',', $values ['key_skills'] );
		}
		if (strlen($values ['new_password'])) {
			$updated_values ['password'] = $values ['new_password'];
		}
		if (strlen($values ['image_path'])) {
			$updated_values['image_path'] = $values ['image_path'];
		}
		if (strlen($values ['cv_path'])) {
			$updated_values['cv_path'] = $values ['cv_path'];
		}
		
		$updated_values ['date_of_modification'] = new Zend_Db_Expr ( 'now()' );
		$this->db->update('ijp_employees_list', $updated_values,array (
				'eid =?' => $values ['eid'] 
		) );
	}
	
	function store_login_request($values) {
		$insert_login_request_values ['eid'] = $values ['last_inserted_emp_id'];
		$insert_login_request_values ['status'] = 'P';
		$insert_login_request_values ['date_of_creation'] = new Zend_Db_Expr ( 'now()' );
		$insert_login_request_values ['date_of_modification'] = new Zend_Db_Expr ( 'now()' );
		$this->db->insert ( 'ijp_login_requests', $insert_login_request_values );
	}

	function store_emp_project_mapping($values) {
		$insert_login_request_values ['eid'] = $values ['last_inserted_emp_id'];
		$insert_login_request_values ['project_id'] = $values['project_id'];
		$insert_login_request_values ['date_of_creation'] = new Zend_Db_Expr ( 'now()' );
		$insert_login_request_values ['date_of_modification'] = new Zend_Db_Expr ( 'now()' );
		$this->db->insert ( 'ijp_employees_project_mapping', $insert_login_request_values );
	}


	function store_emp_manager_mapping($values) {
		$insert_login_request_values ['eid'] = $values ['last_inserted_emp_id'];
		$insert_login_request_values ['	manager_id'] = $values['manager_id'];
		$insert_login_request_values ['date_of_creation'] = new Zend_Db_Expr ( 'now()' );
		$insert_login_request_values ['date_of_modification'] = new Zend_Db_Expr ( 'now()' );
		$this->db->insert ( 'ijp_emp_manager_mapping', $insert_login_request_values );
	}
}