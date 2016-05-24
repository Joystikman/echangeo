<?php

namespace EchangeoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('debut', 'date')
            ->add('fin', 'date')
            ->add('type')
            ->add('lieu')
            ->add('distance')
            ->add('inscrit')
            ->add('sousCategorie')
            ->add('evaluationNotant')
            ->add('evaluationNote')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EchangeoBundle\Entity\Service'
        ));
    }
}
