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
		), 'applied_jobs.post_id = posts.post_id and applied_jobs.eid = '.$user_details->eid, array (
				'not_applied_post_id' => 'post_id' 
		) )->where ( 'applied_jobs.post_id is null' )
		
		->where('posts.last_date_for_applicants >= ?',new Zend_Db_Expr ( 'now()' ));;
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
		$insert_post_values ['job_location'] = $values ['job_location'];
		$insert_post_values ['job_description'] = $values ['job_description'];
		if (count($values ['key_skills']) > 0) {
			$insert_post_values ['job_skill_set'] = implode ( ',', $values ['key_skills'] );
		}
		$insert_post_values ['salary'] = $values ['salary'];
		$insert_post_values ['experience'] = $values['experience'];
		$insert_post_values ['status'] = $this->user_details->user_role == 'M' ? 'P' : 'A';
		$insert_post_values ['project_id'] = $values ['project_id'];
		$insert_post_values ['eid'] = $this->user_details->eid;
		$insert_post_values ['no_of_vacancies'] = $values ['no_of_vacancies'];
		$insert_post_values ['posted_by'] = $this->user_details->user_role;
		$insert_post_values ['last_date_for_applicants'] = $values['last_date_for_applicants'];
		$insert_post_values ['date_of_creation'] = new Zend_Db_Expr ( 'now()' );
		$insert_post_values ['date_of_modification'] = new Zend_Db_Expr ( 'now()' );
		$this->db->insert ( 'ijp_job_posts', $insert_post_values );
	}
	function update_posts($values) {
		$update_post_values ['job_title'] = $values ['job_title'];
		$update_post_values ['job_location'] = $values ['job_location'];
		$update_post_values ['no_of_vacancies'] = $values ['no_of_vacancies'];
		$update_post_values ['job_description'] = $values ['job_description'];
		if (count($values ['key_skills']) > 0) {
			$update_post_values ['job_skill_set'] = implode ( ',', $values ['key_skills'] );
		}
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

		if($values ['status'] == 'A'){
				$post_details_query = $this->db->select ()->from ( array('applied_job'=>'ijp_job_applied_emp_details'),array('job_applied_emp'=>'eid') )
				->join (array('posts'=>'ijp_job_posts'),'posts.post_id = applied_job.post_id')
				->where ( 'id = ?',$values ['applied_job_id']) ;
				$post_details = $this->db->fetchRow ( $post_details_query );
				$this->db->update ( 'ijp_emp_manager_mapping', array (
				'is_deleted' => 1 
		), array (
				'eid =?' =>$post_details['job_applied_emp']
		) );
		$this->db->update ( 'ijp_employees_project_mapping', array (
				'is_deleted' => 1 
		), array (
				'eid =?' =>$post_details['job_applied_emp']
		) );
		$values ['last_inserted_emp_id'] = $post_details['job_applied_emp'];
		$values ['project_id'] = $post_details['project_id'];
		$values ['manager_id'] = $post_details['eid'];
		$registration = new application_models_Register();
		$registration->store_emp_project_mapping($values);
		$registration->store_emp_manager_mapping($values);
		}
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
		), 'posts.project_id = projects.project_id' )->where ( 'post_id = ?', $values ['post_id'] );
		 if($this->user_details->user_role != 'M'){
			$select_post_query->where ( 'status = ?', 'A' );				
		}
		//echo $select_post_query;
		return $this->db->fetchRow ( $select_post_query );
	}


	function get_applied_posts_count(){
		$select_applied_posts_count_query = $this->db->select ()->from ( array (
				'posts' => 'ijp_job_posts' 
		), array ('applied_posts_count' => 'count(*)' ) )->join ( array (
				'applied_posts' => 'ijp_job_applied_emp_details' 
		), 'applied_posts.post_id = posts.post_id',array('applied_job_status' => 'applied_posts.status' ) )->where ( 'applied_posts.eid = ?', $this->user_details->eid )
			->where ( 'posts.status = ?', 'A' )->where ( 'applied_posts.status != ?', 'D' )->group('applied_job_status');;
		return $this->db->fetchRow ( $select_applied_posts_count_query );
	}


	function get_applied_job_posts($values = array()){

		$utilities = new application_models_Utilities();
        $user_details = $utilities->get_user_details();
                       
		$get_posts_query = $this->db->select ()->from ( array (
				'emp' => 'ijp_employees_list' 
		),array('employee_id'=>'eid','name','address','email','emp_ref','key_skills','user_role') )->join ( array (
				'applied_jobs' => 'ijp_job_applied_emp_details' 
		), 'applied_jobs.eid = emp.eid', array (
				'applied_post_id' => 'post_id','applied_job_status'=>'status','applied_job_id'=>'id','applied_date' =>'date_of_creation' 
		) )->join ( array (
				'posts' => 'ijp_job_posts' 
		), 'applied_jobs.post_id = posts.post_id' )->join ( array (
				'projects' => 'ijp_projects_list' 
		), 'posts.project_id = projects.project_id', array (
				'project_name' => 'name' 
		) )		->where ( 'posts.status = ?', 'A' )->where ( 'applied_jobs.status != ?', 'D' )->order ( 'posts.date_of_creation desc' );

		 if($user_details->user_role == 'M'){
			$get_posts_query->where ( 'posts.eid = ? OR  posted_by = \'A\'', $user_details->eid );
			if($values['post_id'] && $values['project_id']){
				$get_posts_query->where ( 'posts.post_id = ?', $values['post_id'] )->where ( 'posts.project_id = ?',$values['project_id'] );
				
			}
		}

		if($user_details->user_role == 'E'){
			$get_posts_query->where ( 'applied_jobs.eid = ?', $user_details->eid );
							//->where('posts.last_date_for_applicants >= ?',new Zend_Db_Expr ( 'now()' ));
							

		}
		//echo $get_posts_query;
		return $this->db->fetchAll ( $get_posts_query );
	}

