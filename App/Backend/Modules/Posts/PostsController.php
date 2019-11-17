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
  public function delete(HTTPRequest $request)
  {
    $postId = $request->getData('id');
 
    $this->managers->getManagerOf('Post')->delete($postId);
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
 
  public function index(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Gestion des news');
 
    $manager = $this->managers->getManagerOf('Post');
 
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
 
  public function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {
      $news = new News([
        'auteur' => $request->postData('auteur'),
        'titre' => $request->postData('titre'),
        'contenu' => $request->postData('contenu')
      ]);
 
      if ($request->getExists('id'))
      {
        $news->setId($request->getData('id'));
      }
    }
    else
    {
      // L'identifiant de la news est transmis si on veut la modifier
      if ($request->getExists('id'))
      {
        $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
      }
      else
      {
        $news = new News;
      }
    }
 
    $formBuilder = new NewsFormBuilder($news);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('News'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash($news->isNew() ? 'La news a bien été ajoutée !' : 'La news a bien été modifiée !');
 
      $this->app->httpResponse()->redirect('/admin/');
    }
 
    $this->page->addVar('form', $form->createView());
  }
}