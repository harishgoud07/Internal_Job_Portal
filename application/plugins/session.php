<?php
class application_plugins_session extends Zend_Controller_Plugin_Abstract {
	public function preDispatch(Zend_Controller_Request_Abstract $request) {
		$module = $request->getModuleName ();
		$controller = $request->getControllerName ();
		$action = $request->getActionName ();
		
        if(!($controller == 'error' && $action == 'error')){
             if(!(($controller == 'index' && ($action == 'index' || $action == 'isemployeerefexists')))){
             $storage = Zend_Auth::getInstance()->getIdentity();
             
            if(!$storage->user_role){
                 $request->setControllerName ('index')->setActionName ('index');
            }
        }else{
            
            $storage = Zend_Auth::getInstance()->getIdentity();
            if($storage->user_role){
                   if($storage->user_role == 'A'){
                       $request->setControllerName('admin')
                               ->setActionName('index');
                  }else if($storage->user_role == 'M'){
                       $request->setControllerName('manager')
                               ->setActionName('index');
                  }else if($storage->user_role == 'E'){
                      $request->setControllerName('employee')
                              ->setActionName('index');
                      
                  }
             }
        }
        }
       
		
	}
} 