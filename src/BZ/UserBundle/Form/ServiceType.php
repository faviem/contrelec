<?php

namespace BZ\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServiceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                 ->add('user','entity', array('label' => 'Responsable/Chef/Directeur', 
                'class' => 'BZUserBundle:User',
                'property' => 'nomPrenom',
                'empty_value' => '--Choisissez le Responsable--',
                'multiple' => false,
                'attr' =>array('class' =>'form-control chzn-select'),
                'required' => false
                        ))
            ->add('denomination','text',array('label'=>'Dénomination','required' =>true,'attr' =>array('class' =>'form-control','placeholder' =>'Enrer la dénomination')))
            ->add('sigle','text',array('label'=>'Sigle','required' =>true,'attr' =>array('class' =>'form-control','placeholder' =>'Enrer le sigle')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BZ\UserBundle\Entity\Service'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bz_blogbundle_service';
    }
}
