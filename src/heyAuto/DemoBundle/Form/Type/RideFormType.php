<?php

namespace heyAuto\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class RideFormType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		
		// $builder->add('role', 		'text');
		$builder->add('closedAtDate', 		'text');
		$builder->add('distance', 	'text');
		$builder->add('pickup', 	'text');
		$builder->add('destination','text');
		$builder->add('rating',		'text');
		$builder->add('my_ride', 	'submit');
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver) {

        $resolver->setDefaults(array(
            'data_class' => 'heyAuto\DemoBundle\Entity\Offer',
        ));
    }

	public function getName() {
		return 'offer_type';
	}
}