<?php
namespace Core;
 
class Form
{
  protected $entity;
  protected $fields = [];
 
  public function __construct(Entity $entity)
  {
    $this->setEntity($entity);
  }
 
  public function add(Field $field)
  {
    $attr = $field->name(); // We get the name of the field.
    $field->setValue($this->entity->$attr()); // We assign the corresponding value to the field.
 
    $this->fields[] = $field; // Add the field passed as an argument to the list of fields.
    return $this;
  }
 
  public function createView()
  {
    $view = '';
 
    //We generate one by one the fields of the form.
    foreach ($this->fields as $field)
    {
      $view .= $field->buildWidget().'<br />';
    }
 
    return $view;
  }
 
  public function isValid()
  {
    $valid = true;
 
    // We check that all the fields are valid.
    foreach ($this->fields as $field)
    {
      if (!$field->isValid())
      {
        $valid = false;
      }
    }
 
    return $valid;
  }
 
  public function entity()
  {
    return $this->entity;
  }
 
  public function setEntity(Entity $entity)
  {
    $this->entity = $entity;
  }
}