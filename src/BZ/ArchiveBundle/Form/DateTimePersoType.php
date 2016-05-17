<?php

namespace BZ\ArchiveBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class DateTimePersoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                
            ->add('dateArchive', 'date', array(
                                                'label' => 'POINT JOURNALIER DES ARCHIVES ENREGISTRES ',
                                                'widget' => 'single_text',
                                                'input' => 'datetime',
                                                'format' => 'dd/MM/yyyy',
                                                'attr' => array('class' => 'date form-control ','style' => 'width:16%;margin-left:0.5%;font-size: 11px;" '),
                                                ))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BZ\ArchiveBundle\Entity\Archive'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bz_archivebundle_archive';
    }
}
