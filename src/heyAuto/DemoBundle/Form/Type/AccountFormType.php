<?php

namespace heyAuto\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AccountFormType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('username', 'text', 		array('label' => false) );
        $builder->add('password', 'password', 	array('label' => false) );
        $builder->add('login', 'submit');
	}

	public function getName()
	{
		return 'account_type';
	}
}