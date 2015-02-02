<?php

namespace heyAuto\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserFormType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		
		// $builder->add('id', 				'text', array('label' => false) );
		$builder->add('phoneNo', 			'text', array('label' => false) );
		// $builder->add('online', 			'text', array('label' => false) );
		// $builder->add('active', 			'text', array('label' => false) );
		// $builder->add('token', 				'text', array('label' => false) );
		// $builder->add('currentLocLat', 		'text', array('label' => false) );
		// $builder->add('currentLocLng', 		'text', array('label' => false) );
		// $builder->add('lastSeenOnline', 	'text', array('label' => false) );
		$builder->add('gender', 			'hidden', array('label' => false) );
		$builder->add('birthYear', 			'text', array('label' => false) );
		$builder->add('fullName', 			'text', array('label' => false) );
		// $builder->add('role', 				'text', array('label' => false) );
		// $builder->add('userRatingsCount', 	'text', array('label' => false) );
		// $builder->add('userRatingsAvg', 	'text', array('label' => false) );
		// $builder->add('username', 			'text', array('label' => false) );
        $builder->add('email', 				'email', array('label' => false) );
		$builder->add('password', 			'repeated', 
			array(
			    'type' 			=> 'password',
			    'required' 		=> false,
			    'first_name' => 'pass',
			    'second_name'=> 'confirm'));
		// $builder->add('lastLogin', 		'text');
		
		$builder->add('vehicles', 			'collection', array(
			'type' 			=> new VehicleFormType(),
			'allow_add'		=> true,
			'prototype' 	=> true,
			'by_reference' 	=> false,
			'label' 		=> false,
			));

		//$builder->add('edit', 				'submit');
		$builder->add('save', 				'submit');

	}

	public function setDefaultOptions(OptionsResolverInterface $resolver) {

        $resolver->setDefaults(array(
            'data_class' => 'heyAuto\DemoBundle\Entity\User',
        ));
    }

	public function getName() {
		return 'user_type';
	}
}