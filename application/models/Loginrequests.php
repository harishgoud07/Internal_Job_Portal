<?php
class application_models_Loginrequests {
	private $db;
	public function __construct() {
		$this->db = Zend_Db_Table::getDefaultAdapter ();
	}
	function get_login_requets($values) {
		$utilities = new application_models_Utilities ();
		$user_details = $utilities->get_user_details ();
		$get_login_request_query = $this->db->select ()->from ( array (
				'emp' => 'ijp_employees_list' 
		) )->join ( array (
				'request' => 'ijp_login_requests' 
		), 'emp.eid=request.eid' )->where ( 'request.status = ?', 'P' )->order ( 'request.date_of_creation desc' );

		if($user_details->user_role == 'M'){
			$get_login_request_query->join ( array (
				'mapping' => 'ijp_emp_manager_mapping'
			), 'mapping.eid = request.eid' )
			->where ( 'emp.user_role = ?', 'E' )->where ( 'mapping.manager_id = ?', $user_details->eid );

		}else{
			$get_login_request_query->where ( 'emp.user_role = ?', 'M' );
		}

		return $this->db->fetchAll ( $get_login_request_query );
	}
	
	function get_login_requests_for_manager() {
		$utilities = new application_models_Utilities ();
		$user_details = $utilities->get_user_details ();
		$get_login_request_query = $this->db->select ()->from ( array (
				'emp' => 'ijp_employees_list'
		) )->join ( array (
				'request' => 'ijp_login_requests'
		), 'emp.eid=request.eid' )->join(array('mapping' => 'ijp_emp_manager_mapping'),  'mapping.eid = request.eid')->where('mapping.manager_id = ?', $user_details->eid)->where ( 'emp.user_role = ?', 'E' )->where ( 'request.status = ?', 'P' )->order ( 'request.date_of_creation desc' );
	
		return $this->db->fetchAll ( $get_login_request_query );
	}

	function get_employee_details_with_request_id($request_id) {
		$get_employee_details_query = $this->db->select ()->from ( array (
			'emp' => 'ijp_employees_list'
		) )->join ( array (
			'request' => 'ijp_login_requests'
		), 'emp.eid=request.eid' )->where('request.request_id = ?',$request_id);
		return $this->db->fetchRow($get_employee_details_query);
	}
	
	function update_login_request_status($values) {
		$this->db->update ( 'ijp_login_requests', array (
				'status' => $values ['status'],
				'date_of_modification' => new Zend_Db_Expr ( 'now()' ) 
		), array (
				'request_id =?' => $values ['request_id'] 
		) );

		if($values['status'] == 'A'){
			/*send mail*/
			$emp_details = $this->get_employee_details_with_request_id($values ['request_id']);
			if ($emp_details['email']) {
				try {
					$mail = new Zend_Mail();
					$body = '<p>Hi '.$emp_details['name'].'</p><p>Your login request has been accepted by the admin. Now, you can login and request for new posts using the Portal</p><br><p>Cheers,<br>Internal job portal team</p>';
					$mail->setBodyHtml($body);
					$mail->setFrom('info@test.com', 'Internal Job Portal');
					$mail->addTo($emp_details['email'], $emp_details['name']);
					$mail->setSubject('Your login request has accepted');
					$mail->send();
				}
				catch(Exception $e) {
					echo "<script>alert('Unable to send email!');</script>";
				}
			}
		}
	}
	function store_login_request($values) {
		$insert_login_request_values ['eid'] = $values ['last_inserted_emp_id'];
		$insert_login_request_values ['status'] = 'P';
		$insert_login_request_values ['date_of_creation'] = new Zend_Db_Expr ( 'now()' );
		$insert_login_request_values ['date_of_modification'] = new Zend_Db_Expr ( 'now()' );
		$this->db->insert ( 'ijp_login_requests', $insert_login_request_values );
	}
}