<?php

namespace BZ\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExerciceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('annee','number',array('label'=>'Niveau l\'Exercice','required' =>true,'attr' =>array('class' =>'form-control','placeholder' =>'Entrer l\'Exercice')))
                
            ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BZ\BlogBundle\Entity\Exercice'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bz_blogbundle_exercice';
    }
}
