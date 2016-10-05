<?php
class PostsController extends Zend_Controller_Action {

	private $user_details;
	public function init() {
		$utilities = new application_models_Utilities();
        $this->user_details = $utilities->get_user_details();

	}
	public function indexAction() {
		$posts = new application_models_Posts ();
		$posts_data = $posts->get_posts ();
		$projects_list = $posts->get_projects_list ();
		if($this->user_details->user_role == 'E'){
				$applied_posts_count = $posts->get_applied_posts_count();
		        $this->view->applied_posts_count = $applied_posts_count['applied_posts_count'];
		}else {//if($this->user_details->user_role == 'A' || $this->user_details->user_role == 'E'  ){
			$requested_posts_count = $posts->get_requested_posts_count ();
			$this->view->requested_posts_count = $requested_posts_count['requested_posts_count'];
			$this->view->projects_list = $projects_list;
		}
		$this->view->posts_data = $posts_data;
		
		
	}
	public function addAction() {
		$request_params = $this->getRequest ()->getParams ();
		$this->_helper->layout ()->disableLayout ();
		// $this->_helper->viewRenderer->setNoRender(true);
		if ($this->getRequest ()->isPost ()) {
			$posts = new application_models_Posts ();
			$posts->add_posts ( $request_params );
			if ($request_params['current_page'] == 'JOB_POST_REQUESTS') {
				$posts_data = $posts->get_requested_posts ();
			} else {
				$posts_data = $posts->get_posts ();
			}
			$this->view->active_posts_data = $posts_data;
			$this->renderScript ( 'posts/includes/postsdisplay.phtml' );
		}
	}
	public function deleteAction() {
		$request_params = $this->getRequest ()->getParams ();
		$this->_helper->layout ()->disableLayout ();
		// $this->_helper->viewRenderer->setNoRender(true);
		if ($this->getRequest ()->isPost ()) {
			$posts = new application_models_Posts ();
			$request_params ['status'] = 'D';
			$posts->update_post_status ( $request_params );
			if ($request_params['from'] == 'jobpostrequests') {
				$posts_data = $posts->get_requested_posts ();
			} else {
				$posts_data = $posts->get_posts ();
			}
			$this->view->active_posts_data = $posts_data;
			$this->renderScript ( 'posts/includes/postsdisplay.phtml' );
		}
	}
	function getpostdataAction() {
		$request_params = $this->getRequest ()->getParams ();
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		if ($this->getRequest ()->isPost ()) {
			$posts = new application_models_Posts ();
			
			$data = $posts->get_post_data ( $request_params );
			echo json_encode ( $data );
		}
	}
	function updateAction() {
		$request_params = $this->getRequest ()->getParams ();
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		if ($this->getRequest ()->isPost ()) {
			$posts = new application_models_Posts ();
			
			$data = $posts->update_posts ( $request_params );
			$posts_data = $posts->get_posts ();
			$this->view->active_posts_data = $posts_data;
			$this->renderScript ( 'posts/includes/postsdisplay.phtml' );
		}
	}

	public function approvepostAction() {
		$request_params = $this->getRequest ()->getParams ();
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender(true);
		if ($this->getRequest ()->isPost ()) {
			$posts = new application_models_Posts ();
			$request_params ['status'] = 'A';
			$posts->update_post_status ( $request_params );
			echo json_encode ( ['status' => 'success'] );
		} else {
			echo json_encode ( ['status' => 'fail'] );
		}
	}


	public function applyjobpostAction() {
		$request_params = $this->getRequest ()->getParams ();
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender(true);
		if ($this->getRequest ()->isPost ()) {
			$posts = new application_models_Posts ();
			$posts->apply_job_post ( $request_params );
			$posts_data = $posts->get_posts ();
			$this->view->active_posts_data = $posts_data;
			$this->renderScript ( 'posts/includes/postsdisplay.phtml' );
			
		} 
	}


	public function displayappliedjobpostsAction(){
		$request_params = $this->getRequest ()->getParams ();
		//$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender(true);
		if ($this->getRequest ()->isGet ()) {
			$posts = new application_models_Posts ();
			$posts_data = $posts->get_applied_job_posts ();
			$this->view->posts_data = $posts_data;
			$this->view->display_applied_posts =1;
			$this->renderScript ( 'posts/index.phtml' );
			
		} 
	}


	public function withdrawjobAction(){
		$request_params = $this->getRequest ()->getParams ();
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender(true);
		if ($this->getRequest ()->isPost ()) {
			$posts = new application_models_Posts ();
			$request_params['status'] = 'D';
			$posts->upadte_applied_job_post_status ($request_params);
			var_dump($posts_data);
			$posts_data = $posts->get_applied_job_posts ();
			$this->view->posts_data = $posts_data;
			$this->view->display_applied_posts =1;
			$this->renderScript ( 'posts/includes/postsdisplay.phtml' );
			
			
		} 
	}
}