<?php
class application_models_Posts {
	private $db, $user_details;
	public function __construct() {
		$this->db = Zend_Db_Table::getDefaultAdapter ();
		$utilities = new application_models_Utilities ();
		$this->user_details = $utilities->get_user_details ();
		$utilities = new application_models_Utilities();
        $user_details = $utilities->get_user_details();
	}
	public function get_posts($values = array() ) {
		$utilities = new application_models_Utilities();
                        $user_details = $utilities->get_user_details();
                       
		$get_posts_query = $this->db->select ()->from ( array (
				'emp' => 'ijp_employees_list' 
		) )->join ( array (
				'posts' => 'ijp_job_posts' 
		), 'emp.eid = posts.eid' )->join ( array (
				'projects' => 'ijp_projects_list' 
		), 'posts.project_id = projects.project_id', array (
				'project_name' => 'name' 
		) )->where ( 'posts.status = ?', 'A' )->order ( 'posts.date_of_creation desc' );

		 if($user_details->user_role == 'M'){
			$get_posts_query->where ( 'posts.eid = ?', $user_details->eid );				
		}

		if($user_details->user_role == 'E'){

			$get_posts_query->joinLeft ( array (
				'applied_jobs' => 'ijp_job_applied_emp_details' 
		), 'applied_jobs.post_id = posts.post_id', array (
				'not_applied_post_id' => 'post_id' 
		) )->where ( 'applied_jobs.post_id is null' );
		}
		//echo $get_posts_query;
		return $this->db->fetchAll ( $get_posts_query );
	}

	public function get_requested_posts() {
		$get_posts_query = $this->db->select ()->from ( array (
			'emp' => 'ijp_employees_list'
		) )->join ( array (
			'posts' => 'ijp_job_posts'
		), 'emp.eid = posts.eid' )->join ( array (
			'projects' => 'ijp_projects_list'
		), 'posts.project_id = projects.project_id', array (
			'project_name' => 'name'
		) )->where ( 'posts.status = ?', 'P' )->where('posted_by = ?','M')->order ( 'posts.date_of_creation desc' );
		if($this->user_details->user_role == 'M'){
			$get_posts_query->where ( 'posts.eid = ?', $this->user_details->eid );				
		}
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
		$insert_post_values ['experience'] = $values['experience'];
		$insert_post_values ['status'] = $this->user_details->user_role == 'M' ? 'P' : 'A';
		$insert_post_values ['project_id'] = $values ['project_id'];
		$insert_post_values ['eid'] = $this->user_details->eid;
		$insert_post_values ['no_of_vacancies'] = $values ['no_of_vacancies'];
		$insert_post_values ['posted_by'] = $this->user_details->user_role;
		$insert_post_values ['last_date_for_applicants'] = $values['last_date_for_applicants'];
		$insert_post_values ['date_of_creation'] = new Zend_Db_Expr ( 'now()' );
		var_dump($insert_post_values);
		$insert_post_values ['date_of_modification'] = new Zend_Db_Expr ( 'now()' );
		$this->db->insert ( 'ijp_job_posts', $insert_post_values );
	}
	function update_posts($values) {
		$update_post_values ['job_title'] = $values ['job_title'];
		$update_post_values ['no_of_vacancies'] = $values ['no_of_vacancies'];
		$update_post_values ['job_description'] = $values ['job_description'];
		$update_post_values ['job_skill_set'] = implode ( ',', $values ['key_skills'] );
		$update_post_values ['salary'] = $values ['salary'];
		$update_post_values ['experience'] = $values['experience'];
		$update_post_values ['last_date_for_applicants'] = $values['last_date_for_applicants'];
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
		$insert_applied_job_values ['eid'] = $this->user_details->eid;
		$insert_applied_job_values ['post_id'] = $values ['applied_post_id'];
		$insert_applied_job_values ['status'] = 'P';
		$insert_applied_job_values ['date_of_creation'] = new Zend_Db_Expr ( 'now()' );
		$insert_applied_job_values ['date_of_modification'] = new Zend_Db_Expr ( 'now()' );
		$this->db->insert ( 'ijp_job_applied_emp_details', $insert_applied_job_values );
	}
	function upadte_applied_job_post_status($values) {
		$this->db->update ( 'ijp_job_applied_emp_details', array (
				'status' => $values ['status'] 
		), array (
				'id =?' => $values ['applied_job_id'] 
		) );
	}
	function get_requested_posts_count() {
		$select_post_requests_count_query = $this->db->select ()->from ( 'ijp_job_posts', array (
				'requested_posts_count' => 'count(*)' 
		) )->where ( 'status = ?', 'P') ->where('posted_by = ?','M');
		 if($this->user_details->user_role == 'M'){
			$select_post_requests_count_query->where ( 'eid = ?', $this->user_details->eid );				
		}
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


	function get_applied_posts_count(){
		$select_applied_posts_count_query = $this->db->select ()->from ( array (
				'posts' => 'ijp_job_posts' 
		), array ('applied_posts_count' => 'count(*)' ) )->join ( array (
				'applied_posts' => 'ijp_job_applied_emp_details' 
		), 'applied_posts.post_id = posts.post_id',array('applied_job_status' => 'applied_posts.status' ) )->where ( 'applied_posts.eid = ?', $this->user_details->eid )
			->where ( 'posts.status = ?', 'A' )->where ( 'applied_posts.status != ?', 'D' );
		
		return $this->db->fetchRow ( $select_applied_posts_count_query );
	}


	function get_applied_job_posts(){

		$utilities = new application_models_Utilities();
        $user_details = $utilities->get_user_details();
                       
		$get_posts_query = $this->db->select ()->from ( array (
				'emp' => 'ijp_employees_list' 
		) )->join ( array (
				'applied_jobs' => 'ijp_job_applied_emp_details' 
		), 'applied_jobs.eid = emp.eid', array (
				'applied_post_id' => 'post_id','applied_job_status'=>'status','applied_job_id'=>'id' 
		) )->join ( array (
				'posts' => 'ijp_job_posts' 
		), 'applied_jobs.post_id = posts.post_id' )->join ( array (
				'projects' => 'ijp_projects_list' 
		), 'posts.project_id = projects.project_id', array (
				'project_name' => 'name' 
		) )->where ( 'applied_jobs.eid = ?', $user_details->eid )
		->where ( 'posts.status = ?', 'A' )->where ( 'applied_jobs.status != ?', 'D' )->order ( 'posts.date_of_creation desc' );

		 if($user_details->user_role == 'M'){
			//$get_posts_query->where ( 'posts.eid = ?', $user_details->eid );				
		}

		if($user_details->user_role == 'E'){
			$get_posts_query->where ( 'applied_jobs.eid = ?', $user_details->eid );
		}
		//echo $get_posts_query;
		return $this->db->fetchAll ( $get_posts_query );
	}

	
}