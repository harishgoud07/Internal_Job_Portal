<?php
class application_models_Posts {
	private $db, $user_details;
	public function __construct() {
		$this->db = Zend_Db_Table::getDefaultAdapter ();
		$utilities = new application_models_Utilities ();
		$this->user_details = $utilities->get_user_details ();
	}
	public function get_posts() {
		$get_posts_query = $this->db->select ()->from ( array (
				'emp' => 'ijp_employees_list' 
		) )->join ( array (
				'posts' => 'ijp_job_posts' 
		), 'emp.eid = posts.eid' )->join ( array (
				'projects' => 'ijp_projects_list' 
		), 'posts.project_id = projects.project_id', array (
				'project_name' => 'name' 
		) )->where ( 'posts.status = ?', 'A' )->order ( 'posts.date_of_creation desc' );
		return $this->db->fetchAll ( $get_posts_query );
	}
	function get_projects_list() {
		$select_pojects_query = $this->db->select ()->from ( 'ijp_projects_list' );
		return $this->db->fetchAll ( $select_pojects_query );
	}
	function add_posts($values) {
		$insert_post_values ['job_title'] = $values ['job_title'];
		$insert_post_values ['job_description'] = $values ['job_description'];
		$insert_post_values ['job_skill_set'] = implode ( ',', $values ['key_skills'] );
		$insert_post_values ['salary'] = $values ['salary'];
		$insert_post_values ['experience'] = '12'; // $values['experience'];
		$insert_post_values ['status'] = $this->user_details->user_role == 'M' ? 'P' : 'A';
		$insert_post_values ['project_id'] = $values ['project_id'];
		$insert_post_values ['eid'] = $this->user_details->eid;
		$insert_post_values ['no_of_vacancies'] = $values ['no_of_vacancies'];
		$insert_post_values ['posted_by'] = $this->user_details->user_role;
		$insert_post_values ['date_of_creation'] = new Zend_Db_Expr ( 'now()' );
		$insert_post_values ['date_of_modification'] = new Zend_Db_Expr ( 'now()' );
		$this->db->insert ( 'ijp_job_posts', $insert_post_values );
	}
	function update_posts($values) {
		$update_post_values ['job_title'] = $values ['job_title'];
		$update_post_values ['no_of_vacancies'] = $values ['no_of_vacancies'];
		$update_post_values ['job_description'] = $values ['job_description'];
		$update_post_values ['job_skill_set'] = implode ( ',', $values ['key_skills'] );
		$update_post_values ['salary'] = $values ['salary'];
		$update_post_values ['experience'] = 12;
		$values ['experience'];
		$update_post_values ['project_id'] = $values ['project_id'];
		$update_post_values ['date_of_modification'] = new Zend_Db_Expr ( 'now()' );
		$this->db->update ( 'ijp_job_posts', $update_post_values, array (
				'post_id =?' => $values ['post_id'] 
		) );
	}
	function update_post_status($values) {
		$this->db->update ( 'ijp_job_posts', array (
				'status' => $values ['status'] 
		), array (
				'post_id =?' => $values ['post_id'] 
		) );
	}
	function apply_job_post($values) {
		$insert_applied_job_values ['eid'] = $this->user_details ['eids'];
		$insert_applied_job_values ['post_id'] = $values ['post_id'];
		$insert_applied_job_values ['date_of_creation'] = new Zend_Db_Expr ( 'now()' );
		$insert_applied_job_values ['date_of_modification'] = new Zend_Db_Expr ( 'now()' );
		$this->db->insert ( 'ijp_job_applied_emp_details', $insert_applied_job_values );
	}
	function upadte_applied_job_post_status($values) {
		$this->db->update ( 'ijp_job_applied_emp_details', array (
				'status' => $values ['statuss'] 
		), array (
				'id =?' => $values ['id'] 
		) );
	}
	function get_requested_posts_count() {
		$select_post_requests_count_query = $this->db->select ()->from ( 'ijp_job_posts', array (
				'requested_posts_count' => 'count(*)' 
		) )->where ( 'status = ?', 'P' );
		return $this->db->fetchRow ( $select_post_requests_count_query );
	}
	function get_post_data($values) {
		$select_post_query = $this->db->select ()->from ( array (
				'posts' => 'ijp_job_posts' 
		) )->join ( array (
				'projects' => 'ijp_projects_list' 
		), 'posts.project_id = projects.project_id' )->where ( 'post_id = ?', $values ['post_id'] )->where ( 'status = ?', 'A' );
		
		return $this->db->fetchRow ( $select_post_query );
	}
}