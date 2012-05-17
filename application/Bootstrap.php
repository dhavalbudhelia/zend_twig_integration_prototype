<?php

/**
 *  Bootstrap class which handles bootstraping of entire system
 *  @package application
 *  @author Dhaval Budhelia
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initView()
	{
		$config = $this->getOption('twig');
		$config['template_paths'] = array(APPLICATION_PATH . '/views/scripts/',APPLICATION_PATH . '/views/layouts/');

		include_once 'CoreIntegration/Twig/View.php';
		$view = new CoreIntegration_Twig_View($config);

		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
		$viewRenderer->setView($view)
		->setViewScriptPathSpec(':controller/:action.:suffix')
		->setViewScriptPathNoControllerSpec(':action.:suffix')
		->setViewSuffix('twig');
		Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
		return $view;
	}

}