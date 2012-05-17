<?php

/**
 *  CoreIntegration_Twig_View class which handles Twig Environment and Twig Rendering
 *  @package application
 *  @author Dhaval Budhelia
 */
class CoreIntegration_Twig_View extends Zend_View_Abstract
{
	protected $_twig;
	protected $_loader;
	protected $_variables = array();

	public function __construct($config)
	{
		$this->_loader = new Twig_Loader_Filesystem($config['template_paths']);
		$this->_twig = new Twig_Environment($this->_loader, $config);
	}

	public function setScriptPath($path)
	{
		var_dump($path);
		if (is_readable($path)) {
			$currentPaths = $this->_loader->getPaths();
			$currentPaths[] = $path;
			$this->_loader->setPaths(array_unique($currentPaths));
			return;
		}

		throw new Exception('Invalid path provided');
	}

	public function getScriptPaths()
	{
		return $this->_loader->getPaths();
	}

	public function setBasePath($path, $prefix = 'Zend_View')
	{
		return $this->setScriptPath($path);
	}

	public function addBasePath($path, $prefix = 'Zend_View')
	{
		return $this->setScriptPath($path);
	}

	public function __set($key, $val)
	{
		$this->_variables[$key] = $val;
	}

	public function render($name)
	{
		$this->_variables['content'] = $this->layout()->content;
		return $this->_twig->render($name, $this->_variables);
	}

	public function _run()
	{

	}
}