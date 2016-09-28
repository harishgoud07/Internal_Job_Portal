<<<<<<< HEAD
<?php

class AdminController extends Zend_Controller_Action
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

    public function jobpostrequestsAction() {
        $posts = new application_models_Posts ();
        $posts_data = $posts->get_requested_posts ();
        $this->view->posts_data = $posts_data;
    }

    public function loginrequestsAction() {
        $this->_forward('index', 'loginrequests', null);
    }

	
=======
<?php

class AdminController extends Zend_Controller_Action
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

    public function jobpostrequestsAction() {
        $posts = new application_models_Posts ();
        $posts_data = $posts->get_requested_posts ();
        $this->view->posts_data = $posts_data;
    }

    public function loginrequestsAction() {

    }

	
>>>>>>> d6f9a4fcfada4ee6f844ccca6b7ed56aca75ceae
}