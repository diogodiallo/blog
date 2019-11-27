<?php

namespace App\Frontend\Modules\Pages;
 
use \Core\BackController;
use \Core\HTTPRequest;

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

    public function contact()
    {
        $this->page->addVar('title', 'Contactez-moi');
    }
}