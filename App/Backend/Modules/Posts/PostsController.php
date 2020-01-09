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

	const REJECT = 0;
	const VALIDATE = 1;

	public function index()
	{
		$this->page->addVar('title', 'Gestion des articles');

		$manager = $this->managers->getManagerOf('Posts');

		$this->page->addVar('posts', $manager->getList());

		$this->page->addVar('posts_number', $manager->count());
	}

	public function listComments()
	{
		$this->page->addVar('title', 'Liste commentaires');
		$managerComments = $this->managers->getManagerOf('Comments');
		$this->page->addVar('comments', $managerComments->getListComments());
	}

	public function insert(HTTPRequest $request)
	{
		$this->processForm($request);

		$this->page->addVar('title', 'Ajout d\'une news');
	}

	public function update(HTTPRequest $request)
	{
		$this->processForm($request);

		$this->page->addVar('title', 'Modification d\'un article');
	}

	public function updateComment(HTTPRequest $request)
	{

		if ($request->method() == 'POST') {
			$comment = new Comment([
				'id' => $request->getData('id'),
				'content' => $request->postData('content')
			]);

			$this->app->user()->setFlash('Le commentaire a bien été modifié');

			$this->app->httpResponse()->redirect('/admin/');
		} else {
			$comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));

			// FOR VALIDATE AND REJECT BUTTON?
			if (self::VALIDATE) {
				$this->page->addVar('validation', $this->managers->getManagerOf('Comments')
					->validateComment($comment->id(), 1));
			} elseif (self::REJECT) {
				$this->page->addVar('validation', $this->managers->getManagerOf('Comments')
					->validateComment($comment->id(), 0));
			}
		}

		$formBuilder = new CommentFormBuilder($comment);
		$formBuilder->build();

		$form = $formBuilder->form();

		$formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

		if ($formHandler->process()) {
			$this->app->user()->setFlash('Le commentaire a bien été modifié');

			$this->app->httpResponse()->redirect('/admin/');
		}

		$this->page->addVar('title', 'Modification d\'un commentaire');
		$this->page->addVar('form', $form->createView());
	}

	public function delete(HTTPRequest $request)
	{
		$postId = $request->getData('id');

		$this->managers->getManagerOf('Posts')->delete($postId);
		$this->managers->getManagerOf('Comments')->deleteFromPost($postId);

		$this->app->user()->setFlash('Le post a bien été supprimé!');

		$this->app->httpResponse()->redirect('.');
	}

	public function deleteComment(HTTPRequest $request)
	{
		$this->managers->getManagerOf('Comments')->delete($request->getData('id'));

		$this->app->user()->setFlash('Le commentaire a bien été supprimé!');

		$this->app->httpResponse()->redirect('.');
	}

	private function processForm(HTTPRequest $request)
	{
		if ($request->method() == 'POST') {
			$post = new Post([
				'title' => $request->postData('title'),
				'resume' => $request->postData('resume'),
				'content' => $request->postData('content')
			]);

			if ($request->getExists('id')) {
				$post->setId($request->getData('id'));
			}
		} else {
			if ($request->getExists('id')) {
				$post = $this->managers->getManagerOf('Posts')->getUnique($request->getData('id'));
			} else {
				$post = new Post;
			}
		}

		$formBuilder = new PostsFormBuilder($post);
		$formBuilder->build();

		$form = $formBuilder->form();

		$formHandler = new FormHandler($form, $this->managers->getManagerOf('Posts'), $request);

		if ($formHandler->process()) {
			$this->app->user()->setFlash($post->isNew()
				? 'La news a bien été ajoutée !'
				: 'La news a bien été modifiée !');

			$this->app->httpResponse()->redirect('/admin/');
		}

		$this->page->addVar('form', $form->createView());
	}
}
