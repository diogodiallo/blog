<?php

namespace Model;

use \Entity\Comment;

class CommentsManagerPDO extends CommentsManager
{
	protected function add(Comment $comment)
	{
		$q = $this->dao->prepare('INSERT INTO comments SET post_id = :post_id, content = :content, 
                              created_at = NOW(), updated_at = NOW()');

		$q->bindValue(':post_id', $comment->post_id(), \PDO::PARAM_INT);
		$q->bindValue(':content', $comment->content());

		$q->execute();

		$comment->setId($this->dao->lastInsertId());
	}

	public function delete($id)
	{
		$this->dao->exec('DELETE FROM comments WHERE id = ' . (int) $id);
	}

	public function deleteFromPost($post)
	{
		$this->dao->exec('DELETE FROM comments WHERE post_id = ' . (int) $post);
	}

	public function getListOf($post)
	{
		if (!ctype_digit($post)) {
			throw new \InvalidArgumentException('L\'identifiant de la post passé doit être un nombre entier valide');
		}

		$q = $this->dao->prepare('SELECT c.id, c.post_id, c.user_id, u.username, c.content, c.created_at 
									FROM comments c
									LEFT JOIN users u 
									 ON  u.id = c.user_id
									WHERE c.post_id = :post_id
									AND validate = 1
                              	');
		$q->bindValue(':post_id', $post, \PDO::PARAM_INT);
		$q->execute();

		$q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

		$comments = $q->fetchAll();

		foreach ($comments as $comment) {
			$comment->setCreated_at(new \DateTime($comment->created_at()));
		}

		return $comments;
	}

	protected function modify(Comment $comment)
	{
		$q = $this->dao->prepare('UPDATE comments SET content = :content, updated_at = NOW(), 
                              WHERE id = :id');

		$q->bindValue(':content', $comment->content());
		$q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);

		$q->execute();
	}

	public function get($id)
	{
		$q = $this->dao->prepare('SELECT id, post_id, content FROM comments WHERE id = :id');
		$q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$q->execute();

		$q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

		return $q->fetch();
	}

	public function getListComments()
	{
		$q = $this->dao->query('SELECT id, post_id, created_at, updated_at, validate, content 
                            FROM comments 
                            ORDER BY created_at DESC
                          ');

		$q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

		return $q->fetchAll();
	}

	public function validateComment($id, $valid)
	{
		$q = $this->dao->prepare('UPDATE comments SET validate = :validate, updated_at = NOW()
                              WHERE id = :id
                            ');
		$q->bindValue(':validate', (int) $valid, \PDO::PARAM_INT);
		$q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$q->execute();

		$q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

		return $q;
	}
}
