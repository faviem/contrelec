<?php

namespace BZ\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RubriqueFinanceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle','text',array('label'=>'Rubrique finance','required' =>true,'attr' =>array('class' =>'form-control','placeholder' =>'Entrer la rubrique finance')))
            ->add('tarif','number',array('label'=>'Tarif correspondant','required' =>true,'attr' =>array('class' =>'form-control','placeholder' =>'Entrer le tarif correspondant')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BZ\BlogBundle\Entity\RubriqueFinance'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bz_blogbundle_rubriquefinance';
    }
}
