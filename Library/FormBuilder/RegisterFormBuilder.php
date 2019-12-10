<?php
namespace FormBuilder;
 
use \Core\FormBuilder;
use \Core\StringField;
use \Core\PasswordField;
use \Core\TextField;
use \Core\MaxLengthValidator;
use \Core\NotNullValidator;
 
class RegisterFormBuilder extends FormBuilder
{
  public function build()
  {
      $this->form->add(new StringField([
        'label' => 'Pseudonyme',
        'name' => 'username',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le pseudonyme spécifié est trop long (100 caractères maximum)', 100),
          new NotNullValidator('Merci de spécifier le pseudonyme du user'),
        ],
      ]))
      ->add(new StringField([
        'label' => 'Email',
        'name' => 'email',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('L\'email spécifié est trop long (100 caractères maximum)', 100),
          new NotNullValidator('Merci de spécifier l\'email du user'),
        ],
       ]))
      ->add(new PasswordField([
        'label' => 'Mot de passe',
        'name' => 'password',
       ]))
      ->add(new StringField([
        'label' => 'Prénom',
        'name' => 'firstname',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('Le prénom spécifié est trop long (100 caractères maximum)', 50),
          new NotNullValidator('Merci de spécifier le prénom du user'),
        ],
       ]))
      ->add(new StringField([
        'label' => 'Nom de famille',
        'name' => 'lastname',
        'maxLength' => 20,
        'validators' => [
          new MaxLengthValidator('Le nom spécifié est trop long (20 caractères maximum)', 20),
          new NotNullValidator('Merci de spécifier le nom de famille du user'),
        ],
       ]))
      ;
  }
}