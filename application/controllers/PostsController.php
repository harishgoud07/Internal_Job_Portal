<?php

class PostsController extends Zend_Controller_Action
{

    public function init()
    {
		$db = Zend_Db_Table::getDefaultAdapter();
    }

    public function indexAction()
    {
        
    }

public function addAction(){
    $request_params = $this->getRequest()->getParams();
                if($this->getRequest()->isPost()){
                   
                }
}	
	
}