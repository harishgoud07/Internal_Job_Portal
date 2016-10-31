<?php
class IndexController extends Zend_Controller_Action {
	public function init() {
		$storage = Zend_Auth::getInstance()->getIdentity();
		if($storage){
			$storage->active_page="profile";
		}
	}
	public function indexAction() {
		$request_params = $this->getRequest ()->getParams ();
		$this->_helper->layout ()->disableLayout ();
		if ($this->getRequest ()->isPost ()) {
			if ($request_params ['username'] && $request_params ['password'] && $request_params ['login']) {
				$db = Zend_Db_Table::getDefaultAdapter ();
				$auth = Zend_Auth::getInstance ();
				$adapter = new Zend_Auth_Adapter_DbTable ( $db, 'ijp_employees_list', 'emp_ref', 'password' );
				$adapter->setIdentity ( $request_params ['username'] );
				$adapter->setCredential ( md5($request_params ['password']) );
				$result = $auth->authenticate ( $adapter );
				if ($result->isValid ()) {
					$storage = new Zend_Auth_Storage_Session ();
					$logged_in_user_details = $adapter->getResultRowObject ();
					$employee = new application_models_Employee();
					if (!($logged_in_user_details->user_role != 'A' && !$employee->is_employee_authenticated($logged_in_user_details->eid))) {
						unset ( $logged_in_user_details->password );
						$storage->write ( $logged_in_user_details );
						if ($logged_in_user_details->user_role == 'A') {
							$this->_redirect ( 'admin' );
						} else if ($logged_in_user_details->user_role == 'M') {
							$this->_redirect ( 'manager' );
						} else if ($logged_in_user_details->user_role == 'E') {
							$this->_redirect ( 'employee' );
						}
					} else {
						$this->view->not_authenticated = 'yes';
					}
				} else {
					$this->view->invalid_user = 'yes';
				}
			} else if ($request_params ['register']) {
				if ( $request_params ['full_name'] && 
						$request_params ['emp_ref'] && 
						$request_params ['email'] && 
						$request_params ['address'] && 
						$request_params ['password'] &&
						$request_params ['project_id'] && $request_params ['user_role'] ) {
					$upload = new Zend_File_Transfer ();
					$files = $upload->getFileInfo ();
					foreach ( $files as $file => $info ) {
 						if (! $upload->isUploaded ( $file ) && ! $upload->isValid ( $file )) {
 							continue;
 						}
						if($file=='user_image') {
							$request_params['image_path'] = $_SERVER['server_name'].DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'user_images'.DIRECTORY_SEPARATOR.''.$request_params['emp_ref'].'_'.$info['name'];
							$image_storage_path = APPLICATION_PATH.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'user_images'.DIRECTORY_SEPARATOR.''.$request_params['emp_ref'].'_'.$info['name'];
							$upload->addFilter('Rename', array('target' => $image_storage_path, 'overwrite' => true), $file);
						} else {
							$request_params['cv_path'] = $_SERVER['server_name'].DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'user_cvs'.DIRECTORY_SEPARATOR.''.$request_params['emp_ref'].'_'.$info['name'];
							$cv_storage_path = APPLICATION_PATH.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'user_cvs'.DIRECTORY_SEPARATOR.''.$request_params['emp_ref'].'_'.$info['name'];
							$upload->addFilter('Rename', array('target' => $cv_storage_path, 'overwrite' => true), $file);
						}
						$upload->receive ($file);
					}
					$register = new application_models_Register();
					$register->do_register($request_params);
					$this->view->registration_status = 'success';
				}
			}
		}

			$posts = new application_models_Posts();
			$projects_list = $posts->get_projects_list ();
			//$managers = new application_models_Employee();
			//$managers_list = $managers->getAvailableManagers();
			$this->view->projects_list = $projects_list;
			$this->view->managers_list = array();//$managers_list;
	}

	public function editprofileAction() {
		$request_params = $this->getRequest ()->getParams ();
		if ($this->getRequest ()->isPost ()) {
			if ($request_params ['update']) {
				if ( $request_params ['full_name'] &&
						$request_params ['emp_ref'] &&
						$request_params ['email'] &&
						$request_params ['address'] &&
						$request_params ['eid']) {
							$upload = new Zend_File_Transfer ();
							$files = $upload->getFileInfo ();
							foreach ( $files as $file => $info ) {
								if (! $upload->isUploaded ( $file ) && ! $upload->isValid ( $file )) {
									continue;
								}
								if($file=='user_image') {
									$request_params['image_path'] = $_SERVER['server_name'].DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'user_images'.DIRECTORY_SEPARATOR.''.$request_params['emp_ref'].'_'.$info['name'];
									$image_storage_path = APPLICATION_PATH.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'user_images'.DIRECTORY_SEPARATOR.''.$request_params['emp_ref'].'_'.$info['name'];
									$upload->addFilter('Rename', array('target' => $image_storage_path, 'overwrite' => true), $file);
								} else {
									$request_params['cv_path'] = $_SERVER['server_name'].DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'user_cvs'.DIRECTORY_SEPARATOR.''.$request_params['emp_ref'].'_'.$info['name'];
									$cv_storage_path = APPLICATION_PATH.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'user_cvs'.DIRECTORY_SEPARATOR.''.$request_params['emp_ref'].'_'.$info['name'];
									$upload->addFilter('Rename', array('target' => $cv_storage_path, 'overwrite' => true), $file);
								}
								$upload->receive ($file);
							}
							$register = new application_models_Register();
							$register->update_employee($request_params);
							
					}
			}
		}
		$employee = new application_models_Employee();
		$storage = Zend_Auth::getInstance()->getIdentity();
		if($storage->eid){
			$emp_id = $storage->eid;
		}
		$posts = new application_models_Posts();
		$projects_list = $posts->get_projects_list ();
		$managers = new application_models_Employee();
		$managers_list = $managers->getAvailableManagers();
		$utilities = new application_models_Utilities ();
		$user_details = $utilities->get_user_details();
		if($user_details->user_role =='E'){
			$this->view->current_project = $posts->get_current_project_details();
			$this->view->current_manager = $posts->get_current_manager_details();
			$this->view->previous_project = $posts->get_previous_project_details();
			$this->view->previous_manager = $posts->get_previous_manager_details();
		}
		$this->view->projects_list = $projects_list;
		$this->view->managers_list = $managers_list;
		$this->view->employee_details = json_decode(json_encode($employee->getEmployeeDetails($emp_id)), FALSE);
	}
	
	public function isemployeerefexistsAction() {
		$request_params = $this->getRequest ()->getParams ();
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		if ($this->getRequest ()->isPost ()) {
			if ($request_params['emp_ref']) {
				$register = new application_models_Register();
				$emp_details = $register->getEmployeeWithRef($request_params['emp_ref']);
				if($emp_details['eid']) {
					echo json_encode(['exists' => true]);
				} else {
					echo json_encode(['exists' => false]);
				}
			}
		}
	}
	
	public function logoutAction() {
		Zend_Auth::getInstance ()->clearIdentity ();
		$this->_redirect ( '/' );
	}

	public function getmanagersAction(){
		
		 $request_params = $this->getRequest()->getParams();
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        if ($this->getRequest()->isPost()) {
            $managers = new application_models_Employee();
		    $managers_list = $managers->get_managers_of_project($request_params);
			echo json_encode($managers_list);
        }
	}
}