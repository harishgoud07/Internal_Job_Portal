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
        $posts = new application_models_Posts();
        $projects_list = $posts->get_projects_list ();
        $this->view->projects_list = $projects_list;
        $this->view->managers_list = array();
    }

    public function loginrequestsAction()
    {
        $this->_forward('index', 'loginrequests', null);
    }
}