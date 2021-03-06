<?php

namespace Model;

use \Entity\Post;

class PostsManagerPDO extends PostsManager
{
	protected function add(Post $post)
	{
		$requete = $this->dao->prepare('INSERT INTO posts 
                                    SET title = :title,
                                        resume = :resume,
                                        content = :content,
                                        created_at = NOW(), 
                                        updated_at = NOW()
                                  ');

		$requete->bindValue(':title', $post->title());
		$requete->bindValue(':resume', $post->resume());
		$requete->bindValue(':content', $post->content());

		$requete->execute();
	}

	public function count()
	{
		return $this->dao->query('SELECT COUNT(id) FROM posts')->fetchColumn();
	}

	public function delete($id)
	{
		$this->dao->exec('DELETE FROM posts WHERE id = ' . (int) $id);
	}

	public function getList($debut = -1, $limite = -1)
	{
		$sql = 'SELECT id, title, resume, content, created_at, updated_at 
            FROM posts 
            ORDER BY id DESC';

		if ($debut != -1 || $limite != -1) {
			$sql .= ' LIMIT ' . (int) $limite . ' OFFSET ' . (int) $debut;
		}

		$requete = $this->dao->query($sql);
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');

		$listPosts = $requete->fetchAll();

		foreach ($listPosts as $post) {
			$post->setCreated_at(new \DateTime($post->created_at()));
			$post->setUpdated_at(new \DateTime($post->updated_at()));
		}

		$requete->closeCursor();

		return $listPosts;
	}

	public function getUnique($id)
	{
		$requete = $this->dao->prepare('SELECT id, title, resume, content, created_at, updated_at 
                                    FROM posts WHERE id = :id');
		$requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$requete->execute();

		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');

		if ($post = $requete->fetch()) {
			$post->setCreated_at(new \DateTime($post->created_at()));
			$post->setUpdated_at(new \DateTime($post->updated_at()));

			return $post;
		}

		return null;
	}

	protected function modify(Post $post)
	{
		$requete = $this->dao->prepare('UPDATE posts SET title = :title, resume = :resume,
                                      content = :content, updated_at = NOW() WHERE id = :id');

		$requete->bindValue(':title', $post->title());
		$requete->bindValue(':resume', $post->resume());
		$requete->bindValue(':content', $post->content());
		$requete->bindValue(':id', $post->id(), \PDO::PARAM_INT);

		$requete->execute();
	}

	public function addPostPermission()
	{
		$req = $this->dao->prepare("INSERT INTO permissions(module, description) 
                        VALUES('POSTS', 'Voir un article'),
                        ('POSTS', 'Ajouter un article'),
                        ('POSTS', 'Modifier un article'),
                        ('POSTS', 'Supprimer un article')
                    ");
		$req->execute();
	}
}
