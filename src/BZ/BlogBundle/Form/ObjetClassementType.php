<?php

namespace BZ\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ObjetClassementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('lieustockage', 'choice', 
                    array(
                        'choices' => array(
                            'Magasin' => 'Magasin',
                            'Bureau' => 'Bureau',
                            'Cave' => 'Cave',
                            'Couloir' => 'Couloir',
                            'Dessous d\'escaliers' => 'Dessous d\'escaliers',
                            'Autre' => 'Autre'
                        ),
                           'label' => 'Lieu de stockage',
                        'required'    => false,
                        'attr' =>array('class' =>'form-control chzn-select'),
                        'empty_value' => '--Choisissez le lieu--',
                        'empty_data'  => null
                    ))
            ->add('ref','text',array('label'=>'Référence','required' =>true,'attr' =>array('class' =>'form-control','placeholder' =>'Entrer la référence')))

            ->add('description','textarea',array('label'=>'Description','required' =>true,'attr' =>array('class' =>'form-control','placeholder' =>'Entrer la description')))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BZ\BlogBundle\Entity\ObjetClassement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bz_blogbundle_objetclassement';
    }
}
