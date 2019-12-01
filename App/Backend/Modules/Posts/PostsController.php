<?php
namespace App\Backend\Modules\Posts;
 
use \Core\BackController;
use \Core\HTTPRequest;
use \Entity\Post;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\PostsFormBuilder;
use \Core\FormHandler;
 
class PostsController extends BackController
{
  public function index(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Gestion des articles');

    $manager = $this->managers->getManagerOf('Posts');
 
    $this->page->addVar('posts', $manager->getList());
    $this->page->addVar('posts_number', $manager->count());
  }
 
  public function insert(HTTPRequest $request)
  {
    $this->processForm($request);
 
    $this->page->addVar('title', 'Ajout d\'une news');
  }
 
  public function update(HTTPRequest $request)
  {
    $this->processForm($request);
 
    $this->page->addVar('title', 'Modification d\'une news');
  }
 
  public function updateComment(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Modification d\'un commentaire');
 
    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'id' => $request->getData('id'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
    }
    else
    {
      $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
    }
 
    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le commentaire a bien été modifié');
 
      $this->app->httpResponse()->redirect('/admin/');
    }
 
    $this->page->addVar('form', $form->createView());
  }

  public function delete(HTTPRequest $request)
  {
    $postId = $request->getData('id');
 
    $this->managers->getManagerOf('Posts')->delete($postId);
    $this->managers->getManagerOf('Comments')->deleteFromPost($postId);
 
    $this->app->user()->setFlash('La news a bien été supprimée !');
 
    $this->app->httpResponse()->redirect('.');
  }
 
  public function deleteComment(HTTPRequest $request)
  {
    $this->managers->getManagerOf('Comments')->delete($request->getData('id'));
 
    $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
 
    $this->app->httpResponse()->redirect('.');
  }
 
  public function logout()
  {
    $this->app->user()->setAuthenticated(false);
    $this->app->user()->setFlash('Vous êtes déconnecté!');
    $this->app->httpResponse()->redirect('/');
  }

  private function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {
      $post = new Post([
        'title' => $request->postData('title'),
        'resume' => $request->postData('resume'),
        'content' => $request->postData('content')
      ]);
 
      if ($request->getExists('id'))
      {
        $post->setId($request->getData('id'));
      }
    }
    else
    {
      // L'identifiant de la news est transmis si on veut la modifier
      if ($request->getExists('id'))
      {
        $post = $this->managers->getManagerOf('Posts')->getUnique($request->getData('id'));
      }
      else
      {
        $post = new Post;
      }
    }
 
    $formBuilder = new PostsFormBuilder($post);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Posts'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash($post->isNew() 
                      ? 'La news a bien été ajoutée !' 
                      : 'La news a bien été modifiée !');
 
      $this->app->httpResponse()->redirect('/admin/');
    }
 
    $this->page->addVar('form', $form->createView());
  }
}