public function get_manager_related_projects($values){
				$get_manager_project_details = $this->db->select ()->from ( array (
				'projects' => 'ijp_projects_list' 
		),array('name','project_id') )->join ( array (
				'mapping' => 'ijp_employees_project_mapping' 
		), 'projects.project_id = mapping.project_id' )->where ( 'mapping.eid = ?', $this->user_details->eid );
		//echo $get_manager_project_details;
		return $this->db->fetchAll($get_manager_project_details);
	}
	
	public function get_emp_details($values){
		$get_emp_details = $this->db->select ()->from ( array (
				'ijp_employees_list' 
		),array('name','eid','cv_path') )->where ( 'eid = ?', $values['eid'] );
		//echo $get_manager_project_details;
		return $this->db->fetchRow($get_emp_details);
	}

	function get_posts_for_project($values){
	$get_posts_details = $this->db->select ()->from ( array (
				'ijp_job_posts' 
		),array('post_id','eid','job_title') )->where ( 'status = ?', 'A' )->where ( 'eid = ? OR posted_by = \'A\'',$this->user_details->eid  )
		->where ( 'project_id = ?', $values['project_id'] );
		//echo $get_manager_project_details;
		return $this->db->fetchAll($get_posts_details);
	}


	function get_current_project_details(){
		$get_project_details = $this->db->select ()->from ( array (
				'mapping'=>'ijp_employees_project_mapping' 
		))->join(array('emp'=>'ijp_projects_list'),'mapping.project_id = emp.project_id',array('name'))->where ( 'mapping.eid = ?', $this->user_details->eid )
		->where ( 'is_deleted = ?', 0 )->order('date_of_modification desc');;
		//echo $get_manager_project_details;
		return $this->db->fetchRow($get_project_details);
	}

	function get_current_manager_details(){
		$get_project_details = $this->db->select ()->from ( array (
				'mapping'=>'ijp_emp_manager_mapping' 
		))->join(array('emp'=>'ijp_employees_list'),'mapping.manager_id = emp.eid',array('name'))
		->where ( 'mapping.eid = ?', $this->user_details->eid )
		->where ( 'is_deleted = ?', 0 );;
		//echo $get_project_details;
		return $this->db->fetchRow($get_project_details);
	}



	function get_previous_project_details(){
		$get_project_details = $this->db->select ()->from ( array (
				'mapping'=>'ijp_employees_project_mapping' 
		))->join(array('emp'=>'ijp_projects_list'),'mapping.project_id = emp.project_id',array('name'))->where ( 'mapping.eid = ?', $this->user_details->eid )
		->where ( 'is_deleted = ?', 1 )->order('date_of_modification desc');;
		//echo $get_manager_project_details;
		return $this->db->fetchRow($get_project_details);
	}

	function get_previous_manager_details(){
		$get_project_details = $this->db->select ()->from ( array (
				'mapping'=>'ijp_emp_manager_mapping'
		))->join(array('emp'=>'ijp_employees_list'),'mapping.manager_id = emp.eid',array('name'))
		->where ( 'mapping.eid = ?', $this->user_details->eid )
		->where ( 'is_deleted = ?', 1 )->order('date_of_modification desc');;
		//echo $get_manager_project_details;
		return $this->db->fetchRow($get_project_details);
	}
	
}