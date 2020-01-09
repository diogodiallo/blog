<?php

namespace Core;

abstract class Application
{
	protected $httpRequest;
	protected $httpResponse;
	protected $name;
	protected $user;
	protected $config;

	public function __construct()
	{
		$this->httpRequest = new HTTPRequest($this);
		$this->httpResponse = new HTTPResponse($this);
		$this->user = new User($this);
		$this->config = new Config($this);

		$this->name = '';
	}

	public function getController()
	{
		$router = new Router;

		$xml = new \DOMDocument;
		$xml->load('../App/' . $this->name . '/Config/routes.xml');

		$routes = $xml->getElementsByTagName('route');

		// We browse the routes of the XML file.
		foreach ($routes as $route) {
			$vars = [];

			// We check if variables are present in the URL.
			if ($route->hasAttribute('vars')) {
				$vars = explode(',', $route->getAttribute('vars'));
			}

			// We add the route to the router.
			$router->addRoute(new Route(
				$route->getAttribute('url'),
				$route->getAttribute('module'),
				$route->getAttribute('action'),
				$vars
			));
		}

		try {
			// We retrieve the corresponding route to the URL.
			$matchedRoute = $router->getRoute($this->httpRequest->requestURI());
		} catch (\RuntimeException $e) {
			if ($e->getCode() == Router::NO_ROUTE) {
				// If no route matches, the requested page does not exist.
				$this->httpResponse->redirect404();
			}
		}

		// We add the variables of the URL to the $ _GET array.
		$_GET = array_merge($_GET, $matchedRoute->vars());

		// We instantiate the controller.
		$controllerClass = 'App\\' . $this->name . '\\Modules\\' . $matchedRoute->module() . '\\' .
			$matchedRoute->module() . 'Controller';
		$controller = new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());

		if ($this->name == 'Backend') {
			if (!$this->user->isAuthenticated()) {
				$controllerClass = 'App\\' . $this->name . '\\Modules\\Users\\UsersController';
				$controller = new $controllerClass($this, 'Users', 'index');
			} else {
				if ( !(in_array(strtolower($matchedRoute->action() . ' '
					. $matchedRoute->module()), $this->user->rights()) ) ) {
					$this->user()->setFlash('Vous n\'avez pas le droit d\'accéder à l\'action désirée');
					$this->httpResponse()->redirect('http://perso.test/Public/index.php');
				}
			}
		}
		return $controller;
	}

	abstract public function run();

	public function httpRequest()
	{
		return $this->httpRequest;
	}

	public function httpResponse()
	{
		return $this->httpResponse;
	}

	public function name()
	{
		return $this->name;
	}

	public function config()
	{
		return $this->config;
	}

	public function user()
	{
		return $this->user;
	}
}
