<?php 

namespace App\Frontend\Modules\Posts;

use \Core\Application;
use \Entity\Post;

class PostsController extends Application
{
    public function index()
    {
        echo 'Accueil des articles (Index)';
    }

    public function show($post)
    {
        echo 'affichage d\'un article (Show)';
    }
}
