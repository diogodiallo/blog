<?php
namespace FormBuilder;
 
use \Core\FormBuilder;
use \Core\StringField;
use \Core\TextField;
use \Core\MaxLengthValidator;
use \Core\NotNullValidator;
 
class CommentFormBuilder extends FormBuilder
{
  public function build()
  {
       $this->form->add(new TextField([
        'label' => 'Commentaire',
        'name' => 'content',
        'rows' => 10,
        'cols' => 50,
        'validators' => [
          new MaxLengthValidator('Le contenu spécifié est trop long (500 caractères maximum)', 500),
          new NotNullValidator('Merci de spécifier votre commentaire'),
        ],
       ]));
  }
}