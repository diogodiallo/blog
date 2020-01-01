<?php

namespace App\Backend;

use \Core\Application;

class BackendApplication extends Application
{
	public function __construct()
	{
		parent::__construct();

		$this->name = 'Backend';
	}

	public function run()
	{
		if ($this->user->isAuthenticated()) {
			$controller = $this->getController();
			$controller->execute();
			$this->httpResponse->setPage($controller->page());
			$this->httpResponse->send();
		} else {
			$this->httpResponse()->redirect('/login');
		}
	}
}
