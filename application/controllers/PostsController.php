<?php
class PostsController extends Zend_Controller_Action {
	public function init() {
	}
	public function indexAction() {
		$posts = new application_models_Posts ();
		$posts_data = $posts->get_posts ();
		$projects_list = $posts->get_projects_list ();
		$requested_posts_count = $posts->get_requested_posts_count ();
		$this->view->posts_data = $posts_data;
		$this->view->projects_list = $projects_list;
		$this->view->requested_posts_count = $requested_posts_count;
	}
	public function addAction() {
		$request_params = $this->getRequest ()->getParams ();
		$this->_helper->layout ()->disableLayout ();
		// $this->_helper->viewRenderer->setNoRender(true);
		if ($this->getRequest ()->isPost ()) {
			$posts = new application_models_Posts ();
			$posts->add_posts ( $request_params );
			$posts_data = $posts->get_posts ();
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
			$posts_data = $posts->get_posts ();
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
}