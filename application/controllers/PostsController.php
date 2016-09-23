<?php

class PostsController extends Zend_Controller_Action
{

    public function init()
    {
		
    }

    public function indexAction()
    {

       $posts = new Application_models_Posts();
       $posts_data = $posts->get_posts();
       $this->view->posts_data = $posts_data;
    }

public function addAction(){
    $request_params = $this->getRequest()->getParams();
                if($this->getRequest()->isPost()){
                   
                }
}	
	
}