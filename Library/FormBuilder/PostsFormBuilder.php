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
    // $this->form->add(new StringField([
    //     'label' => 'Auteur',
    //     'name' => 'auteur',
    //     'maxLength' => 20,
    //     'validators' => [
    //       new MaxLengthValidator('L\'auteur spécifié est trop long (20 caractères maximum)', 20),
    //       new NotNullValidator('Merci de spécifier l\'auteur de la news'),
    //     ],
    //    ]))
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