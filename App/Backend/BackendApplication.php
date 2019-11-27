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
      if ($this->user->isAuthenticated())
      {
        $controller = $this->getController();
      }
      else
      {
        $controller = new Modules\Connection\ConnectionController($this, 'Connection', 'index');
      }
    
      $controller->execute();
    
      $this->httpResponse->setPage($controller->page());
      $this->httpResponse->send();
    }
}