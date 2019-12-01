<?php
namespace Model;
 
use \Entity\Comment;
 
class CommentsManagerPDO extends CommentsManager
{
  protected function add(Comment $comment)
  {
    $q = $this->dao->prepare('INSERT INTO comments SET post_id = :post_id, content = :content, 
                              created_at = NOW()');
 
    $q->bindValue(':post_id', $comment->post_id(), \PDO::PARAM_INT);
    $q->bindValue(':content', $comment->content());
 
    $q->execute();
 
    $comment->setId($this->dao->lastInsertId());
  }
 
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
  }
 
  public function deleteFromPost($post)
  {
    $this->dao->exec('DELETE FROM comments WHERE post_id = '.(int) $post);
  }
 
  public function getListOf($post)
  {
    if (!ctype_digit($post))
    {
      throw new \InvalidArgumentException('L\'identifiant de la post passé doit être un nombre entier valide');
    }
 
    $q = $this->dao->prepare('SELECT id, post_id, content, created_at 
                              FROM comments 
                              WHERE post_id = :post_id');
    $q->bindValue(':post_id', $post, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
 
    $comments = $q->fetchAll();
 
    foreach ($comments as $comment)
    {
      $comment->setCreated_at(new \DateTime($comment->created_at()));
    }
 
    return $comments;
  }
 
  protected function modify(Comment $comment)
  {
    $q = $this->dao->prepare('UPDATE comments SET content = :content WHERE id = :id');
 
    $q->bindValue(':content', $comment->content());
    $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
 
    $q->execute();
  }
 
  public function get($id)
  {
    $q = $this->dao->prepare('SELECT id, post_id, contenu FROM comments WHERE id = :id');
    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
 
    return $q->fetch();
  }
}