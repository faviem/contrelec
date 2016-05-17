<?php

namespace BZ\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array(
                    'attr' => array(
                        'placeholder' => 'Login',
                        'tabindex' => '15',
                        'class' => 'form-control',
                    )
                ))
                ->add('email', 'email', array(
                    'attr' => array(
                        'placeholder' => 'email',
                        'tabindex' => '15',
                        'class' => 'form-control',
                    )
                ))
                ->add('plainPassword', 'password', array(
                    'attr' => array(
                        'placeholder' => 'Mot de passe',
                        'tabindex' => '15',
                        'class' => 'form-control',
                    )
                ))
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
