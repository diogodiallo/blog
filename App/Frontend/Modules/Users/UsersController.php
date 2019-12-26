<?php
namespace App\Frontend\Modules\Users;
 
use \Core\BackController;
use \Core\HTTPRequest;
use \Entity\User;
use \FormBuilder\RegisterFormBuilder;
use \Core\FormHandler;

require dirname( __DIR__, 4).'/vendor/autoload.php';
include '../Library/Mailer/credentialsGmail.php';
 
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
        $this->app->user()->setFlash("Vous êtes bien connecté!");
        $this->app->httpResponse()->redirect('/profil');
      } else {
        $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
      }
    } 
  }

  public function register(HTTPRequest $request)
  {
    $this->processForm($request);

    // Send confirmation email to the user
    // $this->validateRegistration($request->postData('username'), 
    //                             $request->postData('email'), 
    //                             $request->postData('token')
    //                           );
 
    $this->page->addVar('title', 'Ajout d\'un utilisateur');
  }

  public function profil(HTTPRequest $request)
  {
    $manager  = $this->managers->getManagerOf('Users');
    $userConnected = $manager->getUser($_SESSION['user']);
    
    $this->page->addVar('title', 'Profil de '. $_SESSION['user']);
    $this->page->addVar('userConnected', $userConnected);
  }

  private function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST') {
      
      $token = uniqid($request->postData('username').$request->postData('password').date(time()));

      $user = new User([
        'username' => $request->postData('username'),
        'email' => $request->postData('email'),
        'password' => $request->postData('password'),
        'lastname' => $request->postData('lastname'),
        'firstname' => $request->postData('firstname'),
        'token'  => $token,
      ]);

      $this->validateRegistration($request->postData('username'), 
                                $request->postData('email'), 
                                $request->postData('token')
                              );
 
      if ($request->getExists('id')) {
        $user->setId($request->getData('id'));
      }

    } else {
      // L'identifiant du user est transmis si on veut la modifier
      if ($request->getExists('id')) {
        $user = $this->managers->getManagerOf('Users')->getUnique($request->getData('id'));
      } else {
        $user = new User;
      }
    }
 
    $formBuilder = new RegisterFormBuilder($user);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Users'), $request);
 

    if ($formHandler->process()) {
      $this->app->user()->setFlash($user->isNew() 
                      ? 'L\'utilisateur a été ajouté avec succès!' 
                      : 'Le profil de l\'utilisateur a été modifié avec succès!');
 
      $this->app->httpResponse()->redirect('/');
    }
 
    $this->page->addVar('form', $form->createView());
  }


  public function validateRegistration($username, $email, $token)
  {
      $https['ssl']['verify_peer'] = FALSE;
      $https['ssl']['verify_peer_name'] = FALSE;
      
      // Create the Transport
      $transport = (new \Swift_SmtpTransport(GMAIL_HOST, GMAIL_PORT))
                    ->setUsername(GMAIL_USERNAME)
                    ->setPassword(GMAIL_PASSWORD)
                    ->setEncryption(GMAIL_ENCRYPTION);

      // Message body
      $body = "<div> Vous avez souhaiter vous inscrire sur notre site, merci de
                  <a href=http://perso.test/confirm.php?username=$username&token=$token>
                    confirmer votre inscription
                  </a>
              </div>";
  
      // Create the Mailer using your created Transport
      $mailer = new \Swift_Mailer($transport);
  
      // Create a message
      $message = (new \Swift_Message('Blog de DD'))
                      ->setSubject('Confirmation de votre inscription')
                      ->setFrom([$email])
                      ->setTo([GMAIL_USERNAME => USER_NAME])
                      ->setBody($body, 'text/html')
      ;
  
      // Send the message
      if($mailer->send($message)) {
        $this->app->user()->setFlash('Merci de votre inscription, veuillez verifier votre boite email');
        $this->app->httpResponse()->redirect('/');
      }else {
        $this->app->user()->setFlash('Une erreur inattendue est survenue, veuillez recommencer');
        $this->app->httpResponse()->redirect('/register');
      }

      $this->page->addVar('title', 'Confirmation inscription');
  }

}