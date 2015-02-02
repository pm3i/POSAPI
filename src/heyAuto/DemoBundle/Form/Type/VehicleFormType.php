<?php

namespace heyAuto\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class VehicleFormType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		
		// $builder->add('id', 			null, array( 'attr'=>array('style'=>'display:none;')) );
		// $builder->add('id', 			'hidden');
		$builder->add('make', 			'text', 
			array(
				'label' 		=> false,
			    'required' 		=> false,) );
		$builder->add('model', 			'text', 
			array(
				'label' 		=> false,
			    'required' 		=> false,) );
		$builder->add('color', 			'text', 
			array(
				'label' 		=> false,
			    'required' 		=> false,) );
		$builder->add('year', 			'text', 
			array(
				'label' 		=> false,
			    'required' 		=> false,) );
		$builder->add('registrationNo',	'text', 
			array(
				'label' 		=> false,
			    'required' 		=> false,) );
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver) {

        $resolver->setDefaults(array(
            'data_class' => 'heyAuto\DemoBundle\Entity\Vehicle',
        ));
    }

	public function getName() {
		return 'vehicle_type';
	}
}