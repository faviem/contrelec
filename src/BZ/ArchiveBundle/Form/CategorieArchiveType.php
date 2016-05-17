<?php

namespace BZ\ArchiveBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategorieArchiveType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle','text',array('label'=>'Catégorie d\'Archive','required' =>true,'attr' =>array('class' =>'form-control','placeholder' =>'Entrer la Catégorie d\'Archive')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BZ\ArchiveBundle\Entity\CategorieArchive'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bz_archivebundle_categoriearchive';
    }
}
