<?php
class application_models_Employee {
	private $db;
	public function __construct() {
		$this->db = Zend_Db_Table::getDefaultAdapter ();
	}
	
	public function getEmployeeDetails($employee_id) {
		$employee_details_query = $this->db->select()->from('ijp_employees_list')->where('eid = ?',$employee_id);
		return $this->db->fetchRow( $employee_details_query );
	}
}