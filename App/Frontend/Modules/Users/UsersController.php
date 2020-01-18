<?php

namespace App\Frontend\Modules\Users;

use \Core\BackController;
use \Core\HTTPRequest;
use \Core\User;
use \FormBuilder\RegisterFormBuilder;
use \Core\FormHandler;
use \Mailer\Mailer;

class UsersController extends BackController
{
	public function login(HTTPRequest $request)
	{
		$this->page->addVar('title', 'Connexion');
		$manager  = $this->managers->getManagerOf('Users');

		if ($request->method() == 'POST') {
			$login    = $request->postData('identify');
			$password = $request->postData('password');

			$user = $manager->getOne($login, $password);

			$_SESSION['user'] = $user->username;
			$_SESSION['user_firstname'] = $user->firstname;
			$_SESSION['user_lastname'] = $user->lastname;
			$_SESSION['user_role_id'] = $user->role_id;
			
			$this->app->user()->setRights($user->rights());
			$this->app->user()->setAuthenticated(true);
			$this->app->user()->setFlash("Vous êtes bien connecté!", 'success');
			$this->app->httpResponse()->redirect('/profil');
		}
	}

	public function register(HTTPRequest $request)
	{
		$this->processForm($request);
		$this->page->addVar('title', 'S\'inscrire');
	}

	public function profil(HTTPRequest $request)
	{
		$manager  = $this->managers->getManagerOf('Users');
		$userConnected = $manager->getUser($_SESSION['user']);
		$this->page->addVar('title', 'Profil de ' . $_SESSION['user']);
		$this->page->addVar('userConnected', $userConnected);
	}


	public function confirmAccount(HTTPRequest $request)
	{
		$token = bin2hex(openssl_random_pseudo_bytes(64));
		$tokenUrl = $request->getData('token');

		$username = $this->managers->getManagerOf('Users')->getUserBy($request->getData('username'));

		if (($token === $tokenUrl)) {
			$this->managers->getManagerOf('users')->updateUser($username);
			$this->app->user()->setFlash('Votre compte est activé!', 'success');
			$this->app->httpResponse()->redirect('/login');
		} else {
			$this->app->user()->setFlash('Parametres incorrects!', 'danger');
			$this->app->httpResponse()->redirect('/register');
		}
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
			$token = bin2hex(openssl_random_pseudo_bytes(64));
			$subject = 'Inscription sur le blog pro de Diogo DIALLO';

			$body = "<div> Vous avez souhaiter vous inscrire sur notre site, merci de
				<a href=http://blogpro.diogodiallo.com/confirm.html?token=$token>
				confirmer votre inscription
				</a>
			</div>";

			if (Mailer::sendMail($request->postData('email'), $body, $subject,  $token)) {
				$this->app->user()->setFlash($user->isNew()
					? 'Un email d\'activation vous a été envoyé!!'
					: 'Le profil de l\'utilisateur a été modifié avec succès!', 'success');
				$this->app->httpResponse()->redirect('/');
			}
		}

		$this->page->addVar('form', $form->createView());
	}
}
