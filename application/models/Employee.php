<?php
class application_models_Employee {
	private $db;
	public function __construct() {
		$this->db = Zend_Db_Table::getDefaultAdapter ();
	}
	public function getEmployeeDetails($employee_id) {
		$employee_details_query = $this->db->select ()->from ( 'ijp_employees_list' )->where ( 'eid = ?', $employee_id );
		return $this->db->fetchRow ( $employee_details_query );
	}
	public function getAvailableManagers() {
		$get_manager_detals = $this->db->select ()->from ( array (
				'employee' => 'ijp_employees_list' 
		) )->join ( array (
				'login_requests' => 'ijp_login_requests' 
		), 'employee.eid = login_requests.eid' )->where ( 'employee.user_role = ?', 'M' )->where ( 'login_requests.status = ?', 'A' );
		return $this->db->fetchAll($get_manager_detals);
	}

	public function is_employee_authenticated($employee_id) {
		$get_employee_status_query = $get_manager_detals = $this->db->select ()->from('ijp_login_requests')->where('eid = ?',$employee_id);
		$user_status = $this->db->fetchRow($get_employee_status_query);
		if ($user_status['status'] == 'A') {
			return true;
		}
		return false;
	}

	public function get_managers_of_project($values){
		$get_manager_detals = $this->db->select ()->from ( array (
				'employee' => 'ijp_employees_list' 
		),array('name','eid') )->join ( array (
				'mapping' => 'ijp_employees_project_mapping' 
		), 'mapping.eid = employee.eid' )->where ( 'employee.user_role = ?', 'M' )->where ( 'mapping.project_id =?', $values['project_id'] );
		return $this->db->fetchAll($get_manager_detals);
	}
	
	public function getEmployeesList($values) {

		$get_manager_detals = $this->db->select ()->from ( array (
			'employee' => 'ijp_employees_list'
		),array('employee_name'=>'name','employee_id'=>'eid','user_role','email','employee_ref'=>'emp_ref','address') )->join ( array (
			'mapping' => 'ijp_employees_project_mapping'
		), 'mapping.eid = employee.eid' )->joinLeft(array('manager_mapping'=> 'ijp_emp_manager_mapping'),'mapping.eid = manager_mapping.eid')
			->joinLeft(array('manager'=> 'ijp_employees_list'),'manager.eid = manager_mapping.manager_id',array('manager_name'=>'manager.name'));
		if ($values['project_id'] && $values['manager_id']) {
			$get_manager_detals = $get_manager_detals->where('manager_mapping.manager_id = ?',$values['manager_id'])->where ( 'mapping.project_id =?', $values['project_id'] )->order('user_role ASC');

		} else if($values['project_id']) {
			$get_manager_detals = $get_manager_detals->where ( 'mapping.project_id =?', $values['project_id'] )->order('user_role ASC');
		} else {
			$get_manager_detals = $get_manager_detals->order('user_role ASC');
		}
		return $this->db->fetchAll($get_manager_detals);
	}
}