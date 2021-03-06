<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            ->add('heat', ChoiceType::class, [
            	'choices' => $this->getChoices()   
			])
            ->add('city')
            ->add('address')
            ->add('postal_code')
			->add('lat')
			->add('lng')
            ->add('sold')
			->add('imageFile', FileType::class,
			[
				'required' => false
			])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
			'translation_domain' => 'forms'   // to store form labels translation
        ]);
    }

	private function getChoices()
	{
		return array_flip(Property::HEAT);
	}
}
