<?php

class ManagerController extends Zend_Controller_Action
{

    public function init()
    {
		
    }

    public function indexAction()
    {
        $this->_forward('index', 'posts', null);
    }

	public function registerAction()
	{
		
	}
    public function loginrequestsAction() {
        $this->_forward('index', 'loginrequests', null);
    }

    public function jobpostrequestsAction() {
        $this->_forward('jobpostrequests', 'admin', null);
    }

    public function chooseemployeesforjobAction() {
        $posts = new application_models_Posts ();
        $projects_list = $posts->get_manager_related_projects ();
        $posts_data = $posts->get_posts ();
        $applied_job_posts_data = $posts->get_applied_job_posts();
        //$this->view->posts_data = $posts_data;
        $this->view->projects_list = $projects_list;
        $this->view->applied_job_posts_data = $applied_job_posts_data;
    }

    public function updateappliedjobstatusAction(){
        $request_params = $this->getRequest ()->getParams ();
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender(true);
		if ($this->getRequest ()->isPost ()) {
			$posts = new application_models_Posts ();
			$posts->upadte_applied_job_post_status ($request_params);
			$applied_job_posts_data = $posts->get_applied_job_posts ();
            $this->view->applied_job_posts_data = $applied_job_posts_data;
			$this->renderScript ( 'manager/includes/applied_posts_display.phtml' );
			
			
		} 
    }
	
    public function downloadcvAction(){
        $request_params = $this->getRequest ()->getParams ();
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender(true);
		if ($this->getRequest ()->isGet ()) {
			$posts = new application_models_Posts ();
            $emp_details = $posts->get_emp_details($request_params);
            $file = $emp_details['cv_path'];
            $file = APPLICATION_PATH .DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.$file;
           
    		header ( 'Content-Type: application/octet-stream' );
    		header ( 'Content-Disposition: attachment; filename="' . basename ( $file ) . '"' );
    		header ( 'Content-Length: ' . filesize ( $file ) );
            
    		readfile ( $file );
			
			
		} 
    }


     public function getpostsofprojectAction(){
        $request_params = $this->getRequest ()->getParams ();
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender(true);
		if ($this->getRequest ()->isPost ()) {
			$posts = new application_models_Posts ();
          $posts_data =  $posts->get_posts_for_project($request_params);

			echo json_encode($posts_data);
			
		} 
    }

    function getappliedpostsdataAction(){
        $this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender(true);
       
        $request_params = $this->getRequest ()->getParams ();
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender(true);
		if ($this->getRequest ()->isPost ()) {
	    $posts = new application_models_Posts ();
        $applied_job_posts_data = $posts->get_applied_job_posts($request_params);
        $this->view->applied_job_posts_data = $applied_job_posts_data;
        $this->renderScript ( 'manager/includes/applied_posts_display.phtml' );
			
		} 
    }
}