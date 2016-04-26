<?php

class Default_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
		
		$params = $this->getRequest()->getParams();
		
		if($params['module'] != 'default' || $params['controller'] != 'index' || $params['action'] != 'index') {
			echo "inside";
			$this->_redirect('/');
		}
		echo "default module index controller index action";
		//echo "<pre>";print_r($this->getRequest());die;
		
    }


}

