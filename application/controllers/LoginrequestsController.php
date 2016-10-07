<?php

class LoginrequestsController extends Zend_Controller_Action
{
    public function init()
    {
        $storage = Zend_Auth::getInstance()->getIdentity();
        if($storage){
            $storage->active_page="login_requests";
        }
    }

    public function indexAction()
    {
        //$this->_helper->layout ()->disableLayout ();
        //$this->_helper->viewRenderer->setNoRender(true);
        $login_request = new application_models_Loginrequests();
        $utilities = new application_models_Utilities ();
        $user_details = $utilities->get_user_details ();
        if($user_details->user_role == 'A') {
        	$login_requests_data = $login_request->get_login_requets();
        } else if($user_details->user_role == 'M') {
        	$login_requests_data = $login_request->get_login_requests_for_manager();
        }
        $this->view->login_requests_data = $login_requests_data;
    }

    public function acceptrequestAction()
    {
        $request_params = $this->getRequest()->getParams();
        $this->_helper->layout()->disableLayout();
        // $this->_helper->viewRenderer->setNoRender(true);
        if ($this->getRequest()->isPost()) {
            $request_params ['status'] = 'A';
            $login_request = new application_models_Loginrequests();
            $login_request->update_login_request_status($request_params);
            $login_requests_data = $login_request->get_login_requets();
            $this->view->login_requests_data = $login_requests_data;
            $this->renderScript('loginrequests/includes/loginrequestsdisplay.phtml');
        }
    }

    public function deleteloginrequestAction()
    {
        $request_params = $this->getRequest()->getParams();
        $this->_helper->layout()->disableLayout();
        // $this->_helper->viewRenderer->setNoRender(true);
        if ($this->getRequest()->isPost()) {
            $request_params ['status'] = 'D';
            $login_request = new application_models_Loginrequests();
            $login_requests_data = $login_request->update_login_request_status($request_params);
            $login_requests_data = $login_request->get_login_requets();
            $this->view->login_requests_data = $login_requests_data;
            $this->renderScript('loginrequests/includes/loginrequestsdisplay.phtml');
        }
    }
}