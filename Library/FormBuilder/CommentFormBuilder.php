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
    // $this->form->add(new StringField([
    //     'label' => 'Auteur',
    //     'name' => 'auteur',
    //     'maxLength' => 50,
    //     'validators' => [
    //       new MaxLengthValidator('L\'auteur spécifié est trop long (50 caractères maximum)', 50),
    //       new NotNullValidator('Merci de spécifier l\'auteur du commentaire'),
    //     ],
    //    ]))
       $this->form->add(new TextField([
        'label' => 'Contenu',
        'name' => 'content',
        'rows' => 7,
        'cols' => 50,
        'validators' => [
          new NotNullValidator('Merci de spécifier votre commentaire'),
        ],
       ]));
  }
}