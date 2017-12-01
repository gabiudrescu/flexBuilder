<?php

namespace AppBundle\Form;

use AppBundle\Entity\Component;
use AppBundle\Entity\Configuration;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FlexType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('components', EntityType::class, [
            'class' => Component::class,
            'multiple' => true,
            'expanded' => true,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Configuration::class,
            'attr' => [
                'id' => 'wizard'
            ]
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
