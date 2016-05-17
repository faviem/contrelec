<?php

namespace BZ\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RubriqueControleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle','text',array('label'=>'Rubrique de contrôle','required' =>true,'attr' =>array('class' =>'form-control','placeholder' =>'Entrer la rubrique de contrôle')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BZ\BlogBundle\Entity\RubriqueControle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bz_blogbundle_rubriquecontrole';
    }
}
