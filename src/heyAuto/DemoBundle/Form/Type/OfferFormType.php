<?php

namespace heyAuto\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class OfferFormType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		
			
		$builder->add ('passengerRating','choice',array('choices'=>array(
                        '1'=>'1',
                        '2'=>'2',
                        '3'=>'3',
                        '4'=>'4',
                        '5'=>'5'
                        ),
                    'expanded'=>true,
                    'multiple'=>false
                    ));
		$builder->add('Save', 'submit');

/*

		$builder->add('my_ride', 	'submit');*/
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