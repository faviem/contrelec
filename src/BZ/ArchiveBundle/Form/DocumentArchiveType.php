<?php

namespace BZ\ArchiveBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use BZ\UserBundle\Form\ImageType;

class DocumentArchiveType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', new ImageType(),array('label' => false, 'required' => true))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BZ\ArchiveBundle\Entity\DocumentArchive'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bz_archivebundle_documentarchive';
    }
}
