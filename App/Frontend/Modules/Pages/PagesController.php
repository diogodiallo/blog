<?php

namespace App\Frontend\Modules\Pages;
 
use \Core\BackController;
use \Core\HTTPRequest;
use \Mailer\Mailer;

class PagesController extends BackController
{
    public function home()
    {
      $this->page->addVar('title', 'Blog professionnel');
      $this->page->addVar('home', 'Page d\'accueil du site');
    }

    public function about()
    {
        $this->page->addVar('title', 'Á propos de moi');
    }

    public function contact(HTTPRequest $request)
    {
        if ($request->method() == 'POST') {
            $to = $request->postData('email');
            $name = $request->postData('name');
            $subject = $request->postData('subject');
            $body = $request->postData('body');

            $contact = Mailer::sendMail($to, $name, $subject, $body);

            if ($contact) {
                $this->app->user()->setFlash('Nous avons bien recu votre message, nous vous en remercions.');
                $this->app->httpResponse()->redirect('.');
            }else {
                $this->app->user()->setFlash('Une erreur inattendue est survenue. Veuillez recommencer!!');
                $this->app->httpResponse()->redirect('./contact');
            }
        }

        $this->page->addVar('title', 'Contactez-moi');
    }
}