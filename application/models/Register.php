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
		$insert_register_values ['password'] = $values ['password'];
		$insert_register_values ['user_role'] = $values ['user_role'];
		$insert_register_values ['image_path'] = $values ['image_path'];
		$insert_register_values ['cv_path'] = $values ['cv_path'];
		$insert_register_values ['date_of_creation'] = new Zend_Db_Expr ( 'now()' );
		$insert_register_values ['date_of_modification'] = new Zend_Db_Expr ( 'now()' );
		$this->db->insert ( 'ijp_employees_list', $insert_register_values );
		$last_inserted_emp_id = $this->db->lastInsertID ();
		$values ['last_inserted_emp_id'] = $last_inserted_emp_id;
		$this->store_login_request($values);
		$this->store_emp_project_mapping();
		if($values['E'] == 'E'){
			//$this->store_emp_manager_mapping($values);
		}
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