<?php

namespace Entity;

use \Core\Entity;
use \Cocur\Slugify\Slugify;

class Post extends Entity
{
    protected $id;
    protected $title;
    protected $slug;
    protected $content;
    protected $created_at;
    protected $updated_at;

    const TITLE_INVALID = 2;
    const CONTENT_INVALID = 3;
   
    public function isValid()
    {
      return !(empty($this->slug) || empty($this->title) || empty($this->content));
    }

    /**
     * Get the value of id
     */ 
    public function id()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        if ($id > 0) {
            $this->id = $id;
        }
    }

    /**
     * Get the value of title
     */ 
    public function title()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        if (!is_string($title) || empty($title))
        {
          $this->errors[] = self::TITLE_INVALID;
        }

        
        $this->title = $title;  
    }

    public function slug()
    {
        $slugify = new Slugify;

        $this->slug = $slugify->slugify($this->title);
    }

    /**
     * Get the value of content
     */ 
    public function content()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        if (!is_string($content) || empty($content))
        {
          $this->errors[] = self::CONTENT_INVALID;
        }

        $this->content = $content;
    }

    /**
     * Get the value of created_at
     */ 
    public function created_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at(\DateTime $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * Get the value of updated_at
     */ 
    public function updated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */ 
    public function setUpdated_at(\DateTime $updated_at)
    {
        $this->updated_at = $updated_at;
    }
} 