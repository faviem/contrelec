<?php

namespace BZ\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use BZ\UserBundle\Entity\ServiceRepository;
use Doctrine\ORM\EntityRepository;

class AddUserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username','text',array('label' => 'Login', 'required' => true,'attr' =>array('class' =>'form-control','placeholder' =>'Enrer le login')))
           ->add('plainPassword','password',array('label' => 'Mot de Passe', 'required' => true,'attr' =>array('class' =>'form-control','placeholder' =>'Enrer le mot de passe')))
            ->add('email','text',array('label' => 'e@mail', 'required' => true,'attr' =>array('class' =>'form-control','placeholder' =>'Enrer email')))
            ->add('gender', 'choice', 
                    array(
                        'choices' => array(
                            'M' => 'Masculin',
                            'F' => 'Féminin'
                        ),
                        'label' => 'Sexe',
                        'required'    => false,
                        'attr' =>array('class' =>'form-control chzn-select'),
                        'empty_value' => '--Choisissez le sexe--',
                        'empty_data'  => null
                    ))
          
            ->add('service','entity', array('label' => 'Service', 
                'class' => 'BZUserBundle:Service',
                'property' => 'denomination',
                'empty_value' => '--Choisissez le Service--',
                'multiple' => false,
                'attr' =>array('class' =>'form-control chzn-select'),
                'required' => false,
                'query_builder' => function(EntityRepository $er )  {
                                return $er->createQueryBuilder('s')
                                          ->orderBy('s.denomination', 'ASC')
                                          ->where('s.estsupprimer = 0');
                        }))
           ->add('profil','entity', array('label' => 'Profil', 
                'class' => 'BZUserBundle:Profil',
                'property' => 'libelle',
                'empty_value' => '--Choisissez le Profil--',
                'multiple' => false,
                'attr' =>array('class' =>'form-control chzn-select'),
                'required' => true))
            ->add('firstName','text',array('label' => 'Nom', 'required' => false,'attr' =>array('class' =>'form-control','placeholder' =>'Enrer le nom')))
            ->add('lastName','text',array('label' => 'Prénom', 'required' => false,'attr' =>array('class' =>'form-control','placeholder' =>'Enrer le prénom')))
          
            ->add('mobile','text',array('label' => 'Contact', 'required' => false,'attr' =>array('class' =>'form-control','placeholder' =>'Enrer le contact')))
              
            ->add('image', new ImageType(),array('label' => false, 'required' => false))
                
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BZ\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bz_userbundle_user';
    }
}
