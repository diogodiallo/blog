<?php

namespace App\Frontend\Modules\Posts;
 
use \Core\BackController;
use \Core\HTTPRequest;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \Core\FormHandler;
 
class PostsController extends BackController
{
  public function index(HTTPRequest $request)
  {
    $postsNumber = $this->app->config()->get('number_posts_by_page');
    $charactersNumber = $this->app->config()->get('character_maxlength');
 
    // Add title definition.
    $this->page->addVar('title', 'Liste des '.$postsNumber.' derniers articles');
 
    // Get post manager.
    $manager = $this->managers->getManagerOf('Posts');
 
    $posts = $manager->getList(0, $postsNumber);
 
    foreach ($posts as $post) {
      if (strlen($post->content()) > $charactersNumber) {
        $start = substr($post->content(), 0, $charactersNumber);
        $start = substr($start, 0, strrpos($start, ' ')) . '...';
 
        $post->setContenu($start);
      }
    }
 
    // Add $post variable on the view.
    $this->page->addVar('posts', $posts);
  }
 
  public function show(HTTPRequest $request)
  {
    $post = $this->managers->getManagerOf('Posts')->getUnique($request->getData('id'));
 
    if (empty($post))
    {
      $this->app->httpResponse()->redirect404();
    }
 
    $this->page->addVar('title', $post->title());
    $this->page->addVar('post', $post);
    $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($post->id()));
  }
 
  public function insertComment(HTTPRequest $request)
  {
    // Si le formulaire a été envoyé.
    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'post_id' => $request->getData('post_id'),
        'content' => $request->postData('content')
      ]);
    }
    else
    {
      $comment = new Comment;
    }
 
    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
      $this->app->httpResponse()->redirect('post-'.$request->getData('post_id').'.html');
    }
 
    $this->page->addVar('comment', $comment);
    $this->page->addVar('form', $form->createView());
    $this->page->addVar('title', 'Ajout d\'un commentaire');
  }

  public function disconnect(HTTPRequest $request)
  {
      $this->app->user()->setAuthenticated(false);
      $this->app->user()->setFlash('Vous êtes déconnecté.');
      $this->app->httpResponse()->redirect('/');
  }
}