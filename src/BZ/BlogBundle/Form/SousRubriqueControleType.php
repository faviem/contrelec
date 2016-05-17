<?php

namespace BZ\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SousRubriqueControleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rubriquecontrole','entity', array('label' => 'Rubrique', 
                'class' => 'BZBlogBundle:RubriqueControle',
                'property' => 'libelle',
                'empty_value' => '',
                'multiple' => false,
                'attr' =>array('class' =>'form-control chzn-select'),
                'required' => true,
               
                        ))  
            ->add('libelle','text',array('label'=>'Sous rubrique contrôle','required' =>true,'attr' =>array('class' =>'form-control','placeholder' =>'Entrer le sous rubrique contrôle')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BZ\BlogBundle\Entity\SousRubriqueControle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bz_blogbundle_sousrubriquecontrole';
    }
}
