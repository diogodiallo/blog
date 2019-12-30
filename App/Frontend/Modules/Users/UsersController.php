<?php
namespace App\Frontend\Modules\Users;
 
use \Core\BackController;
use \Core\HTTPRequest;
use \Entity\User;
use \FormBuilder\RegisterFormBuilder;
use \Core\FormHandler;
use \Mailer\Mailer;
 
class UsersController extends BackController
{
  public function login(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Connexion');
 
    if ($request->method() == 'POST') {
		$login    = $request->postData('identify');
		$password = $request->postData('password'); 

		$manager  = $this->managers->getManagerOf('Users');

		$identify = $manager->getUserBy($login);
		
		if ($login === $identify['username'] && password_verify($password, $identify['password'])) {
			// Start manager profil permissions

			$_SESSION['user'] = $identify['username'];
			$_SESSION['role_name'] = $identify['name'];
			$_SESSION['user_firstname'] = $identify['firstname'];
			$_SESSION['user_lastname'] = $identify['lastname'];
			$_SESSION['user_created_at'] = $identify['created_at'];
			$_SESSION['role_id'] = $identify['role_id'];

			// End manager profil permissions

			$this->app->user()->setAuthenticated(true);
			$this->app->user()->setFlash("Vous êtes bien connecté!", 'success');
			$this->app->httpResponse()->redirect('/profil');
     	} else {
        	$this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.', 'danger');
      	}
    } 
  }

  public function register(HTTPRequest $request)
  {
    if ($this->processForm($request)) {
		exit(var_dump($this->confirmAccount($_GET['username'])));
		//$this->page->addVar('confirm', $this->confirmAccount($_GET['username']));
	}
    $this->page->addVar('title', 'Ajout d\'un utilisateur');
  }

  public function profil(HTTPRequest $request)
  {
	$manager  = $this->managers->getManagerOf('Users');
	$userConnected = $manager->getUser($_SESSION['user']);
	$this->page->addVar('title', 'Profil de '. $_SESSION['user']);
	$this->page->addVar('userConnected', $userConnected);
  }


  public function confirmAccount($username)
  {
	$manager  = $this->managers->getManagerOf('Users');
	$user = $manager->findUserBy($username);
	$token = $user['token'];
	$username = $user['username'];

	if (!empty($_GET['token']) && !empty($_GET['username']) 
		&& $manager->userAlreadyExist('username', $_GET['username'], 'users')) {
		if (($token === $_GET['token'])) {
			$manager->updateUser($_GET['username']);
			$this->app->user()->setFlash('Votre compte est activé!', 'success');
			$this->app->httpResponse()->redirect('/login');
		}
	}else {
		$this->app->user()->setFlash('Les paramètres sont incorrects!', 'danger');
		$this->app->httpResponse()->redirect('/register');
	}

	$this->page->addVar('title', 'Confirmation de compte');
  }

  private function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST') {
      $user = new User([
        'username' => $request->postData('username'),
        'email' => $request->postData('email'),
        'password' => $request->postData('password'),
        'lastname' => $request->postData('lastname'),
        'firstname' => $request->postData('firstname'),
      ]);
 
      if ($request->getExists('id')) {
        $user->setId($request->getData('id'));
      }

    } else {
      if ($request->getExists('id')) {
        $user = $this->managers->getManagerOf('Users')
                    ->getUnique($request->getData('id'));
      } else {
        $user = new User;
      }
    }
 
    $formBuilder = new RegisterFormBuilder($user);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
	$formHandler = new FormHandler($form, $this->managers->getManagerOf('Users'), $request);

    if ($formHandler->process()) {

		$username = $request->postData('username');
		$userToken = $this->managers->getManagerOf('Users')->findUserBy($username);
		$token = $userToken['token'];
		$subject = 'Inscription sur le blog pro de Diogo DIALLO';
	
		$body = "<div> Vous avez souhaiter vous inscrire sur notre site, merci de
				<a href=http://perso.test/confirm.php?username=$username&token=$token>
				confirmer votre inscription
				</a>
			</div>";
		
		if (Mailer::sendMail($request->postData('email'), $username, $body, $subject, $token)) {
			$this->app->user()->setFlash($user->isNew() 
					? 'Un email d\'activation vous a été envoyé!!' 
					: 'Le profil de l\'utilisateur a été modifié avec succès!', 'success');
			$this->app->httpResponse()->redirect('/');
		}
    }

    $this->page->addVar('form', $form->createView());
  }

}