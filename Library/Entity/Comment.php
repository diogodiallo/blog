<?php
namespace Entity;
 
use \Core\Entity;
 
class Comment extends Entity
{
  protected $post_id;
  protected $content;
  protected $comment_created_at;
 
  const CONTENT_INVALID = 1;
 
  public function isValid()
  {
    return !(empty($this->content));
  }
 
  public function setPost_id($post)
  {
    $this->post_id = (int) $post;
  }
 
  public function setContent($content)
  {
    if (!is_string($content) || empty($content))
    {
      $this->errors[] = self::CONTENT_INVALID;
    }
 
    $this->content = $content;
  }
  
  public function setComment_created_at(\DateTime $comment_created_at)
  {
    $this->comment_created_at = $comment_created_at;
  }
 
  public function post_id()
  {
    return $this->post_id;
  }
 
  public function content()
  {
    return $this->content;
  }
  
  public function comment_created_at()
  {
    return $this->comment_created_at;
  }
}