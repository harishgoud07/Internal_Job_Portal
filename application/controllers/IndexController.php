<?php
class IndexController extends Zend_Controller_Action {
	public function init() {
	}
	public function indexAction() {
		$request_params = $this->getRequest ()->getParams ();
		if ($this->getRequest ()->isPost ()) {
			if ($request_params ['username'] && $request_params ['password'] && $request_params ['login']) {
				$db = Zend_Db_Table::getDefaultAdapter ();
				$auth = Zend_Auth::getInstance ();
				$adapter = new Zend_Auth_Adapter_DbTable ( $db, 'ijp_employees_list', 'emp_ref', 'password' );
				$adapter->setIdentity ( $request_params ['username'] );
				$adapter->setCredential ( $request_params ['password'] );
				$result = $auth->authenticate ( $adapter );
				// svar_dump($result->isValid());exit;
				if ($result->isValid ()) {
					$storage = new Zend_Auth_Storage_Session ();
					$logged_in_user_details = $adapter->getResultRowObject ();
					unset ( $logged_in_user_details->password );
					$storage->write ( $logged_in_user_details );
					if ($logged_in_user_details->user_role == 'A') {
						$this->_redirect ( 'admin' );
					} else if ($logged_in_user_details->user_role == 'M') {
						$this->_redirect ( 'manager' );
					} else if ($logged_in_user_details->user_role == 'E') {
						$this->_redirect ( 'employee' );
					}
				}
			} else if ($request_params ['register']) {
				if ( $request_params ['full_name'] && 
						$request_params ['emp_ref'] && 
						$request_params ['email'] && 
						$request_params ['address'] && 
						$request_params ['password'] ) {
					$upload = new Zend_File_Transfer ();
					$files = $upload->getFileInfo ();
					foreach ( $files as $file => $info ) {
 						if (! $upload->isUploaded ( $file ) && ! $upload->isValid ( $file )) {
 							continue;
 						}
						if($file=='user_image') {
							$request_params['image_path'] = APPLICATION_PATH.'\\..\\upload\\user_images\\'.$request_params['emp_ref'].'_'.$info['name'];
							$upload->addFilter('Rename', array('target' => $request_params['image_path'], 'overwrite' => true), $file);
						} else {
							$request_params['cv_path'] = APPLICATION_PATH.'\\..\\upload\\user_cvs\\'.$request_params['emp_ref'].'_'.$info['name'];
							$upload->addFilter('Rename', array('target' => $request_params['cv_path'], 'overwrite' => true), $file);
						}
						$upload->receive ($file);
					}
					$register = new application_models_Register();
					$register->do_register($request_params);
				}
			}		
		}
	}
	
	public function editprofileAction() {
		$request_params = $this->getRequest ()->getParams ();
		if ($this->getRequest ()->isPost ()) {
			
		}
	}
	
	public function registerAction() {
		$request_params = $this->getRequest ()->getParams ();
		if ($this->getRequest ()->isPost ()) {
		}
	}
	public function logoutAction() {
		Zend_Auth::getInstance ()->clearIdentity ();
		$this->_redirect ( '/' );
	}
}