<?php

namespace FormBuilder;

use \Core\FormBuilder;
use \Core\StringField;
use \Core\TextField;
use \Core\MaxLengthValidator;
use \Core\NotNullValidator;

class LoginFormBuilder extends FormBuilder
{
	public function build()
	{
		$this->form->add(new StringField([
			'label' => 'Email',
			'name' => 'email',
			'maxLength' => 100,
			'validators' => [
				new MaxLengthValidator('L\'email spécifié est trop long (100 caractères maximum)', 100),
				new NotNullValidator('Merci de spécifier l\'email du user'),
			],
		]))
			->add(new StringField([
				'label' => 'Mot de passe',
				'name' => 'password',
			]));
	}
}
