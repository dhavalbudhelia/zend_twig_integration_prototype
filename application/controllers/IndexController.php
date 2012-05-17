<?php

class IndexController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$this->view->phpversion = phpversion();
		$this->view->phpuname = php_uname();
	}
}

