<?php

namespace Entity;

class Post
{
    protected $id;

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
} 