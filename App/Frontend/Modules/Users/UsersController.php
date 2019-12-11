<?php
namespace App\Frontend\Modules\Users;
 
use \Core\BackController;
use \Core\HTTPRequest;
use \Entity\User;
use \FormBuilder\RegisterFormBuilder;
use \FormBuilder\LoginFormBuilder;
use \Core\FormHandler;
 
class UsersController extends BackController
{
  public function login(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Connexion');

    $this->processFormLogin($request);
 
    if ($request->postExists('login')) {
      $login = $request->postData('username');
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
    $this->processForm($request);
 
    $this->page->addVar('title', 'Ajout d\'un utilisateur');
  }

  private function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {
      $user = new User([
        'username' => $request->postData('username'),
        'email' => $request->postData('email'),
        'password' => $request->postData('password'),
        'lastname' => $request->postData('lastname'),
        'firstname' => $request->postData('firstname')
      ]);
 
      if ($request->getExists('id'))
      {
        $user->setId($request->getData('id'));
      }
    }
    else
    {
      // L'identifiant du user est transmis si on veut la modifier
      if ($request->getExists('id'))
      {
        $user = $this->managers->getManagerOf('Users')->getUnique($request->getData('id'));
      }
      else
      {
        $user = new User;
      }
    }
 
    $formBuilder = new RegisterFormBuilder($user);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Users'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash($user->isNew() 
                      ? 'L\'utilisateur a été ajouté avec succès!' 
                      : 'Le profil de l\'utilisateur a été modifié avec succès!');
 
      $this->app->httpResponse()->redirect('/');
    }
 
    $this->page->addVar('form', $form->createView());
  }

  private function processFormLogin(HTTPRequest $request)
  {
    $user = new User;
    if ($request->method() == 'POST') {
      $user = new User([
        'email' => $request->postData('email'),
        'password' => $request->postData('password')
      ]);
 
      if ($request->getExists('id'))
      {
        $user->setId($request->getData('id'));
      }
    }
 
    $formBuilder = new LoginFormBuilder($user);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Users'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash("Vous êtes bien connecté!");
 
      $this->app->httpResponse()->redirect('/profil');
    }
 
    $this->page->addVar('form', $form->createView());
  }
}