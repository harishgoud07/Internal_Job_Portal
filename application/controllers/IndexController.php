<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
		
    }

    public function indexAction()
    {
                $request_params = $this->getRequest()->getParams();
                if($this->getRequest()->isPost()){
                    if($request_params['username'] && $request_params['password']){
                   
                   $db = Zend_Db_Table::getDefaultAdapter();
                    
                    $auth = Zend_Auth::getInstance();
                $adapter = new Zend_Auth_Adapter_DbTable(
                $db,
                'ijp_employees_list',
                'emp_ref',
                'password');
 
            $adapter->setIdentity($request_params['username']);
            $adapter->setCredential($request_params['password']);
 
            $result = $auth->authenticate($adapter);
 //svar_dump($result->isValid());exit;
            if ($result->isValid()) {
                 $storage = new Zend_Auth_Storage_Session();
                 $logged_in_user_details = $adapter->getResultRowObject();
                 unset($logged_in_user_details->password);
                  $storage->write($logged_in_user_details);

                  if($logged_in_user_details->user_role == 'A'){
                     $this->_redirect('admin');
                  }else if($logged_in_user_details->user_role == 'M'){
                    $this->_redirect('manager');
                  }else if($logged_in_user_details->user_role == 'E'){
                      $this->_redirect('employee');
                  }
            }
        }       
                
    }
    }

	public function registerAction()
	{
		$request_params = $this->getRequest()->getParams();
                if($this->getRequest()->isPost()){
                   
                }
	}

	public function logoutAction(){

Zend_Auth::getInstance()->clearIdentity();
    $this->_redirect('/');
    }
}