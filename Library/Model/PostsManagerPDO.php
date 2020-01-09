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
										user_id = :user_id,
                                        content = :content,
                                        created_at = NOW(), 
                                        updated_at = NOW()
                                  ');

		$requete->bindValue(':user_id', $_SESSION['user_id']);
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

	public function getList($start = -1, $limit = -1)
	{
		$sql = 'SELECT id, title, resume, content, created_at, updated_at 
            FROM posts 
            ORDER BY id DESC';

		if ($start != -1 || $limit != -1) {
			$sql .= ' LIMIT ' . (int) $limit . ' OFFSET ' . (int) $start;
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
		$requete = $this->dao->prepare('SELECT p.id, u.id, p.user_id, p.title, p.resume, p.content, u.username, 
												p.created_at, p.updated_at 
                                    	FROM posts p
										LEFT JOIN users u
										 ON u.id = p.user_id 
										WHERE p.id = :id
									');
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
}
