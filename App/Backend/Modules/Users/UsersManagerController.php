<?php
namespace App\Backend\Modules\Users;
 
use \Core\BackController;
use \Core\HTTPRequest;
 
class UsersManagerController extends BackController
{
  public function index(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Connexion');
 
    if ($request->postExists('login')) {
      $login = $request->postData('login');
      $password = $request->postData('password');
 
      if ($login == $this->app->config()->get('login') 
          && $password == $this->app->config()->get('pass')) {
        $this->app->user()->setAuthenticated(true);
        $this->app->httpResponse()->redirect('.');
      } else {
        $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
      }
    }
  }

  public function register(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Inscription');
    echo 'Inscription';
  }
}