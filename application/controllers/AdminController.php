<?php

class AdminController extends Zend_Controller_Action
{
    public function init()
    {
        $storage = Zend_Auth::getInstance()->getIdentity();
        if($storage){
            $storage->active_page="posts";
        }
    }
    public function indexAction()
    {
        $this->_forward('index', 'posts', null);
    }
    public function jobpostrequestsAction() {
        $posts = new application_models_Posts ();
        $projects_list = $posts->get_projects_list ();
        $active_posts_data = $posts->get_requested_posts ();
        $this->view->projects_list = $projects_list;
        $this->view->active_posts_data = $active_posts_data;
    }

    public function browseemployeesAction() {
        $storage = Zend_Auth::getInstance()->getIdentity();
        if($storage) {
            $storage->active_page = "browse_employees";
        }
        $request_params = $this->getRequest ()->getParams ();
        $utilities = new application_models_Utilities ();
		$user_details = $utilities->get_user_details ();
        $posts = new application_models_Posts();
        if($user_details->user_role == 'M'){
           $projects_list = $posts->get_manager_related_projects();
        }else{
            $projects_list = $posts->get_projects_list ();
        }
      
        $this->view->projects_list = $projects_list;
        $employee = new application_models_Employee();
        $employees_list = $employee->getEmployeesList($request_params);
        $this->view->managers_list = array();
        $this->view->employees_list = $employees_list;
        if ($this->getRequest ()->isPost ()) {
            $this->_helper->layout ()->disableLayout ();
            $this->_helper->viewRenderer->setNoRender(true);
            $this->renderScript('admin/includes/employees_list.phtml');
        }
    }

    public function loginrequestsAction()
    {
        $this->_forward('index', 'loginrequests', null);
    }
}