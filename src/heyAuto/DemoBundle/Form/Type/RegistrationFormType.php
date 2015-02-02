<?php

namespace heyAuto\DemoBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		parent::buildForm($builder, $options);
// 		echo "mastest";
		// add your custom field
		$builder->add('username', 'text');
		$builder->add('email', 'email');
		$builder->add('phoneNo', 'text');
		$builder->add('password', 'password');
        $builder->add('edit', 'submit');
	}

	public function getName()
	{
		return 'hey_auto_user_registration';
	}
}