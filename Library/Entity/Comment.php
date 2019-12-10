<?php
namespace Entity;
 
use \Core\Entity;
 
class Comment extends Entity
{
  protected $post_id;
  protected $content;
  //protected $validate;
  protected $created_at;
 
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
  
  public function setCreated_at(\DateTime $created_at)
  {
    $this->created_at = $created_at;
  }
 
  public function post_id()
  {
    return $this->post_id;
  }
 
  public function content()
  {
    return $this->content;
  }
  
  public function created_at()
  {
    return $this->created_at;
  }

  /**
   * Get the value of validate
   */ 
  // public function validate()
  // {
  //   return $this->validate;
  // }

  /**
   * Set the value of validate
   *
   * @return  self
   */ 
  // public function setValidate($validate)
  // {
  //   $this->validate = $validate;

  //   return $this;
  // }
}