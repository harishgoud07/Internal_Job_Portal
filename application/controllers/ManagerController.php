<?php

class ManagerController extends Zend_Controller_Action
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

	
}