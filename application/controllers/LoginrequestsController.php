<<<<<<< HEAD
<?php

class LoginrequestsController extends Zend_Controller_Action
{

    public function init()
    {
		
    }

    public function indexAction()
    {
        //$this->_helper->layout ()->disableLayout ();
		//$this->_helper->viewRenderer->setNoRender(true);
        $login_request = new application_models_Loginrequests();
        $login_requests_data = $login_request->get_login_requets();
        $this->view->login_requests_data  = $login_requests_data;
           
    }

	public function acceptrequestAction()
	{
		$request_params = $this->getRequest ()->getParams ();
		$this->_helper->layout ()->disableLayout ();
		// $this->_helper->viewRenderer->setNoRender(true);
		if ($this->getRequest ()->isPost ()) {
            $request_params ['status'] = 'A';
			$login_request = new application_models_Loginrequests();
            $login_requests_data = $login_request->update_login_request_status($request_params);
             $login_requests_data = $login_request->get_login_requets();
            $this->view->login_requests_data  = $login_requests_data;
			$this->renderScript ( 'posts/includes/postsdisplay.phtml' );
		}
	}

public function deleteloginrequestAction()
	{
		$request_params = $this->getRequest ()->getParams ();
		$this->_helper->layout ()->disableLayout ();
		// $this->_helper->viewRenderer->setNoRender(true);
		if ($this->getRequest ()->isPost ()) {
            $request_params ['status'] = 'D';
			$login_request = new application_models_Loginrequests();
            $login_requests_data = $login_request->update_login_request_status($request_params);
             $login_requests_data = $login_request->get_login_requets();
            $this->view->login_requests_data  = $login_requests_data;
			$this->renderScript ( 'loginrequests/includes/loginrequestsdisplay.phtml' );
		}
	}
	
=======
<?php

class LoginrequestsController extends Zend_Controller_Action
{

    public function init()
    {
		
    }

    public function indexAction()
    {
        //$this->_helper->layout ()->disableLayout ();
		//$this->_helper->viewRenderer->setNoRender(true);
        $login_request = new application_models_Loginrequests();
        $login_requests_data = $login_request->get_login_requets();
        $this->view->login_requests_data  = $login_requests_data;
           
    }

	public function registerAction()
	{
		
	}

	
>>>>>>> d6f9a4fcfada4ee6f844ccca6b7ed56aca75ceae
}