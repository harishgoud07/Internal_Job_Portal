<<<<<<< HEAD
<?php

class EmployeeController extends Zend_Controller_Action
{

    public function init()
    {
		
    }

    public function indexAction()
    {
         $this->_forward('index', 'posts', null);
    }

	public function loginrequestsAction() {
        $this->_forward('index', 'loginrequests', null);
    }


	
=======
<?php

class EmployeeController extends Zend_Controller_Action
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

	
>>>>>>> d6f9a4fcfada4ee6f844ccca6b7ed56aca75ceae
}