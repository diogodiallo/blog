<?php
namespace FormBuilder;
 
use \Core\FormBuilder;
use \Core\StringField;
use \Core\TextField;
use \Core\MaxLengthValidator;
use \Core\NotNullValidator;
 
class PostsFormBuilder extends FormBuilder
{
  public function build()
  {
       $this->form->add(new StringField([
        'label' => 'Titre',
        'name' => 'title',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le titre spécifié est trop long (100 caractères maximum)', 100),
          new NotNullValidator('Merci de spécifier le titre de la news'),
        ],
       ]))
       ->add(new TextField([
        'label' => 'Resumé',
        'name' => 'resume',
        'rows' => 5,
        'cols' => 60,
        'validators' => [
          new NotNullValidator('Merci de spécifier le resumé du post'),
        ],
       ]))
       ->add(new TextField([
        'label' => 'Contenu',
        'name' => 'content',
        'rows' => 8,
        'cols' => 60,
        'validators' => [
          new NotNullValidator('Merci de spécifier le contenu du post'),
        ],
       ]));
  }
}