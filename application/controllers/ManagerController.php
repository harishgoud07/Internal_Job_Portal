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
        $this->view->posts_data = $posts_data;
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
	
}