<?php

class Admin_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
		echo "admin module index controller index action";
    }

	public function listAction()
	{
		echo "admin module index controller list action";
	}
}

