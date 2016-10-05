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
        $projects_list = $posts->get_projects_list ();
        $requested_posts_count = $posts->get_requested_posts_count ();
        $this->view->requested_posts_count = $requested_posts_count['requested_posts_count'];
        $this->view->projects_list = $projects_list;
    }
	
}