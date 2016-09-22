<?php
class application_plugins_session extends Zend_Controller_Plugin_Abstract {
	public function preDispatch(Zend_Controller_Request_Abstract $request) {
		$module = $request->getModuleName ();
		$controller = $request->getControllerName ();
		$action = $request->getActionName ();

        if(!($controller == 'index' && $action == 'index' && $controller == 'error' && $action == 'error')){
            $storage = Zend_Auth::getInstance();
            if(!$storage->hasIdentity()){
                 $request->setControllerName ('index')->setActionName ('index');
            }
        }else{
            $storage = Zend_Auth::getInstance();
            if($storage->hasIdentity()){
                   if($user_data->user_role == 'A'){
                       $request->setControllerName('admin')
                               ->setActionName('index');
                  }else if($user_data->user_role == 'M'){
                       $request->setControllerName('manager')
                               ->setActionName('index');
                  }else if($user_data->user_role == 'E'){
                      $request->setControllerName('employee')
                              ->setActionName('index');
                      
                  }
             }
        }
		
	}
} 