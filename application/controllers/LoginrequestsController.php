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

	
}